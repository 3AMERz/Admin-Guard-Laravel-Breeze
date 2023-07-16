<?php

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

    function permission($permission){
        return Auth::guard('admin')->user()->hasAnyPermission($permission) ? true : false ;
    }

    function getAllPermissionNames(){
        $permissionNames = [];
        foreach(Permission::all() as $permission){
            array_push($permissionNames, $permission->name);
        }
        return $permissionNames;
    }

    function getAllRoleNames(){
        $roleNames = [];
        foreach(Role::all() as $role){
            array_push($roleNames, $role->name);
        }
        return $roleNames;
    }

?>