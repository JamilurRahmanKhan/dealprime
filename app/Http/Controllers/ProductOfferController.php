<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('products_offers.index'),403);
        return view('admin.product_offer.index',[
            'product_offers'=>ProductOffer::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('products_offers.create'),403);
        return view('admin.product_offer.create',[
            'products'=>Product::where('status',1)->latest()->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('products_offers.create'),403);
        ProductOffer::ProductOfferInfo($request);
        Session::flash('success','Products Offer product add successfully');
        return redirect()->route('products_offers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // abort_if(!userCan('products_offers.show'),403);
        // return view('admin.product_offer.show',[
        //     'product_offer'=>ProductOffer::find($id),
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('products_offers.edit'),403);
        return view('admin.product_offer.edit',[
            'products'=>Product::where('status',1)->latest()->get(),
            'product_offer'=>ProductOffer::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('products_offers.edit'),403);
        ProductOffer::ProductOfferInfo($request,$id);
        Session::flash('success','Products Offer product updated successfully');
        return redirect()->route('products_offers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('products_offers.destroy'),403);
        ProductOffer::productOfferDelete($id);
        Session::flash('success','Product Offer  Delete successfully');
        return redirect()->route('products_offers.index');
    }

    public function productOfferStatus(string $id)
    {
        abort_if(!userCan('products_offers.edit'),403);
        ProductOffer::checkStatus($id);
        Session::flash('success','Status Updated successfully');
        return redirect()->route('products_offers.index');
    }
}