<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('categories.index'),403);
        return view('admin.category.index',[
            'categories'=>Category::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('categories.create'),403);
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('categories.create'),403);
        Category::categoryInfo($request);
        Session::flash('success','Category Added successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        abort_if(!userCan('categories.edit'),403);
        Category::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('categories.edit'),403);

        return view('admin.category.edit',[
            'category'=>Category::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('categories.edit'),403);

        Category::categoryInfo($request,$id);
        Session::flash('success','Category Updated successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        abort_if(!userCan('categories.destroy'),403);
        Category::categoryDelete($id);
        Session::flash('success','Category Delete successfully');
        return redirect()->route('categories.index');
    }


    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json(['subcategories' => $subcategories]);
    }

    public function getSubsubcategories($subcategoryId)
    {
        $subsubcategories = SubSubCategory::where('sub_category_id', $subcategoryId)->get();
        return response()->json(['subsubcategories' => $subsubcategories]);
    }


}