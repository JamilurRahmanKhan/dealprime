<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         abort_if(!userCan('faq.index'),403);
        return view('admin.faq.index',[
            'faqs'=>Faq::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('faq.create'),403);
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('faq.create'),403);
        // return $request->all();
        Faq::faqInfo($request);
        Session::flash('success','Faq added successfully');
        return redirect()->route('faq.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('faq.edit'),403);
        Faq::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('faq.edit'),403);
        return view('admin.faq.edit',[
            'faq'=>Faq::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('faq.edit'),403);
        Faq::faqInfo($request,$id);
        Session::flash('success','Faq update successfully');
        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('faq.destroy'),403);
        Faq::faqInfo($id);
        Session::flash('success','Faq delete successfully');
        return redirect()->route('faq.index');
    }
}
