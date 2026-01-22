<?php

namespace App\Http\Controllers;

use App\Models\PopUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('popups.index'),403);

        return view('admin.pop_up.index',[
            'popUps'=>PopUp::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('popups.create'),403);
        return view('admin.pop_up.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       abort_if(!userCan('popups.create'),403);
        PopUp::popUpInfo($request);
        Session::flash('success','PopUp Added successfully');
        return redirect()->route('popups.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       abort_if(!userCan('popups.edit'),403);
        PopUp::checkStatus($id);
        return back()->with('success','Status is updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       abort_if(!userCan('popups.edit'),403);

        return view('admin.pop_up.edit',[
            'popUps'=>PopUp::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('popups.edit'),403);
        PopUp::popUpInfo($request,$id);
        Session::flash('success','PopUp Updated successfully');
        return redirect()->route('popups.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('popups.destroy'),403);
        PopUp::popUpDelete($id);
        Session::flash('success','PopUp Delete successfully');
        return redirect()->route('popups.index');
    }
}