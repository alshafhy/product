<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PurchaseInvoicePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'purchase_invoice.view',
            'purchase_invoice.create',
            'purchase_invoice.edit',
            'purchase_invoice.delete',
            'purchase_invoice.cancel',
            'purchase_invoice.pay_supplier',    // settle supplier debt
            'purchase_invoice.update_prices',   // allow updating product cost on purchase
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'web']
            );
        }

        Role::where('name', 'super-admin')->first()
            ?->givePermissionTo($permissions);

        $this->command->info('✅ Purchase invoice permissions seeded.');
    }
}
