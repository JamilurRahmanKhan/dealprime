<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('settings.index'),403);
        return view('admin.setting.index',[
            'setting'=>Setting::first(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('settings.create'),403);
        return view('admin.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('settings.create'),403);
        Setting::newSetting($request);
        Session::flash('success','New Record is created successfully.');
        return redirect()->route('settings.index');
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
        abort_if(!userCan('settings.edit'),403);
        return view('admin.setting.edit',[
            'setting'=>Setting::find($id),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Setting $setting)
    {
        abort_if(!userCan('settings.edit'),403);
        Setting::updateSetting($request, $setting);
        Session::flash('success','Record updated. successfully.');
        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function cacheClear()
    {
        Artisan::call('optimize:clear');
        Session::flash('success','Cache Clear Successfully.');
        return redirect()->route('settings.index');
    }
}