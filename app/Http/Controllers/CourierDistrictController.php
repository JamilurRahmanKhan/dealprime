<?php

namespace App\Http\Controllers;

use App\Models\CourierDistrict;
use Illuminate\Http\Request;
use App\Models\CourierDivision;
use Illuminate\Support\Facades\Session;

class CourierDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('district.index'),403);
        return view('admin.courier_district.index',[
            'districts'=>CourierDistrict::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('district.create'),403);
        return view('admin.courier_district.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('district.create'),403);
        CourierDistrict::districtInfo($request);
        Session::flash('success','District Added successfully');
        return redirect()->route('district.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('district.edit'),403);
        CourierDistrict::checkStatus($id);
        Session::flash('success','Status Updated successfully');
        return redirect()->route('district.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('district.edit'),403);
        return view('admin.courier_district.edit',[
            'divisions'=>CourierDivision::where('status',1)->latest()->get(),
            'district'=>CourierDistrict::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('district.edit'),403);
        CourierDistrict::districtInfo($request,$id);
        Session::flash('success','District Update successfully');
        return redirect()->route('district.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('district.destroy'),403);
        CourierDistrict::districtDelete($id);
        Session::flash('success','District Deleted successfully');
        return redirect()->route('district.index');
    }
}