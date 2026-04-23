<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InstallmentPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'installment.view',
            'installment.create',
            'installment.collect',
            'installment.delete',
            'installment.view_overdue',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'web']
            );
        }

        Role::where('name', 'super-admin')->first()
            ?->givePermissionTo($permissions);

        $this->command->info('✅ Installment permissions seeded.');
    }
}
