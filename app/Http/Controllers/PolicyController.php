<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         abort_if(!userCan('policy.index'),403);
        return view('admin.policy.index',[
            'policys'=>Policy::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         abort_if(!userCan('policy.create'),403);
        return view('admin.policy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         abort_if(!userCan('policy.create'),403);
        // return $request->all();
        Policy::policyInfo($request);
        Session::flash('success','Policy added successfully');
        return redirect()->route('policy.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('policy.edit'),403);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         abort_if(!userCan('policy.edit'),403);
        return view('admin.policy.edit',[
            'policy'=>Policy::find($id),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         abort_if(!userCan('policy.edit'),403);
        Policy::policyInfo($request,$id);
        Session::flash('success','Policy updated successfully');
        return redirect()->route('policy.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         abort_if(!userCan('policy.destroy'),403);
        Policy::policyDelete($id);
        Session::flash('success','Policy delete successfully');
        return redirect()->route('policy.index');


    }
}
