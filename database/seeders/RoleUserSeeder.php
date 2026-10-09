<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // ROLE
        // =====================
        $superAdmin = Role::create(['name' => 'super admin']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // =====================
        // SUPER ADMIN
        // =====================
        User::create([
            'name' => 'Gabriella',
            'email' => 'gabriella@kangpanggil.com',
            'password' => Hash::make('superadmin123'),
            'role_id' => $superAdmin->id
        ]);

        // =====================
        // ADMIN
        // =====================
        User::create([
            'name' => 'Marta',
            'email' => 'marta@kangpanggil.com',
            'password' => Hash::make('Marta@123'),
            'role_id' => $admin->id
        ]);

        User::create([
            'name' => 'Nadiyah',
            'email' => 'nadiyah@kangpanggil.com',
            'password' => Hash::make('Nadiyah@123'),
            'role_id' => $admin->id
        ]);

        User::create([
            'name' => 'Sindy',
            'email' => 'sindy@kangpanggil.com',
            'password' => Hash::make('Sindy@123'),
            'role_id' => $admin->id
        ]);
    }
}