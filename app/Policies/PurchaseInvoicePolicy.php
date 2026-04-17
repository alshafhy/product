<?php

namespace App\Policies;

use App\Models\PurchaseInvoice;
use App\Models\User;

class PurchaseInvoicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('purchase_invoice.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PurchaseInvoice $purchaseInvoice): bool
    {
        return $user->can('purchase_invoice.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('purchase_invoice.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PurchaseInvoice $purchaseInvoice): bool
    {
        return $user->can('purchase_invoice.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PurchaseInvoice $purchaseInvoice): bool
    {
        return $user->can('purchase_invoice.delete');
    }
}
