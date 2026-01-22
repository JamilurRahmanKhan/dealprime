<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('brands.index'),403);
        return view('admin.brand.index',[
            'brands'=>Brand::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('brands.create'),403);
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('brands.create'),403);
        Brand::brandInfo($request);
        Session::flash('success','Brand Added Successfully'); ;
        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('brands.edit'),403);
        Brand::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('brands.edit'),403);

        return view('admin.brand.edit',[
            'brand'=>Brand::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('brands.edit'),403);
        Brand::brandInfo($request,$id);
        Session::flash('success','Brand Updated Successfully'); ;
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        abort_if(!userCan('brands.destroy'),403);
        Brand::brandDelete($id);
        Session::flash('success','Brand Delete Successfully'); ;
        return redirect()->route('brands.index');

   }
}