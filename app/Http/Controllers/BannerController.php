<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         abort_if(!userCan('banner.index'),403);
        return view('admin.banner.index',[
            'banners'=>Banner::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         abort_if(!userCan('banner.create'),403);
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         abort_if(!userCan('banner.create'),403);
        // return $request->all();

        Banner::bannerInfo($request);
        Session::flash('success','Banner added successfully');
        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         abort_if(!userCan('banner.edit'),403);
        return view('admin.banner.edit',[
            'banner'=>Banner::find($id) ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          abort_if(!userCan('banner.edit'),403);
         Banner::bannerInfo($request,$id);
         Session::flash('success','Banner update successfully');
         return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // abort_if(!userCan('banner.destroy'),403);
    }

    public function getBannerPositions()
{
    $positions = Banner::pluck('banner_position')->toArray();
    return response()->json($positions);
}
}
