<?php

namespace App\Http\Controllers;

use App\Models\ComboProduct;
use App\Models\DeliveryCharge;
use App\Models\Order;
use App\Models\Product;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Models\PoliceStation;
use App\Models\BillingAddress;
use App\Models\Merchant_order;
use App\Models\CourierDistrict;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use sms_net_bd\SMS;

class CheckoutController extends Controller
{
    public function checkout() { 
        session(['url.intended' => url()->current()]); 
            return view('website.checkout.checkout',[
                'products'=>Cart::content(),
                'districts'=>CourierDistrict::where('status',1)->latest()->get(),
                'deliveryAddress'=>BillingAddress::where('customer_id',Auth::guard('customer')->user()->id)->get(),
                'deliveryLocations'=>DeliveryCharge::where('status',1)->get(),
    
    
            ]);
         
        
    }


    public function newOrder(Request $request)
    {
    //    return $request->phone;

        // return $request;

        if ($request->payment_method == 'online'){
//            return $request;
            $this->sslCommerzPayment = new SslCommerzPaymentController();
            $this->sslCommerzPayment->index($request);
        }elseif($request->payment_method == 'fullAmount'){
            $this->sslCommerzPayment = new SslCommerzPaymentController();
            $this->sslCommerzPayment->index($request);
            }
        elseif ($request->payment_method == 'cod'){
            $this->order = Order::newOrder($request);
            $order_number = $this->order->order_number;
            Order_detail::newOrderDetail($this->order,$request);

            Session::forget('coupon');
            Session::forget('shipping_cost');
            Session::forget('order_total');
            Session::forget('tax');
            Session::forget('grand_total');

            Session::flash('orderSuccess','Order Completed Successfully');
            return  redirect()->route('get.confirmation')->with('message','Your order successfully placed');

        }
    }

    public function getShippingCost(Request $request)
    {
        $location = DeliveryCharge::where('location_name', $request->locationName)->first();

        if ($location) {
            return response()->json([
                'success' => true,
                'shipping_cost' => $location->delivery_charge,
            ]);
        }

        return response()->json(['success' => false, 'shipping_cost' => 0]);
    }
    public function getPoliceStations() {
        $id=$_GET['id'];
        return response()->json(PoliceStation::where('district_id',$_GET['id'])->get());
    }

    public function getConfirmation(){
        return view('website.checkout.confirmation');
    }
     public function getCancel(){
        return view('website.checkout.cancel');
    }

}
