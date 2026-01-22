<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StockManagementController extends Controller
{
    public function stockManage(){
        abort_if(!userCan('stock.index'),403);
        if (Auth::user()->role == 'Admin') {
            $products = Product::latest()->get();
        } elseif (Auth::user()->role == 'Merchant') {
            $products = Product::where('merchant_id', Auth::user()->id)->latest()->get();
        }elseif(Auth::user()->role=='Editor'){
            $products = Product::where('merchant_id', Auth::user()->id)->latest()->get();
        }
        return view('admin.stock-management.index',[
            'products'=>$products,

        ]);
    }
    public function stockUpdate(Request $request, $id){
        abort_if(!userCan('stock.edit'),403);
        $request->validate([
            'stock_amount'=>'required',
        ]);
        $stock = Product::find($id);
        $stock->stock_amount=$request->stock_amount;
        $stock->save();
        Session::flash('success','Stock amount updated successfully');
        return redirect()->route('stock.index');
    }
}