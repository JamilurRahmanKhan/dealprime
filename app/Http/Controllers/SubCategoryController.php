<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('sub_categories.index'),403);
        return view('admin.sub-category.index',[
            'subcategories'=>SubCategory::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('sub_categories.create'),403);
        return view('admin.sub-category.create',[
            'categories'=> Category::where('status',1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('sub_categories.create'),403);
        SubCategory::subCategoryInfo($request);
        Session::flash('success','Sub Category Added successfully');
        return redirect()->route('sub_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        abort_if(!userCan('sub_categories.edit'),403);
        SubCategory::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('sub_categories.edit'),403);
        return view('admin.sub-category.edit',[
            'subCategory'=>SubCategory::find($id),
            'categories'=> Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('sub_categories.edit'),403);
        SubCategory::subCategoryInfo($request, $id);
        Session::flash('success','Sub Category updated successfully');
        return redirect()->route('sub_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('sub_categories.destroy'),403);
        SubCategory::subCategoryDelete( $id);
        Session::flash('success','Sub Category updated successfully');
        return redirect()->route('sub_categories.index');
    }
}