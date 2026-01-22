<?php

namespace App\Http\Controllers;

use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('blog_tags.index'),403);
        return view('admin.blog_tag.index',[
            'blog_tags'=>BlogTag::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('blog_tags.create'),403);
        return view('admin.blog_tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('blog_tags.create'),403);
        BlogTag::BlogTagInfo($request);
        Session::flash('success','Blog Tag Added successfully');
        return redirect()->route('blog_tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('blog_tags.edit'),403);
        BlogTag::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('blog_tags.edit'),403);
        return view('admin.blog_tag.edit',[
            'blogTag'=>BlogTag::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('blog_tags.edit'),403);
        BlogTag::BlogTagInfo($request,$id);
        Session::flash('success','Blog Tag Updated successfully');
        return redirect()->route('blog_tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('blog_tags.destroy'),403);
        BlogTag::blogTagDelete($id);
        Session::flash('success','Blog Tag Delete successfully');
        return redirect()->route('blog_tags.index');


    }
}