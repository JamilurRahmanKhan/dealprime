<?php

namespace App\Http\Controllers;

use App\Models\Compare;
use App\Models\ProductComperison;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{
    public function compare(){
        session(['url.intended' => url()->current()]);
          $compare = DB::table('compares')
            ->where('compares.customer_id', Auth::guard('customer')->user()->id)
            ->join('products', 'compares.product_id', '=', 'products.id')
            ->join('product_comperisons', 'compares.product_id', '=', 'product_comperisons.product_id')
            ->select(
                'compares.id as compare_id',
                'compares.product_id as product_id',
                'products.name as product_name',
                'products.image as p_image',
                DB::raw('GROUP_CONCAT(product_comperisons.key_name) as p_key_names'),
                DB::raw('GROUP_CONCAT(product_comperisons.key_value) as p_key_values')
            )
            ->groupBy('compares.id','compares.product_id', 'products.name', 'products.image')
            ->get()
            ->map(function ($item) {
                // Convert the concatenated strings to arrays
                $item->p_key_names = explode(',', $item->p_key_names);
                $item->p_key_values = explode(',', $item->p_key_values);
                return $item;
            });
        return view('website.compare.compare',[
            'compares'=> $compare
        ]);
    }
    public function compareStore($customer_id, $product_id){
//        return $product_id;
        $itemExist = Compare::where('customer_id', $customer_id)->where('product_id', $product_id)->first();
        if($itemExist){
            Session::flash('danger','Item is Already Added in Compare list');
            return back();
        }else{
            Compare::compareInfo($customer_id, $product_id);
            Session::flash('success','Compare product added successfully');
            return back();
        }
    }

    public function compareDelete($id){
        Compare::compareDelete($id);
        Session::flash('success','Compare Item Delete Successfully');
        return back();
    }
}
