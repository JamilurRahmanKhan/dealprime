<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ComboProduct;
use Illuminate\Http\Request;
use App\Models\ComboProductDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ComboProductController extends Controller
{
    private $combo;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('combo_product.index'),403);
        if (Auth::user()->role == 'Admin') {
            $comboProduct = ComboProduct::latest()->get();
        } elseif (Auth::user()->role == 'Merchant') {
            $comboProduct = ComboProduct::where('merchant_id', Auth::user()->id)->latest()->get();
        }
        return view('admin.combo_product.index',[
            // 'combos'=>ComboProduct::latest()->get(),
            'combos'=>$comboProduct,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('combo_product.create'),403);
        if(Auth::user()->role == 'Admin'){
            $products = Product::where('status',1)->get();
        }elseif(Auth::user()->role == 'Merchant'){
            $products = Product::where('status',1)->where('merchant_id',Auth::user()->id)->get();
        }
        return view('admin.combo_product.create',[
            'products'=>$products,
            'merchants'=>User::where('role','Merchant')->where('status',1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('combo_product.create'),403);
      $this->combo = ComboProduct::comboInfo($request);
      ComboProductDetail::comboProductDetailsStore($request->product_id , $this->combo->id);
       Session::flash('success','Combo product Added successfully');
       return redirect()->route('combo_product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('combo_product.show'),403);
        return view('admin.combo_product.show',[
            'combo'=>ComboProduct::find($id),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('combo_product.edit'),403);
        return view('admin.combo_product.edit',[
            'products'=>Product::where('status',1)->get(),
            'combo'=>ComboProduct::find($id),
            'merchants'=>User::where('role','Merchant')->where('status',1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('combo_product.edit'),403);
        $this->combo = ComboProduct::comboUpdate($request,$id);
        ComboProductDetail::comboProductDetailsUpdate($request->product_id , $this->combo->id);
        Session::flash('success','Combo product Updated successfully');
        return redirect()->route('combo_product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComboProduct $comboProduct)
    {
        abort_if(!userCan('combo_product.destroy'),403);
        ComboProduct::comboDelete($comboProduct);
        Session::flash('success','Combo product Delete  successfully');
        return redirect()->route('combo_product.index');

    }
    public function comboStatus($id){
        abort_if(!userCan('combo_product.edit'),403);
        ComboProduct::checkStatus($id);
        return back()->with('success','Status is updated');
    }
}