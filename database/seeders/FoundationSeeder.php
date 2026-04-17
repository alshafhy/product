<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\UnitOfMeasure;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FoundationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Categories
        $categories = [
            ['name' => 'Electronics', 'ar_name' => 'إلكترونيات'],
            ['name' => 'Food', 'ar_name' => 'أغذية'],
            ['name' => 'Beverages', 'ar_name' => 'مشروبات'],
            ['name' => 'Clothing', 'ar_name' => 'ملابس'],
            ['name' => 'Other', 'ar_name' => 'أخرى'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }

        // 2. Seed Units
        $units = [
            ['name' => 'piece', 'ar_name' => 'قطعة'],
            ['name' => 'box', 'ar_name' => 'صندوق'],
            ['name' => 'kg', 'ar_name' => 'كيلو'],
        ];

        foreach ($units as $unit) {
            UnitOfMeasure::updateOrCreate(['name' => $unit['name']], $unit);
        }

        // 3. Seed Permissions
        $permissions = [
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',
            'product.adjust_stock',
            'customer.view',
            'customer.create',
            'customer.edit',
            'customer.delete',
            'supplier.view',
            'supplier.create',
            'supplier.edit',
            'supplier.delete',
            'sale_invoice.view',
            'sale_invoice.create',
            'sale_invoice.edit',
            'sale_invoice.delete',
            'sale_invoice.void',
            'purchase_invoice.view',
            'purchase_invoice.create',
            'purchase_invoice.edit',
            'purchase_invoice.delete',
            'treasury.view',
            'treasury.deposit',
            'treasury.withdraw',
            'treasury.reports',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // 4. Assign to super-admin (optional but recommended based on previous context)
        $role = Role::findOrCreate('super-admin', 'web');
        $role->givePermissionTo($permissions);
    }
}
