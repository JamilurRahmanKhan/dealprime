<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('units.index'),403);
        return view('admin.unit.index',[
            'units'=>Unit::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('units.create'),403);
        return view('admin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('units.create'),403);
        Unit::unitInfo($request);
        Session::flash('success','Unit Added successfully');
        return redirect()->route('units.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('units.edit'),403);
        Unit::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('units.edit'),403);
        return view('admin.unit.edit',[
            'unit'=>Unit::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('units.edit'),403);
        Unit::unitInfo($request, $id);
        Session::flash('success','Unit Updated successfully');
        return redirect()->route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('units.destroy'),403);
        Unit::unitDelete($id);
        Session::flash('success','Unit Deleted successfully');
        return redirect()->route('units.index');
    }
}