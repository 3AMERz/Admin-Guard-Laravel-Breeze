<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'add_admin',
                'description' => 'Make you able to add admin'
            ],
            [
                'name' => 'show_admin',
                'description' => 'Make you able to show admin'
            ],
            [
                'name' => 'edit_admin',
                'description' => 'Make you able to edit admin'
            ],
            [
                'name' => 'delete_admin',
                'description' => 'Make you able to delete admin'
            ],
            
            [
                'name' => 'add_user',
                'description' => 'Make you able to add user'
            ],
            [
                'name' => 'show_user',
                'description' => 'Make you able to show user'
            ],
            [
                'name' => 'edit_user',
                'description' => 'Make you able to edit user'
            ],
            [
                'name' => 'delete_user',
                'description' => 'Make you able to delete user'
            ],

            [
                'name' => 'add_role',
                'description' => 'Make you able to add role'
            ],
            [
                'name' => 'show_role',
                'description' => 'Make you able to show role'
            ],
            [
                'name' => 'edit_role',
                'description' => 'Make you able to edit role'
            ],
            [
                'name' => 'delete_role',
                'description' => 'Make you able to delete role'
            ],

            [
                'name' => 'add_permission',
                'description' => 'Make you able to add permission'
            ],
            [
                'name' => 'show_permission',
                'description' => 'Make you able to show permission'
            ],
            [
                'name' => 'edit_permission',
                'description' => 'Make you able to edit permission'
            ],
            [
                'name' => 'delete_permission',
                'description' => 'Make you able to delete permission'
            ],

            [
                'name' => 'add_post',
                'description' => 'Make you able to add post'
            ],
            [
                'name' => 'show_post',
                'description' => 'Make you able to show post'
            ],
            [
                'name' => 'edit_post',
                'description' => 'Make you able to edit post'
            ],
            [
                'name' => 'delete_post',
                'description' => 'Make you able to delete post'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], [
                'name' => $permission['name'],
                'description' => $permission['description'],
                'guard_name' => 'admin',
            ]);
        }
    }
}
