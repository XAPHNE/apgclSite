<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create "Super Admin" role
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);

        // Create admin user
        $admin = User::firstOrCreate([
            'email' => 'admin@apgcl.org',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('secret'),
        ]);

        // Assign role to the admin user
        $admin->assignRole($superAdminRole);
    }
}