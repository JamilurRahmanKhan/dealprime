<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('couriers.index'),403);
        return view('admin.courier.index',[
            'couriers'=>Courier::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('couriers.create'),403);
        return view('admin.courier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('couriers.create'),403);
        Courier::courierInfo($request);
        Session::flash('success','Couriers Added successfully');
        return redirect()->route('couriers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('couriers.edit'),403);
        Courier::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('couriers.edit'),403);
        return view('admin.courier.edit',[
            'courier'=>Courier::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('couriers.edit'),403);
        Courier::courierInfo($request, $id);
        Session::flash('success','Couriers Updated successfully');
        return redirect()->route('couriers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('couriers.destroy'),403);
        Courier::courierDelete($id);
        Session::flash('success','Couriers Delete successfully');
        return redirect()->route('couriers.index');
    }
}
