<?php

namespace App\Policies;

use App\Models\SaleInvoice;
use App\Models\User;

class SaleInvoicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('sale_invoice.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SaleInvoice $saleInvoice): bool
    {
        return $user->can('sale_invoice.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('sale_invoice.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SaleInvoice $saleInvoice): bool
    {
        return $user->can('sale_invoice.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SaleInvoice $saleInvoice): bool
    {
        return $user->can('sale_invoice.delete');
    }

    /**
     * Determine whether the user can void the model.
     */
    public function void(User $user, SaleInvoice $saleInvoice): bool
    {
        return $user->can('sale_invoice.void');
    }
}
