<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('abouts.index'),403);
        return view('admin.about.index',[
            'abouts'=>About::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('abouts.create'),403);
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('abouts.create'),403);
        About::aboutInfo($request);
        Session::flash('success','About Added Successfully'); ;
        return redirect()->route('abouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('abouts.edit'),403);
        About::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('abouts.edit'),403);
        
        return view('admin.about.edit',[
            'about'=>About::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('abouts.edit'),403);
        About::aboutInfo($request,$id);
        Session::flash('success','About Updated Successfully'); ;
        return redirect()->route('abouts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_if(!userCan('abouts.destroy'),403);
    }
}
