<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('tags.index'),403);
        return view('admin.tag.index',[
            'tags'=>Tag::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('tags.create'),403);
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('tags.create'),403);
        Tag::tagInfo($request);
        Session::flash('success','Tag Added successfully');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('tags.edit'),403);
        Tag::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('tags.edit'),403);
        return view('admin.tag.edit',[
            'tag'=>Tag::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('tags.edit'),403);
        Tag::tagInfo($request,$id);
        Session::flash('success','Tag Updated successfully');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('tags.destroy'),403);
        Tag::tagDelete($id);
        Session::flash('success','Tag Deleted successfully');
        return redirect()->route('tags.index');
    }
}