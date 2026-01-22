<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('colors.index'),403);
        return view('admin.color.index',[
            'colors'=>Color::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('colors.create'),403);
        return view('admin.color.create',[
            'categories'=>Category::where('status',1)->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        abort_if(!userCan('colors.create'),403);
        Color::colorInfo($request);
        Session::flash('success','Color Add Successfully');
        return redirect()->route('colors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('colors.edit'),403);
        Color::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('colors.edit'),403);
        return view('admin.color.edit',[
            'color'=>Color::find($id),
            'categories'=>Category::where('status',1)->latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('colors.edit'),403);
        Color::colorInfo($request,$id);
        Session::flash('success','Color update Successfully');
        return redirect()->route('colors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('colors.destroy'),403);
        Color::colorDelete($id);
        Session::flash('success','Color Delete Successfully');
        return redirect()->route('colors.index');
    }
}