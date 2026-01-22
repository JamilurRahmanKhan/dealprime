<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('blog_categories.index'),403);
        return view('admin.blog_category.index',[
            'blogCategories'=>BlogCategory::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('blog_categories.create'),403);

        return view('admin.blog_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('blog_categories.create'),403);

        BlogCategory::blogCategoryInfo($request);
        Session::flash('success','Blog category created  successfully');
        return redirect()->route('blog_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('blog_categories.edit'),403);
        BlogCategory::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('blog_categories.edit'),403);
        return view('admin.blog_category.edit',[
            'blogCategory'=>BlogCategory::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('blog_categories.edit'),403);

        BlogCategory::blogCategoryInfo($request,$id);
        Session::flash('success','Blog category updated  successfully');
        return redirect()->route('blog_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('blog_categories.destroy'),403);

        BlogCategory::blogCategoryDelete($id);
        Session::flash('success','Blog Category Delete Successfully'); ;
        return redirect()->route('blog_categories.index');
    }
}