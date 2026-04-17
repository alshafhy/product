<?php

namespace Database\Seeders;

use App\Overrides\Spatie\Permission;
use App\Overrides\Spatie\Role;
use Illuminate\Database\Seeder;

class SaleInvoicePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Spatie Permissions
        $permissions = [
            'sale_invoice.view',
            'sale_invoice.create',
            'sale_invoice.edit',
            'sale_invoice.delete',
            'sale_invoice.void',
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
