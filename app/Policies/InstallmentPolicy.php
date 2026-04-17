<?php

namespace App\Policies;

use App\Models\Installment;
use App\Models\User;

class InstallmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('installment.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Installment $installment): bool
    {
        return $user->can('installment.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('installment.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Installment $installment): bool
    {
        return $user->can('installment.edit');
    }

    /**
     * Determine whether the user can collect/pay the installment.
     */
    public function collect(User $user, Installment $installment): bool
    {
        return $user->can('installment.collect');
    }
}
