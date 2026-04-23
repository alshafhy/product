<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // ── Users & Roles (replaces old template space-style names) ──
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // ── System / Admin ────────────────────────────────────────────
            'system_component.view',
            'system_component.edit',
            'branch.view',
            'branch.create',
            'branch.edit',
            'branch.delete',
            'shop_settings.view',
            'shop_settings.edit',

            // ── Categories ────────────────────────────────────────────────
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',

            // ── Units of Measure ──────────────────────────────────────────
            'unit.view',
            'unit.create',
            'unit.edit',
            'unit.delete',

            // ── Products ──────────────────────────────────────────────────
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',
            'product.adjust_stock',
            'product.view_cost',

            // ── Customers ─────────────────────────────────────────────────
            'customer.view',
            'customer.create',
            'customer.edit',
            'customer.delete',
            'customer.view_debt',
            'customer.record_payment',

            // ── Suppliers ─────────────────────────────────────────────────
            'supplier.view',
            'supplier.create',
            'supplier.edit',
            'supplier.delete',
            'supplier.view_balance',
            'supplier.adjust_balance',

            // ── Sale Invoices ─────────────────────────────────────────────
            'sale_invoice.view',
            'sale_invoice.create',
            'sale_invoice.edit',
            'sale_invoice.delete',
            'sale_invoice.cancel',
            'sale_invoice.view_profit',
            'sale_invoice.collect_debt',
            'sale_invoice.apply_discount',

            // ── Purchase Invoices ─────────────────────────────────────────
            'purchase_invoice.view',
            'purchase_invoice.create',
            'purchase_invoice.edit',
            'purchase_invoice.delete',
            'purchase_invoice.cancel',
            'purchase_invoice.pay_supplier',
            'purchase_invoice.update_prices',

            // ── Treasury ──────────────────────────────────────────────────
            'treasury.view',
            'treasury.deposit',
            'treasury.withdraw',
            'treasury.expense',
            'treasury.view_balance',
            'treasury.export',

            // ── Installments ──────────────────────────────────────────────
            'installment.view',
            'installment.create',
            'installment.collect',
            'installment.delete',
            'installment.view_overdue',

            // ── Reports ───────────────────────────────────────────────────
            'report.view',
            'report.sales',
            'report.stock',
            'report.customers',
            'report.suppliers',
            'report.treasury',
            'report.installments',
            'report.export',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name'       => $permission,
                'guard_name' => 'web',
            ]);
        }

        // ── Create roles ──────────────────────────────────────────────────
        $superAdmin = Role::firstOrCreate([
            'name'       => 'super-admin',
            'guard_name' => 'web',
        ], ['ar_name' => 'مدير النظام']);

        $manager = Role::firstOrCreate([
            'name'       => 'manager',
            'guard_name' => 'web',
        ], ['ar_name' => 'مدير الفرع']);

        $cashier = Role::firstOrCreate([
            'name'       => 'cashier',
            'guard_name' => 'web',
        ], ['ar_name' => 'كاشير']);

        // Super admin gets everything
        $superAdmin->syncPermissions($permissions);

        // Manager gets everything except system admin actions
        $managerPermissions = array_filter($permissions, fn($p) =>
            !in_array($p, [
                'system_component.edit',
                'branch.delete',
                'user.delete',
                'role.delete',
            ])
        );
        $manager->syncPermissions(array_values($managerPermissions));

        // Cashier gets limited POS operations
        $cashier->syncPermissions([
            'product.view',
            'customer.view',
            'customer.record_payment',
            'sale_invoice.view',
            'sale_invoice.create',
            'purchase_invoice.view',
            'purchase_invoice.create',
            'treasury.view',
            'treasury.deposit',
            'installment.view',
            'installment.collect',
        ]);

        $this->command->info('✅ All permissions and roles seeded successfully.');
    }
}
