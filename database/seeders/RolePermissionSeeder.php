<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            'upload prescription',
            'view prescriptions',
            'approve prescriptions',
            'manage users',
            'view orders',
            'manage inventory',
            'user activities',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole  = Role::firstOrCreate(['name' => 'user']);

        $adminRole->syncPermissions(Permission::all());

        // Give limited permissions to user
        $userRole->syncPermissions([
            'upload prescription',
            'view prescriptions',
            'user activities',
        ]);
    }
}
