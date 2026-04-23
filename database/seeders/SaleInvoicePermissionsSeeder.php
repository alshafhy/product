<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SaleInvoicePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'sale_invoice.view',
            'sale_invoice.create',
            'sale_invoice.edit',
            'sale_invoice.delete',
            'sale_invoice.cancel',
            'sale_invoice.view_profit',   // hide profit from cashier
            'sale_invoice.collect_debt',  // record payment on unpaid invoice
            'sale_invoice.apply_discount',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'web']
            );
        }

        Role::where('name', 'super-admin')->first()
            ?->givePermissionTo($permissions);

        $this->command->info('✅ Sale invoice permissions seeded.');
    }
}
