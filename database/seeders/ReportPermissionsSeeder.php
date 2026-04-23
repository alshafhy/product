<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ReportPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'report.sales',
            'report.stock',
            'report.customers',
            'report.suppliers',
            'report.treasury',
            'report.installments',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'web']
            );
        }

        Role::where('name', 'super-admin')->first()
            ?->givePermissionTo($permissions);

        $this->command->info('✅ Report permissions seeded.');
    }
}
