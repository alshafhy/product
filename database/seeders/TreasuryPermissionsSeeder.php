<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TreasuryPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'treasury.view',
            'treasury.deposit',
            'treasury.withdraw',
            'treasury.expense',
            'treasury.view_balance',
            'treasury.export',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'web']
            );
        }

        Role::where('name', 'super-admin')->first()
            ?->givePermissionTo($permissions);

        $this->command->info('✅ Treasury permissions seeded.');
    }
}
