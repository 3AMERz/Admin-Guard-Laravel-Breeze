<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{


    public function __construct()
    {
        $this->middleware('checkPermission:add_permission')->only(['create']);
        $this->middleware('checkPermission:show_permission')->only(['show']);
        $this->middleware('checkPermission:edit_permission')->only(['edit', 'update']);
        $this->middleware('checkPermission:delete_permission')->only(['destroy']);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::where('guard_name', 'admin')->get();
        return view('back.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:4|max:125|unique:permissions',
            'description' => 'required|string|min:4|max:125',
        ]);

        $namePer = str_replace(' ', '_', strtolower($request->name));
        Permission::create([
            'name' => $namePer,
            'description' => $request->description,
            'guard_name' => 'admin'
        ]);

        return redirect('/back/permissions');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::findOrfail($id);
        return view('back.permissions.show', ['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('back.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|min:4|max:125|unique:permissions,name,' . $id,
            'description' => 'required|string|min:4|max:125',
        ]);

        $namePer = str_replace(' ', '_', strtolower($request->name));
        $permission = Permission::findOrFail($id);

        $permission->update([
            'name' => $namePer,
            'description' => $request->description,
            'guard_name' => 'admin'
        ]);

        return redirect('/back/permissions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::destroy($id);
        return redirect('/back/permissions');
    }
}
