<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;




class RolesController extends Controller
{


    public function __construct()
    {
        $this->middleware('checkPermission:add_role')->only(['create']);
        $this->middleware('checkPermission:show_role')->only(['show']);
        $this->middleware('checkPermission:edit_role')->only(['edit', 'update']);
        $this->middleware('checkPermission:delete_role')->only(['destroy']);
    }



    public $icons = ['rocket', 'user', 'crown', 'server', 'shield', 'lock' , 
    'badge-check', 'been-here', 'bell', 'book-open', 'calculator', 'calendar-check', 
    'calendar' , 'cctv' , 'cart', 'cart-alt', 'coin-stack', 'code-block',
    'cloud', 'conversation', 'data', 'desktop', 'detail', 'diamond', 'envelope',
    'extension', 'hdd', 'folder-plus', 'folder-minus', 'image', 'images', 'key', 
    'link', 'link-alt', 'medal', 'phone-call', 'restaurant',
    'shield-quarter', 'shopping-bag', 'support'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('back.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::where('guard_name', 'admin')->get();
        return view('back.roles.create', ['permissions' => $permissions, 'icons' => $this->icons]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|min:3|max:191|unique:roles',
            'description' => 'required|string|min:4|max:191',
            'icon' => 'required|string',
            // 'permissions' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
            'guard_name' => 'admin'
        ]);

        if($request->has('permissions')){
            foreach ($request->permissions as $permissions) {
                $role->givePermissionTo($permissions);
            }
        }

        return redirect('/back/roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrfail($id);
        $permissionsOfRole = $role->permissions;
        return view('back.roles.show', ['role' => $role, 'permissionsOfRole' => $permissionsOfRole]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);

        $permissionsOfRole = [];
        foreach ($role->permissions as $permission) {
            array_push($permissionsOfRole, $permission->name);
        }        

        return view('back.roles.edit', [
            'permissions' => $permissions, 
            'role' => $role, 
            'icons' => $this->icons,
            'permissionsOfRole' => $permissionsOfRole
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->validate([
            'name' => 'required|string|min:3|max:191|unique:roles,name,' . $id,
            'description' => 'required|min:4|string|max:191',
            'icon' => 'required|string',
            // 'permissions' => 'required'
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        $role->syncPermissions();
        if($request->has('permissions')){
            foreach($request->permissions as $permission){
                $role->givePermissionTo($permission);
            }
        }

        return redirect('/back/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return redirect('/back/roles');
    }
}
