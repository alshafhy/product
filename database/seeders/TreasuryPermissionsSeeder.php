<?php

namespace Database\Seeders;

use App\Overrides\Spatie\Permission;
use App\Overrides\Spatie\Role;
use Illuminate\Database\Seeder;

class TreasuryPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Spatie Permissions
        $permissions = [
            'treasury.view',
            'treasury.deposit',
            'treasury.withdraw',
            'treasury.reports',
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
