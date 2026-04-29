<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // 1. Make sure role exists
        $role = Role::firstOrCreate(['name' => 'User']);

        // 2. Create User
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User',
                'phone' => '03000000001',
                'role_id' => $role->id,
                'status' => 'active',
                'password' => Hash::make('password'),
                'user_type' => 'user',
            ]
        );

        // 3. Assign role
        if (!$user->hasRole('User')) {
            $user->assignRole($role);
        }
    }
}
