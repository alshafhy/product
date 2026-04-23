<?php

namespace Database\Seeders;

use App\Models\SystemComponent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemComponentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('system_components')->delete();

        $roots = [];

        foreach ($this->groups() as $data) {
            $roots[$data['comp_name']] = SystemComponent::create($data);
        }

        foreach ($this->leaves() as $data) {
            $parentKey = $data['_parent_key'];
            unset($data['_parent_key']);

            if (isset($roots[$parentKey])) {
                $data['parent_id'] = $roots[$parentKey]->id;
            }

            SystemComponent::create($data);
        }

        SystemComponent::fixTree();
    }

    private function groups(): array
    {
        return [
            [
                'comp_name'       => 'dashboard',
                'comp_ar_label'   => 'لوحة التحكم',
                'comp_type'       => 3,
                'route_name'      => 'home',
                'prefix'          => 'home',
                'parent_id'       => null,
                'icon_name'       => 'home',
                'icon_class'      => 'bi bi-house-door',
                'sort_order'      => 1,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                'comp_name'       => 'sales',
                'comp_ar_label'   => 'المبيعات',
                'comp_type'       => 2,
                'route_name'      => null,
                'prefix'          => 'sale-invoices',
                'parent_id'       => null,
                'icon_name'       => 'shopping-cart',
                'icon_class'      => 'bi bi-cart3',
                'sort_order'      => 2,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                'comp_name'       => 'purchases',
                'comp_ar_label'   => 'المشتريات',
                'comp_type'       => 2,
                'route_name'      => null,
                'prefix'          => 'purchase-invoices',
                'parent_id'       => null,
                'icon_name'       => 'truck',
                'icon_class'      => 'bi bi-truck',
                'sort_order'      => 3,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                'comp_name'       => 'customers',
                'comp_ar_label'   => 'العملاء',
                'comp_type'       => 3,
                'route_name'      => 'customers.index',
                'prefix'          => 'customers',
                'parent_id'       => null,
                'icon_name'       => 'users',
                'icon_class'      => 'bi bi-people',
                'sort_order'      => 4,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                'comp_name'       => 'suppliers',
                'comp_ar_label'   => 'الموردون',
                'comp_type'       => 3,
                'route_name'      => 'suppliers.index',
                'prefix'          => 'suppliers',
                'parent_id'       => null,
                'icon_name'       => 'briefcase',
                'icon_class'      => 'bi bi-briefcase',
                'sort_order'      => 5,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                'comp_name'       => 'inventory',
                'comp_ar_label'   => 'المخزون',
                'comp_type'       => 2,
                'route_name'      => null,
                'prefix'          => 'inventory',
                'parent_id'       => null,
                'icon_name'       => 'archive',
                'icon_class'      => 'bi bi-archive',
                'sort_order'      => 6,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                'comp_name'       => 'treasury',
                'comp_ar_label'   => 'الخزينة',
                'comp_type'       => 2,
                'route_name'      => null,
                'prefix'          => 'treasury',
                'parent_id'       => null,
                'icon_name'       => 'dollar-sign',
                'icon_class'      => 'bi bi-cash-stack',
                'sort_order'      => 7,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                'comp_name'       => 'user_management',
                'comp_ar_label'   => 'إدارة المستخدمين',
                'comp_type'       => 3,
                'route_name'      => 'users.index',
                'prefix'          => 'users',
                'parent_id'       => null,
                'icon_name'       => 'user-check',
                'icon_class'      => 'bi bi-person-check',
                'sort_order'      => 8,
                'is_active'       => true,
                'permission_name' => 'user.view',
            ],
        ];
    }

    private function leaves(): array
    {
        return [
            [
                '_parent_key'     => 'sales',
                'comp_name'       => 'new_sale_invoice',
                'comp_ar_label'   => 'فاتورة مبيعات جديدة',
                'comp_type'       => 3,
                'route_name'      => 'saleInvoices.create',
                'prefix'          => 'sale-invoices/create',
                'parent_id'       => null,
                'icon_name'       => 'plus-circle',
                'icon_class'      => 'bi bi-plus-circle',
                'sort_order'      => 1,
                'is_active'       => true,
                'permission_name' => 'sale_invoice.create',
            ],
            [
                '_parent_key'     => 'sales',
                'comp_name'       => 'sales_history',
                'comp_ar_label'   => 'سجل المبيعات',
                'comp_type'       => 3,
                'route_name'      => 'saleInvoices.index',
                'prefix'          => 'sale-invoices',
                'parent_id'       => null,
                'icon_name'       => 'list',
                'icon_class'      => 'bi bi-list-ul',
                'sort_order'      => 2,
                'is_active'       => true,
                'permission_name' => 'sale_invoice.view',
            ],
            [
                '_parent_key'     => 'purchases',
                'comp_name'       => 'new_purchase_invoice',
                'comp_ar_label'   => 'فاتورة مشتريات جديدة',
                'comp_type'       => 3,
                'route_name'      => 'purchaseInvoices.create',
                'prefix'          => 'purchase-invoices/create',
                'parent_id'       => null,
                'icon_name'       => 'plus-circle',
                'icon_class'      => 'bi bi-plus-circle',
                'sort_order'      => 1,
                'is_active'       => true,
                'permission_name' => 'purchase_invoice.create',
            ],
            [
                '_parent_key'     => 'purchases',
                'comp_name'       => 'purchase_history',
                'comp_ar_label'   => 'سجل المشتريات',
                'comp_type'       => 3,
                'route_name'      => 'purchaseInvoices.index',
                'prefix'          => 'purchase-invoices',
                'parent_id'       => null,
                'icon_name'       => 'list',
                'icon_class'      => 'bi bi-list-ul',
                'sort_order'      => 2,
                'is_active'       => true,
                'permission_name' => 'purchase_invoice.view',
            ],
            [
                '_parent_key'     => 'inventory',
                'comp_name'       => 'products',
                'comp_ar_label'   => 'المنتجات',
                'comp_type'       => 3,
                'route_name'      => 'products.index',
                'prefix'          => 'products',
                'parent_id'       => null,
                'icon_name'       => 'package',
                'icon_class'      => 'bi bi-box-seam',
                'sort_order'      => 1,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                '_parent_key'     => 'inventory',
                'comp_name'       => 'categories',
                'comp_ar_label'   => 'التصنيفات',
                'comp_type'       => 3,
                'route_name'      => 'categories.index',
                'prefix'          => 'categories',
                'parent_id'       => null,
                'icon_name'       => 'tag',
                'icon_class'      => 'bi bi-tags',
                'sort_order'      => 2,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                '_parent_key'     => 'treasury',
                'comp_name'       => 'transactions',
                'comp_ar_label'   => 'الحركات المالية',
                'comp_type'       => 3,
                'route_name'      => 'treasuryTransactions.index',
                'prefix'          => 'treasury-transactions',
                'parent_id'       => null,
                'icon_name'       => 'repeat',
                'icon_class'      => 'bi bi-arrow-left-right',
                'sort_order'      => 1,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                '_parent_key'     => 'treasury',
                'comp_name'       => 'deposit_withdraw',
                'comp_ar_label'   => 'إيداع / سحب',
                'comp_type'       => 3,
                'route_name'      => 'treasuryTransactions.create',
                'prefix'          => 'treasury-transactions/create',
                'parent_id'       => null,
                'icon_name'       => 'arrow-down-circle',
                'icon_class'      => 'bi bi-arrow-down-circle',
                'sort_order'      => 2,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                '_parent_key'     => 'treasury',
                'comp_name'       => 'installments',
                'comp_ar_label'   => 'الأقساط',
                'comp_type'       => 3,
                'route_name'      => 'installments.index',
                'prefix'          => 'installments',
                'parent_id'       => null,
                'icon_name'       => 'credit-card',
                'icon_class'      => 'bi bi-credit-card',
                'sort_order'      => 3,
                'is_active'       => true,
                'permission_name' => null,
            ],
            [
                '_parent_key'     => 'treasury',
                'comp_name'       => 'overdue_installments',
                'comp_ar_label'   => 'الأقساط المتأخرة',
                'comp_type'       => 3,
                'route_name'      => 'installments.overdue',
                'prefix'          => 'installments/overdue',
                'parent_id'       => null,
                'icon_name'       => 'alert-circle',
                'icon_class'      => 'bi bi-exclamation-circle',
                'sort_order'      => 4,
                'is_active'       => true,
                'permission_name' => null,
            ],
        ];
    }
}
