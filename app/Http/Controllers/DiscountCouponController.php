<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCoupon;
use Illuminate\Support\Facades\Session;

class DiscountCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('coupon.index'),403);
        return view('admin.coupon.index',[
            'coupons'=>DiscountCoupon::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('coupon.create'),403);
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('coupon.create'),403);
        DiscountCoupon::couponInfo($request);
        Session::flash('success','Discount Coupon Added successfully');
        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('coupon.edit'),403);

        DiscountCoupon::checkStatus($id);
        Session::flash('success','Status Updated successfully');
        return redirect()->route('coupon.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('coupon.edit'),403);
        
        return view('admin.coupon.edit',[
            'coupon'=>DiscountCoupon::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('coupon.edit'),403);
        DiscountCoupon::couponInfo($request,$id);
        Session::flash('success','Discount Coupon Update successfully');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('coupon.destroy'),403);
        DiscountCoupon::couponDelete($id);
        Session::flash('success','Discount Coupon Delete successfully');
        return redirect()->route('coupon.index');
    }
}