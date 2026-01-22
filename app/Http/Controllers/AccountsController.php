<?php

namespace App\Http\Controllers;

use App\Models\MerchantPaid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountsController extends Controller
{
    public function merchantPayble()
    {
//        abort_if(!userCan('sales.report'), 403);

        $user = Auth::user();
        if ($user->role == 'Admin') {
            $results = DB::table('orders')
                ->where('orders.order_status', 3)
                ->join('merchant_orders', 'orders.id', '=', 'merchant_orders.order_id')
                ->join('users', 'merchant_orders.merchant_id', '=', 'users.id')
//                ->leftJoin('merchant_paids', 'merchant_orders.merchant_id', '=', 'merchant_paids.merchant_id')
//                ->join('merchant_paids', 'users.id', '=', 'merchant_orders.merchant_id')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select(
                    'merchant_orders.merchant_id',
                    'users.name as merchant_name',
//                    'orders.order_number as order_number',
                    DB::raw('SUM(orders.order_total) as total_order_amount'),
//                    DB::raw('SUM(merchant_paids.paid_amount) as total_paid_amount'),
                    DB::raw('COUNT(orders.id) as total_orders')
                )
//                ->groupBy('merchant_orders.merchant_id') // Group by merchant_id and merchant name
                ->groupBy('merchant_orders.merchant_id', 'users.name') // Group by merchant_id and merchant name
                ->get();
//            return $results;
        }elseif ($user->role == 'Merchant') {
            $results = DB::table('orders')
                ->where('orders.order_status', 3)
                ->where('merchant_orders.merchant_id', $user->id)
                ->join('merchant_orders', 'orders.id', '=', 'merchant_orders.order_id')
                ->join('users',  'merchant_orders.merchant_id','=', 'users.id')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select('orders.id as order_id','orders.order_total as order_total','orders.order_date as order_date','orders.order_number as order_number', 'merchant_orders.id as merchant_order_id', 'users.name as user_name','customers.name as customer_name')
//                ->latest()
                ->get();
        }

//return  $results;
        return view('admin.accounts.merchant-payble', [
            'merchant_orders' => $results,
        ]);
    }

    public function merchantPay(){
        return view('admin.accounts.merchant-pay', [
            'merchants'=>User::where('role','Merchant')->where('status',1)->get()
        ]);
    }

    public function getMerchantPaidAmount()
    {
//        abort_if(!userCan('merchant.pay.index'), 403);
        $merchant_id = $_GET['merchant_id'];
        $merchant_total_paids =  DB::table('orders')
            ->where('orders.order_status', 3)
            ->where('merchant_orders.merchant_id', $merchant_id)
            ->join('merchant_orders', 'orders.id', '=', 'merchant_orders.order_id')
            ->join('users', 'merchant_orders.merchant_id', '=', 'users.id')
            ->select(
                'merchant_orders.merchant_id',
//                    'users.name as merchant_name',
                DB::raw('SUM(orders.order_total) as total_order_amount')
            )
            ->groupBy('merchant_orders.merchant_id') // Group by merchant_id and merchant name
//                ->groupBy('merchant_orders.merchant_id', 'users.name') // Group by merchant_id and merchant name
            ->get();
        if(count($merchant_total_paids) > 0){
            foreach ($merchant_total_paids as $total_order_amount) {
                $commission = $total_order_amount->total_order_amount * 10/100;
                $total_order_amount =   $total_order_amount->total_order_amount - $commission;
            }
        }

        return response()->json(['total_order_amount' => $total_order_amount], 200);
    }


    public function merchantPayStore(Request $request)
    {
        // return $request->all();

        $results = DB::table('merchant_paids')
            ->where('merchant_paids.merchant_id', $request->merchant_id)
            ->select(
                'merchant_paids.merchant_id',
                DB::raw('SUM(merchant_paids.paid_amount) as total_paid_amount')
            )
            ->groupBy('merchant_paids.merchant_id') // Group by merchant_id and merchant name
            ->get();
        if(count($results) > 0){
            foreach ($results as $results){
                $total_paid_amount =   $results->total_paid_amount;
            }
        }else{
            $total_paid_amount = 0;
        }

//        abort_if(!userCan('merchant.pay.store'),403);
        $request->validate([
            'merchant_id'=>'required',
            'paid_amount'=>'required',
        ]);
        $this->product = MerchantPaid::newMerchantPaid($request,$total_paid_amount);
        Session::flash('success','Product added successfully');
        return redirect()->route('merchant.pay.index');
    }



}
