<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('sizes.index'),403);

        return view('admin.size.index',[
            'sizes'=>Size::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('sizes.create'),403);
        return view('admin.size.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('sizes.create'),403);
        Size::sizeInfo($request);
        Session::flash('success','Size Added successfully');
        return redirect()->route('sizes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('sizes.edit'),403);
        Size::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('sizes.edit'),403);

        return view('admin.size.edit',[
            'size'=>Size::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('sizes.edit'),403);
        Size::sizeInfo($request,$id);
        Session::flash('success','Size Updated successfully');
        return redirect()->route('sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('sizes.destroy'),403);
        Size::sizeDelete($id);
        Session::flash('success','Size Delete successfully');
        return redirect()->route('sizes.index');
    }
}