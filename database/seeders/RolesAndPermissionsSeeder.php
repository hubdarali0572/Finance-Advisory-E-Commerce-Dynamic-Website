<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seedPermissions();
        $this->seedRoles();
    }

    private function seedPermissions()
    {
        $permissions = [

            // for user

            'view user',
            'create user',
            'edit user',
            'show user',
            'delete user',

            // for category

            'view category',
            'create category',
            'edit category',
            'show category',
            'delete category',

            // for subcategory 

            'view subcategory',
            'create subcategory',
            'edit subcategory',
            'show subcategory',
            'delete subcategory',

            // for blogs / posts / Articles

            'view posts',
            'create posts',
            'edit posts',
            'show posts',
            'delete posts',

            // Draft for blogs / posts / Articles

            // 'view draft posts',
            // 'create draft posts',
            // 'edit draft posts',
            // 'show draft posts',
            // 'delete draft posts',

            // for subscription

            'view subscriptions',
            'create subscriptions',
            'edit subscriptions',
            'show subscriptions',
            'delete subscriptions',

        

            // for Role

            'view role',
            'create role',
            'edit role',
            'show role',
            'delete role',


        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    private function seedRoles()
    {

        // Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $superAdminRole->givePermissionTo(Permission::all());
    }
}
