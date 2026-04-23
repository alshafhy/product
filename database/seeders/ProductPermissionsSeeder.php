<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProductPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',
            'product.adjust_stock',   // manual stock correction
            'product.view_cost',      // show buy_price (cashier restriction)
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

        $this->command->info('✅ Product permissions seeded.');
    }
}
