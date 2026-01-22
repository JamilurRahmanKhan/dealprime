<?php

namespace App\Http\Controllers;

use App\Models\Merchant_order;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function Laravel\Prompts\select;

class ReportController extends Controller
{


    public function salesReport(Request $request)
    {
        abort_if(!userCan('sales.report'), 403);
        $today = date('Y-m-d');
//        Session::Put('date_from',$request->date_from);
        Session::put('date_from', $request->date_from);
        Session::put('date_to', $request->date_to);
        $merchant = DB::table('users')
          ->select('users.id', 'users.name')
          ->where('role', 'Merchant')
          ->get();
        $user = Auth::user();
        if ($user->role == 'Admin') {
            if($request->merchant_id != '' ||  $request->merchant_id !=null){
                $results = DB::table('orders')
                    ->where('orders.order_status', 3)
//                    ->whereBetween('order_date',[Carbon::parse($request->date_from)->format('Y-m-d'), Carbon::parse($request->date_to)->format('Y-m-d')])
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.merchant_id', $request->merchant_id)
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('users', 'order_details.merchant_id', '=', 'users.id')
                    ->select(
                        'orders.id as order_id',
                        'orders.order_date as order_date',
                        'orders.order_total as order_total',
                        'orders.order_number as order_number',
                        'products.name as product_name',
                        'products.type as type',
                        'order_details.qty as qty',
                        'order_details.selling_price as selling_price',
                        'users.name as user_name'
                    )
                    ->orderBy('order_number','desc')
                    ->get();
            }else if(($request->date_from != '' ||  $request->date_from !=null) && $request->date_to != '' ||  $request->date_to !=null){
                 $results = DB::table('orders')
                    ->where('orders.order_status', 3)
                    ->whereBetween('order_date',[Carbon::parse($request->date_from)->format('Y-m-d'), Carbon::parse($request->date_to)->format('Y-m-d')])
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('users', 'order_details.merchant_id', '=', 'users.id')
                    ->select(
                        'orders.id as order_id',
                        'orders.order_date as order_date',
                        'orders.order_total as order_total',
                        'orders.order_number as order_number',
                        'products.name as product_name',
                        'products.type as type',
                        'order_details.qty as qty',
                        'order_details.selling_price as selling_price',
                        'users.name as user_name'
                    )
                    ->orderBy('order_number','desc')
                    ->get();
            }else{
                $results = DB::table('orders')
                    ->where('orders.order_status', 3)
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('users', 'order_details.merchant_id', '=', 'users.id')
                    ->select(
                        'orders.id as order_id',
                        'orders.order_date as order_date',
                        'orders.order_total as order_total',
                        'orders.order_number as order_number',
                        'products.name as product_name',
                        'products.type as type',
                        'order_details.qty as qty',
                        'order_details.selling_price as selling_price',
                        'users.name as user_name'
                    )
                    ->orderBy('order_number','desc')
                    ->get();
            }

//            return $results;
        }elseif ($user->role == 'Merchant') {
            $results = DB::table('orders')
                ->where('orders.order_status', 3)
                ->whereBetween('order_date',[Carbon::parse($request->date_from)->format('Y-m-d'), Carbon::parse($request->date_to)->format('Y-m-d')])
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.merchant_id', $user->id)
//                ->join('merchant_orders', 'orders.id', '=', 'merchant_orders.order_id')
                ->join('users',  'order_details.merchant_id','=', 'users.id')
                ->where('users.role', 'Merchant')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select('orders.id as order_id','orders.order_total as order_total','orders.order_number as order_number', 'order_details.selling_price as selling_price', 'users.name as user_name','customers.name as customer_name')
//                ->latest()
                ->get();
        }

//return  $results;
        return view('admin.report.sales-report', [
            'sales_reports' => $results,
             'users'=>$merchant
        ]);
    }

    public function dailySales(){
        abort_if(!userCan('daily.sales.report'), 403);
        $toDayDate = date('Y-m-d');
        $user = Auth::user();
        if ($user->role == 'Admin') {
            $results = DB::table('orders')
                ->where('orders.order_status', 3)
                ->where('orders.order_date', $toDayDate)
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
//                ->join('merchant_orders', 'orders.id', '=', 'merchant_orders.order_id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
//                ->join('merchant_orders', 'orders.id', '=', 'merchant_orders.order_id')
                ->join('users', 'order_details.merchant_id', '=', 'users.id')
//                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select(
                    'orders.id as order_id',
                    'orders.order_date as order_date',
                    'orders.order_total as order_total',
                    'orders.order_number as order_number',
                    'products.name as product_name',
                    'products.type as type',
                    'order_details.qty as qty',
                    'order_details.selling_price as selling_price',
                    'users.name as user_name'
                )
                ->orderBy('order_number','desc')
                ->get();

        }elseif ($user->role == 'Merchant') {
            $results = DB::table('orders')
                ->where('orders.order_status', 3)
                ->where('orders.order_date', $toDayDate)
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.merchant_id', $user->id)
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('users', 'order_details.merchant_id', '=', 'users.id')
                ->select(
                    'orders.id as order_id',
                    'orders.order_date as order_date',
                    'orders.order_total as order_total',
                    'orders.order_number as order_number',
                    'products.name as product_name',
                    'products.type as type',
                    'order_details.qty as qty',
                    'order_details.selling_price as selling_price',
                    'users.name as user_name'
                )
                ->orderBy('order_number','desc')
                ->get();
        }

//return  $results;
        return view('admin.report.daily-sales-report', [
            'sales_reports' => $results,
        ]);
    }

    public function monthlySales(Request $request){

        abort_if(!userCan('monthly.sales.report'), 403);
        $merchant = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('role', 'Merchant')
            ->get();
        Session::put('my_month_year', Carbon::parse($request->my_month_year)->format('m-Y'));
        $toMonthDate = date('m');
        $user = Auth::user();
        if ($user->role == 'Admin') {
            if($request->merchant_id != '' ||  $request->merchant_id !=null){
                $results = DB::table('orders')
                    ->where('orders.order_status', 3)
//                    ->whereMonth('orders.order_date', '=', Carbon::parse($request->my_month_year)->format('m')) // Filter by the current month
//                    ->whereYear('orders.order_date', '=',  Carbon::parse($request->my_month_year)->format('Y'))
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.merchant_id', $request->merchant_id)
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('users', 'order_details.merchant_id', '=', 'users.id')
                    ->select(
                        'orders.id as order_id',
                        'orders.order_date as order_date',
                        'orders.order_total as order_total',
                        'orders.order_number as order_number',
                        'products.name as product_name',
                        'products.type as type',
                        'order_details.qty as qty',
                        'order_details.selling_price as selling_price',
                        'users.name as user_name'
                    )
                    ->orderBy('order_number','desc')
                    ->get();
            }else{
                $results = DB::table('orders')
                    ->where('orders.order_status', 3)
                    ->whereMonth('orders.order_date', '=', Carbon::parse($request->my_month_year)->format('m')) // Filter by the current month
                    ->whereYear('orders.order_date', '=',  Carbon::parse($request->my_month_year)->format('Y'))
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('users', 'order_details.merchant_id', '=', 'users.id')
                    ->select(
                        'orders.id as order_id',
                        'orders.order_date as order_date',
                        'orders.order_total as order_total',
                        'orders.order_number as order_number',
                        'products.name as product_name',
                        'products.type as type',
                        'order_details.qty as qty',
                        'order_details.selling_price as selling_price',
                        'users.name as user_name'
                    )
                    ->orderBy('order_number','desc')
                    ->get();
            }


        }elseif ($user->role == 'Merchant') {
            $results = DB::table('orders')
                ->where('orders.order_status', 3)
                ->whereMonth('orders.order_date', '=', Carbon::parse($request->my_month_year)->format('m')) // Filter by the current month
                ->whereYear('orders.order_date', '=',  Carbon::parse($request->my_month_year)->format('Y'))
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.merchant_id', $user->id)
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('users', 'order_details.merchant_id', '=', 'users.id')
                ->select(
                    'orders.id as order_id',
                    'orders.order_date as order_date',
                    'orders.order_total as order_total',
                    'orders.order_number as order_number',
                    'products.name as product_name',
                    'products.type as type',
                    'order_details.qty as qty',
                    'order_details.selling_price as selling_price',
                    'users.name as user_name'
                )
                ->orderBy('order_number','desc')
                ->get();
        }

        return view('admin.report.monthly-sales-report', [
            'sales_reports' => $results,
            'users' => $merchant
        ]);
    }


}
