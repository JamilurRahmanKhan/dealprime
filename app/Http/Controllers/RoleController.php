<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('role.index'),403);
        return view('admin.role.index',[
            'roles'=>Role::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('role.create'),403);
        $permissions = Permission::where('group_name', '!=', 'others')
        ->get()
        ->groupBy('group_name')
        ->sortByDesc(function ($group) {
            return $group->count();
        });
        return view('admin.role.create',[
             'permissions'=>$permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('role.create'),403);
         $request->validate( [
            'name' => 'required|unique:roles,name',
            'description' => 'required',
            'permissions' => 'required',
        ]);

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permissions')
        );

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
            'description'=>$request->description
        ]);
        $role->syncPermissions($permissionsID);
        $role->save();

        Session::flash('success','Role Added Successfully');
        return redirect()->route('role.index');
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
        abort_if(!userCan('role.edit'),403);
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::where('group_name', '!=', 'others')
            ->get()
            ->groupBy('group_name')
            ->sortByDesc(function ($group) {
                return $group->count();
            });
        return view('admin.role.edit',[
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Role $role)
    {
        abort_if(!userCan('role.edit'),403);
        $request->validate( [
            'name' => 'required|unique:roles,name,' . $role->id,
            'description' => 'required',
            'permissions' => 'required',
        ]);

        $role->update($request->only('name', 'description'));
        $role->permissions()->sync($request->input('permissions', []));
        Session::flash('success','Role Updated Successfully');
        return redirect()->route('role.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('role.destroy'),403);
        $role=Role::find($id);
        $role->delete();
        Session::flash('success','Role Delete  Successfully');
        return redirect()->route('role.index');

    }
}