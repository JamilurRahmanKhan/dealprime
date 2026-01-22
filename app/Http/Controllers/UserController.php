<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('user.index'),403);
        return view('admin.user.index',[
            'users'=>User::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('user.create'),403);
        return view('admin.user.create',[
            'roles'=>Role::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('user.create'),403);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:11|unique:users,phone',
            'shop_name' => 'nullable',
            'password' => 'required|min:8|confirmed',
            'role'=>'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->shop_name = $request->shop_name;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = $request->status;
        if($request->file('profile_photo_path')){
        $user->profile_photo_path = imageUpload($request->profile_photo_path, 'adminAsset/user/', 'user');
        }
        $user->save();
        $user->syncRoles($request->role);
        Session::flash('success','User Added Successfully');
        return redirect()->route('user.index');


       }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!userCan('user.edit'), 403);
        $user= User::find($id);
        if ($user->status == 1){
            $user->status = 0;
        }
        else{
            $user->status = 1;
        }
        $user->save();
        Session::flash('success','Status Update Successfully');
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('user.edit'), 403);
        return view('admin.user.edit',[
            'user'=>User::find($id),
            'roles'=>Role::latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('user.edit'),403);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|min:11|unique:users,phone,' . $id,
            'shop_name' => 'nullable',
            'password' => 'required|min:8|confirmed',
            'role'=>'required',
            'profile_photo_path' => 'nullable|image',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->shop_name = $request->shop_name;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = $request->status;
        if($request->file('profile_photo_path')){
            if(file_exists($user->profile_photo_path)){
                unlink($user->profile_photo_path);
            }
            $user->profile_photo_path = imageUpload($request->profile_photo_path, 'adminAsset/user/', 'user');
        }
        $user->save();
        $user->syncRoles($request->role);
        Session::flash('success','User Update Successfully');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('user.destroy'), 403);
        $user=User::find($id);
        if(file_exists($user->profile_photo_path)){
            unlink($user->profile_photo_path);
        }
        $user->delete();
        Session::flash('success','User Delete Successfully');
        return redirect()->route('user.index');

    }
}