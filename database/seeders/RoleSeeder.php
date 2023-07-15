<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $allPermission = (['add_admin', 'show_admin','edit_admin','delete_admin',
        // 'add_user', 'show_user','edit_user','delete_user',
        // 'add_role', 'show_role','edit_role','delete_role',
        // 'add_permission', 'show_permission','edit_permission','delete_permission',
        // 'add_post', 'show_post','edit_post','delete_post']);

        $allPermission = (new Permission)->getAllPermissionNames();

        function getPerNames($indexes){
            $allPermission = (new Permission)->getAllPermissionNames();
            $perNames=[];

            foreach($indexes as $index){
                array_push($perNames, $allPermission[$index]);
            }
            return $perNames;
        }

        

        $roles = array(
            ['name' => 'Owner',
            'description' => 'It has all permission',
            'icon' => 'crown',
            'permissons' => $allPermission
            ],
            ['name' => 'Co-Owner',
            'description' => 'It has all permissions for Co-Owners',
            'icon' => 'medal',
            'permissons' => getPerNames(array_rand($allPermission, rand(2, count($allPermission))))
            ],
            ['name' => 'Admin',
            'description' => 'It has all permissions for Admins',
            'icon' => 'shield-quarter',
            'permissons' => getPerNames(array_rand($allPermission, rand(2, count($allPermission))))
            ],
            ['name' => 'Viewer',
            'description' => 'It has all permissions for Viewers',
            'icon' => 'cctv',
            'permissons' => ['show_admin','show_user','show_role','show_permission','show_post']
            ],
            ['name' => 'Editor',
            'description' => 'It has all permissions for Editors',
            'icon' => 'calendar',
            'permissons' => ['edit_admin','edit_user','edit_role','edit_permission','edit_post']
            ],
            ['name' => 'Creator',
            'description' => 'It has all permissions for Creators',
            'icon' => 'folder-plus',
            'permissons' => ['add_admin','add_user','add_role','add_permission','add_post']
            ],
            ['name' => 'Developer',
            'description' => 'It has all permissions for Developers',
            'icon' => 'code-block',
            'permissons' => getPerNames(array_rand($allPermission, rand(2, count($allPermission))))
            ],
            ['name' => 'Mod',
            'description' => 'It has all permissions for Mods',
            'icon' => 'extension',
            'permissons' => getPerNames(array_rand($allPermission, rand(2, count($allPermission))))
            ],
            ['name' => 'Helper',
            'description' => 'It has all permissions for Helpers',
            'icon' => 'support',
            'permissons' => getPerNames(array_rand($allPermission, rand(2, count($allPermission))))
            ],
            ['name' => 'VIP',
            'description' => 'It has all permissions for VIPs',
            'icon' => 'diamond',
            'permissons' => getPerNames(array_rand($allPermission, rand(2, count($allPermission))))
            ],
            ['name' => 'Ultra',
            'description' => 'It has all permissions for Ultra',
            'icon' => 'rocket',
            'permissons' => getPerNames(array_rand($allPermission, rand(2, count($allPermission))))
            ],
            ['name' => 'Premium',
            'description' => 'It has all permissions for Premium',
            'icon' => 'badge-check',
            'permissons' => getPerNames(array_rand($allPermission, rand(2, count($allPermission))))
            ]
        );

        foreach($roles as $role){
            $createdRole = Role::updateOrCreate(['name' => $role['name']],[
                'name' => $role['name'],
                'description' => $role['description'],
                'icon' => $role['icon'],
                'guard_name' => 'admin'
            ]);

            foreach ($role['permissons'] as $permission) {
                $createdRole->givePermissionTo($permission);
            }
        }
    }
}
