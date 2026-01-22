<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Session;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('sub_subcategories.index'),403);
        return view('admin.sub_subCategory.index',[
           'subSubcategories'=>SubSubCategory::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('sub_subcategories.create'),403);

        return view('admin.sub_subCategory.create',[
            'categories'=> Category::where('status',1)->get(),
            'subcategories'=>SubCategory::where('status',1)->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('sub_subcategories.create'),403);
        SubSubCategory::subSubcategoryInfo($request);
        Session::flash('success','Sub sub-category Added successfully');
        return redirect()->route('sub_subcategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('sub_subcategories.edit'),403);
        SubSubCategory::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('sub_subcategories.edit'),403);
        return view('admin.sub_subCategory.edit',[
            'subSubcategory'=>SubSubCategory::find($id),
            'categories'=> Category::where('status',1)->get(),
            'subcategories'=>SubCategory::where('status',1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('sub_subcategories.edit'),403);
         SubSubCategory::subSubcategoryInfo($request,$id);
         Session::flash('success','Sub sub-category Updated successfully');
         return redirect()->route('sub_subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('sub_subcategories.destroy'),403);
        SubSubCategory::subSubcategoryDelete( $id);
        Session::flash('success','Sub-subCategory Delete successfully');
        return redirect()->route('sub_subcategories.index');
    }
}