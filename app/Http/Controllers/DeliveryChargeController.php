<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryCharge;
use Illuminate\Support\Facades\Session;

class DeliveryChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('delivery_charge.index'),403);
        return view('admin.delivery-charge.index',[
            'deliveryCharges'=>DeliveryCharge::latest()->get(),
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('delivery_charge.create'),403);
        return view('admin.delivery-charge.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('delivery_charge.create'),403);
        DeliveryCharge::chargeInfo($request); 
        Session::flash('success','Delivery charge info added successfully');
        return redirect()->route('delivery_charge.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('delivery_charge.edit'),403);
        DeliveryCharge::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('delivery_charge.edit'),403);
        return view('admin.delivery-charge.edit',[
            'charge'=>DeliveryCharge::find($id), 
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('delivery_charge.edit'),403);
        DeliveryCharge::chargeInfo($request,$id); 
        Session::flash('success','Delivery charge info updated successfully');
        return redirect()->route('delivery_charge.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('delivery_charge.destroy'),403);
        DeliveryCharge::faqDelete($id);
        Session::flash('success','Delivery charge delete successfully');
        return redirect()->route('delivery_charge.index');

    }
}
