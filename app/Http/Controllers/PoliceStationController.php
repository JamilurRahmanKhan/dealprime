<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoliceStation;
use App\Models\CourierDistrict;
use Illuminate\Support\Facades\Session;

class PoliceStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('police_station.index'),403);
        return view('admin.police_station.index',[
            'stations'=>PoliceStation::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('police_station.create'),403);
        return view('admin.police_station.create',[
            'districts'=>CourierDistrict::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('police_station.create'),403);
        // return $request->all();
        PoliceStation::policeStationInfo($request);
        Session::flash('success','Police Station Added successfully');
        return redirect()->route('police_station.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('police_station.edit'),403);
        PoliceStation::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('police_station.edit'),403);
        return view('admin.police_station.edit',[
            'districts'=>CourierDistrict::latest()->get(),
            'station'=>PoliceStation::find($id),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('police_station.edit'),403);
        PoliceStation::policeStationInfo($request,$id);
        Session::flash('success','Police Station Updated successfully');
        return redirect()->route('police_station.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('police_station.destroy'),403);
        PoliceStation::stationDelete($id);
        Session::flash('success','Police Station Deleted successfully');
        return redirect()->route('police_station.index');


    }
}