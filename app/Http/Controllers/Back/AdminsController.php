<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{


    public function __construct()
    {
        $this->middleware('checkPermission:add_admin')->only(['create']);
        $this->middleware('checkPermission:show_admin')->only(['show']);
        $this->middleware('checkPermission:edit_admin')->only(['edit', 'update']);
        $this->middleware('checkPermission:delete_admin')->only(['destroy']);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('back.admins.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $roles = Role::where('guard_name', 'admin')->get();
        return view('back.admins.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|unique:admins|max:255',
            'password' => 'required|string',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if($request->has('roles')){
            foreach($request->roles as $role){
                $admin->assignRole($role);
            }
        }

        

        return redirect('/back/admins');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::findOrfail($id);
        $rolesOfAdmin = $admin->roles;
        return view('back.admins.show', ['admin' => $admin, 'rolesOfAdmin' => $rolesOfAdmin]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::where('guard_name', 'admin')->get();
        return view('back.admins.edit', ['admin' => $admin, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'password' => 'required|string'
        ]);

        $admin = Admin::findOrFail($id);
        $password = (Hash::info($request->password)['algo'] === null) ? Hash::make($request->password) : $request->password;
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        $admin->syncRoles();
        if($request->has('roles')){
            foreach ($request->roles as $role) {
                $admin->assignRole($role);
            }
        }

        return redirect('/back/admins');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->syncRoles();
        Admin::destroy($id);
        return redirect('/back/admins');
    }
}
