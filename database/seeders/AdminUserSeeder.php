<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find super admin role
        $AdminRole = Role::firstOrCreate(['name' => 'SuperAdmin']);

        // Create super admin user and assign role
        $AdminUser = User::firstOrCreate([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'user_type' => 'superAdmin',
            'phone' => '03000000000',
            'role_id' => $AdminRole->id,
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);
        $AdminUser->assignRole($AdminRole);
    }
}
