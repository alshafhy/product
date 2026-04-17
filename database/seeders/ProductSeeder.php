<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Overrides\Spatie\Permission;
use App\Overrides\Spatie\Role;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Spatie Permissions
        $permissions = [
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',
            'product.adjust_stock',
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(
                ['name' => $permissionName, 'guard_name' => 'web'],
                ['name' => $permissionName, 'guard_name' => 'web']
            );
        }

        // 2. Assign to super-admin role
        $superAdminRole = Role::where('name', 'super-admin')->first();
        if ($superAdminRole) {
            $superAdminRole->givePermissionTo($permissions);
        }

        // 3. Sample Data
        $category = Category::first();
        $branch = Branch::first();
        $user = User::first();

        if ($category && $branch && $user) {
            $products = [
                [
                    'code_id' => 'P001',
                    'name' => 'Coca Cola 250ml',
                    'description' => 'Soft drink',
                    'category_id' => $category->id,
                    'sell_price' => 10.00,
                    'buy_price' => 7.00,
                    'quantity' => 100,
                    'unit1' => 'Piece',
                    'unit2' => 'Box',
                    'factor2' => 12,
                    'sell_price_unit2' => 110.00,
                    'branch_id' => $branch->id,
                    'created_by' => $user->id,
                ],
                [
                    'code_id' => 'P002',
                    'name' => 'Rice 1kg',
                    'description' => 'White rice',
                    'category_id' => $category->id,
                    'sell_price' => 25.00,
                    'buy_price' => 20.00,
                    'quantity' => 50,
                    'unit1' => 'kg',
                    'unit2' => 'Sack',
                    'factor2' => 10,
                    'sell_price_unit2' => 240.00,
                    'branch_id' => $branch->id,
                    'created_by' => $user->id,
                ],
                [
                    'code_id' => 'P003',
                    'name' => 'Pasta 400g',
                    'description' => 'Durum wheat pasta',
                    'category_id' => $category->id,
                    'sell_price' => 8.00,
                    'buy_price' => 5.50,
                    'quantity' => 200,
                    'unit1' => 'Piece',
                    'unit2' => 'Pack',
                    'factor2' => 20,
                    'sell_price_unit2' => 150.00,
                    'branch_id' => $branch->id,
                    'created_by' => $user->id,
                ],
            ];

            foreach ($products as $p) {
                Product::updateOrCreate(['code_id' => $p['code_id']], $p);
            }
        }
    }
}
