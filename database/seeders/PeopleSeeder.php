<?php

namespace Database\Seeders;

use App\Overrides\Spatie\Permission;
use App\Overrides\Spatie\Role;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Spatie Permissions
        $permissions = [
            'customer.view',
            'customer.create',
            'customer.edit',
            'customer.delete',
            'supplier.view',
            'supplier.create',
            'supplier.edit',
            'supplier.delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(
                ['name' => $permissionName, 'guard_name' => 'web'],
                ['name' => $permissionName, 'guard_name' => 'web']
            );
        }

        // 2. Assign to super-admin role
        $superAdminRole = Role::where('name', 'super-admin')->first();
        if ($superAdminRole) {
            $superAdminRole->givePermissionTo($permissions);
        }
    }
}
