<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\UnitOfMeasure;
use App\Overrides\Spatie\Permission;
use App\Overrides\Spatie\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoundationLookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Categories
        $categories = [
            ['name' => 'Groceries', 'ar_name' => 'بقالة'],
            ['name' => 'Electronics', 'ar_name' => 'إلكترونيات'],
            ['name' => 'Clothing', 'ar_name' => 'ملابس'],
            ['name' => 'Home & Kitchen', 'ar_name' => 'المنزل والمطبخ'],
            ['name' => 'Beauty', 'ar_name' => 'تجميل'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat['name']], $cat);
        }

        // 2. Seed Units of Measure
        $units = [
            ['name' => 'Piece', 'ar_name' => 'قطعة'],
            ['name' => 'Box', 'ar_name' => 'صندوق'],
            ['name' => 'kg', 'ar_name' => 'كيلو جرام'],
        ];

        foreach ($units as $unit) {
            UnitOfMeasure::updateOrCreate(['name' => $unit['name']], $unit);
        }

        // 3. Spatie Permissions
        $permissions = [
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(
                ['name' => $permissionName, 'guard_name' => 'web'],
                ['name' => $permissionName, 'guard_name' => 'web']
            );
        }

        // 4. Assign to super-admin role
        $superAdminRole = Role::where('name', 'super-admin')->first();
        if ($superAdminRole) {
            $superAdminRole->givePermissionTo($permissions);
        }
    }
}
