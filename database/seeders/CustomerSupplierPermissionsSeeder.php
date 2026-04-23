<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CustomerSupplierPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Customers
            'customer.view',
            'customer.create',
            'customer.edit',
            'customer.delete',
            'customer.view_debt',      // hide debt from cashier if needed
            'customer.record_payment', // collect money from customer

            // Suppliers
            'supplier.view',
            'supplier.create',
            'supplier.edit',
            'supplier.delete',
            'supplier.view_balance',
            'supplier.adjust_balance', // manual correction dialog
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'web']
            );
        }

        $superAdmin = Role::where('name', 'super-admin')->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo($permissions);
        }

        $this->command->info('✅ Customer & Supplier permissions seeded.');
    }
}
