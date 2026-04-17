<?php

namespace App\Policies;

use App\Models\PurchaseInvoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchaseInvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('purchase_invoice.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PurchaseInvoice $invoice): bool
    {
        return $user->hasPermissionTo('purchase_invoice.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('purchase_invoice.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PurchaseInvoice $invoice): bool
    {
        return $user->hasPermissionTo('purchase_invoice.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PurchaseInvoice $invoice): bool
    {
        return $user->hasPermissionTo('purchase_invoice.delete');
    }
}
