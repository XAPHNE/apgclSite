<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'View Financial Year',
            'Add Financial Year',
            'Update Financial Year',
            'Delete Financial Year',
            'View Tender',
            'Add Tender',
            'Update Tender',
            'Delete Tender',
            'View Tender File',
            'Add Tender File',
            'Update Tender File',
            'Delete Tender File',
            'View Daily Generation',
            'Add Daily Generation',
            'Update Daily Generation',
            'Delete Daily Generation',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $rolesAndPermissions = [
            'Tender Uploader' => [
                'View Financial Year',
                'Add Financial Year',
                'View Tender',
                'Add Tender',
                'Update Tender',
                'View Tender File',
                'Add Tender File',
                'Update Tender File',
            ],
            'Daily Generation Updater' => [
                'View Daily Generation',
                'Update Daily Generation',
            ],
        ];

        foreach ($rolesAndPermissions as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        $this->command->info('Roles and permissions seeded successfully.');
    }
}
