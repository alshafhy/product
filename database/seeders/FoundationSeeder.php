<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\UnitOfMeasure;
use App\Models\ShopSetting;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FoundationSeeder extends Seeder
{
    public function run(): void
    {
        // ── Permissions ──────────────────────────────────────────
        $permissions = [
            // Categories
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',
            // Units
            'unit.view',
            'unit.create',
            'unit.edit',
            'unit.delete',
            // Shop Settings
            'shop_settings.view',
            'shop_settings.edit',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'web']
            );
        }

        // Assign all to super-admin role
        $superAdmin = Role::where('name', 'super-admin')->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo($permissions);
        }

        // ── Default Categories ────────────────────────────────────
        $categories = [
            ['name' => 'General',     'ar_name' => 'عام'],
            ['name' => 'Electronics', 'ar_name' => 'إلكترونيات'],
            ['name' => 'Clothing',    'ar_name' => 'ملابس'],
            ['name' => 'Food',        'ar_name' => 'مواد غذائية'],
            ['name' => 'Other',       'ar_name' => 'أخرى'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat['name']], $cat);
        }

        // ── Default Units of Measure ─────────────────────────────
        $units = [
            ['name' => 'Piece', 'ar_name' => 'قطعة',  'abbreviation' => 'pcs'],
            ['name' => 'Box',   'ar_name' => 'كرتونة', 'abbreviation' => 'box'],
            ['name' => 'Kg',    'ar_name' => 'كيلوجرام','abbreviation' => 'kg'],
        ];

        foreach ($units as $unit) {
            UnitOfMeasure::firstOrCreate(['name' => $unit['name']], $unit);
        }

        $this->command->info('✅ Foundation seeder complete — categories, units, permissions seeded.');
    }
}
