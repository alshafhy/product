<?php

namespace App\Policies;

use App\Models\TreasuryTransaction;
use App\Models\User;

class TreasuryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('treasury.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TreasuryTransaction $treasuryTransaction): bool
    {
        return $user->can('treasury.view');
    }

    /**
     * Determine whether the user can perform deposits.
     */
    public function deposit(User $user): bool
    {
        return $user->can('treasury.deposit');
    }

    /**
     * Determine whether the user can perform withdrawals.
     */
    public function withdraw(User $user): bool
    {
        return $user->can('treasury.withdraw');
    }

    /**
     * Determine whether the user can view reports.
     */
    public function viewReports(User $user): bool
    {
        return $user->can('treasury.reports');
    }
}
