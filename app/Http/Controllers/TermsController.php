<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('terms.index'),403);
        return view('admin.terms_and_condition.index',[
            'terms'=>Term::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('terms.create'),403);
        return view('admin.terms_and_condition.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('terms.create'),403);
        Term::termsInfo($request);
        Session::flash('success','Terms and condition added successfully');
        return redirect()->route('terms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
        abort_if(!userCan('terms.edit'),403);
        $term = Term::find($id);
          $current_user_type=$term->user_type;
        return view('admin.terms_and_condition.edit',[
            'term'=>Term::find($id),
            'current_user_type' => $current_user_type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('terms.edit'),403);
        Term::termsInfo($request,$id);
        Session::flash('success','Terms and condition added successfully');
        return redirect()->route('terms.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('terms.destroy'),403);
        Term::termsDelete($id);
        Session::flash('success','Terms and condition delete successfully');
        return redirect()->route('terms.index');
    }
      public function getTermPositions(Request $request)
    {
        $userType = $request->input('user_type');
        $positions = Term::where('user_type', $userType)
            ->pluck('terms_type')
            ->toArray();

        return response()->json($positions);
    }
}