<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('carousels.index'),403);
        return view('admin.carousel.index',[
            'carousels'=>Carousel::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('carousels.create'),403);
        return view('admin.carousel.create',[
            'products'=>Product::where('status',1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('carousels.create'),403);
        Carousel::carouselInfo($request);
        Session::flash('success','Carousel Added Successfully'); ;
        return redirect()->route('carousels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('carousels.edit'),403);
        Carousel::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('carousels.edit'),403);
        return view('admin.carousel.edit',[
            'carousel'=>Carousel::find($id),
            'products'=>Product::where('status',1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('carousels.edit'),403);
        Carousel::carouselInfo($request,$id);
        Session::flash('success','Carousel Updated Successfully'); ;
        return redirect()->route('carousels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('carousels.destroy'),403);
        Carousel::carouselDelete($id);
        Session::flash('success','Carousel Delete Successfully'); ;
        return redirect()->route('carousels.index');
    }
}