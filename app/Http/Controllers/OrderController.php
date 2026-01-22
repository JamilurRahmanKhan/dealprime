<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Courier;
use App\Models\Order_detail;
use App\Services\PathaoCourierService;
use Illuminate\Http\Request;
use App\Models\Merchant_order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf; // Directly import the PDF facade




class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     abort_if(!userCan('orders.index'),403);

    //     $user = Auth::user();
    //     if ($user->role == 'Admin') {
    //         $orders = Merchant_order::latest()->get();
    //     }
    //     elseif ($user->role == 'Merchant') {
    //         $orders = Merchant_order::where('merchant_id', $user->id)->latest()->get();
    //     }
    //     return view('admin.order.index',[
    //         'merchant_orders'=>$orders,
    //     ]);
    // }


    protected $pathaoService;

    public function __construct(PathaoCourierService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    public function index()
    {
        abort_if(!userCan('orders.index'), 403);

        $user = Auth::user();
        if ($user->role == 'Admin') {
            $orders = Merchant_order::latest()
                ->get()
                ->unique('order_id');
        } elseif ($user->role == 'Merchant') {
            $orders = Merchant_order::where('merchant_id', $user->id)
                ->latest()
                ->get()
                ->unique('order_id');
        }
        return view('admin.order.index', [
            'merchant_orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('orders.create'),403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('orders.create'),403);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

          $comboProductresults = DB::table('orders')
            ->where('orders.id', $id)
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->where( 'order_details.type', 'combo')
            ->join('combo_products', 'order_details.product_id', '=', 'combo_products.id')
            ->get();
         $productResults =  DB::table('orders')
             ->where('orders.id', $id)
             ->join('order_details', 'order_details.order_id', '=', 'orders.id')
             ->where( 'order_details.type', 'product')
             ->join('products', 'order_details.product_id', '=', 'products.id')
            ->get();

            // Fetch cities from Pathao
            $cities = $this->pathaoService->getCities();

         return view('admin.order.show',[
            'orders'=>Order::find($id),
            'comboProductresults'=>$comboProductresults,
            'order_details'=>$productResults,
            'cities'=>$cities,
         ]);
    }


    public function orderDetail(string $id)
    {

        $comboProductresults = DB::table('orders')
            ->where('orders.id', $id)
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->where( 'order_details.type', 'combo')
            ->join('combo_products', 'order_details.product_id', '=', 'combo_products.id')
            ->get();
        $order_details =  DB::table('orders')
            ->where('orders.id', $id)
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->where( 'order_details.type', 'product')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->get();

        // Fetch cities from Pathao
        $cities = $this->pathaoService->getCities();
        $orders=Order::find($id);
        return view('admin.order.detail', compact('orders', 'cities','order_details','comboProductresults'));
//        return view('admin.order.detail',[
//            'orders'=>Order::find($id),
//            'comboProductresults'=>$comboProductresults,
//            'order_details'=>$productResults,
//            'cities'=>$cities,
//        ]);
    }

    public function placeOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate form data
        $validated = $request->validate([
            'city_id' => 'required|integer',
            'zone_id' => 'required|integer',
            'area_id' => 'required|integer',
        ], [
            'city_id.required' => 'Please select a city',
            'zone_id.required' => 'Please select a zone',
            'area_id.required' => 'Please select an area',
        ]);

        try {
            // Place the order with Pathao
            $orderData = [
                "store_id" => 260978, // Replace with your actual merchant store ID
                "merchant_order_id" => $order->id,
                "recipient_name" => $order->customer->name,
                "recipient_phone" => $order->customer->mobile,
                "recipient_address" => $order->delivery_address,
                "recipient_city" => $validated['city_id'],
                "recipient_zone" => $validated['zone_id'],
                "recipient_area" => $validated['area_id'],
                "delivery_type" => 48,  // Standard delivery
                "item_type" => 2,
                "special_instruction" => "Handle with care",
                "item_quantity" => $order->orderDetails->sum('product_qty'),
                "item_weight" => $order->orderDetails->sum(function ($detail) {
                    return $detail->product->weight * $detail->product_qty;
                }),
                "item_description" => $order->orderDetails->pluck('product_name')->implode(', '),
                "amount_to_collect" => $order->order_total,
            ];

            $response = $this->pathaoService->createOrder($orderData);

            if (isset($response['error'])) {
                return redirect()->back()->with('error', 'Failed to place order: ' . $response['error']);
            }

            return redirect()->back()->with('success', 'Order sent to Pathao successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error placing order: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
//        return Order::find($id) ;
        abort_if(!userCan('orders.edit'),403);
        return view('admin.order.edit',[
            'couriers'=>Courier::where('status',1)->get(),
            'order'=>Order::find($id) ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('orders.edit'),403);
//         return $id;
         $order=Order::find($id);
         if($order->payment_method == 'online'){
            if($request->order_status == 1){
                $order->status="Complete";
            }
         }

         $order->order_status=$request->order_status;
         $order->courier=$request->courier;
         $order->save();
         Session::flash('success','Order Info Updated Successfully');
         return redirect()->route('orders.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('orders.destroy'),403);
    }


    public function invoice($id){

        $orders = Merchant_order::find($id);
        return view('admin.order.invoice',[
            'merchant_order'=>$orders,
            'order_details'=>Order_detail::where('order_id',$id)->get(),
        ]);
    }



    // public function invoice(Request $request)
    // {
    //     // Fetch the order and related data here
    //     $merchant_order = Merchant_order::find($request->order_id); // or however you fetch it
    //     $order_details = Order_detail::where('order_id',$request->id)->get(); // Assuming relationship exists

    //     $pdf = Pdf::loadView('admin.order.invoice', compact('merchant_order', 'order_details'))
    //               ->setPaper('A4', 'portrait');

    //     // Return PDF stream
    //     return $pdf->stream('invoice.pdf');
    // }










}
