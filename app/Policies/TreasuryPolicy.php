<?php

namespace App\Policies;

use App\Models\TreasuryTransaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TreasuryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('treasury.view');
    }

    /**
     * Determine whether the user can view reports.
     */
    public function viewReports(User $user): bool
    {
        return $user->hasPermissionTo('treasury.reports');
    }

    /**
     * Determine whether the user can deposit cash.
     */
    public function deposit(User $user): bool
    {
        return $user->hasPermissionTo('treasury.deposit');
    }

    /**
     * Determine whether the user can withdraw cash.
     */
    public function withdraw(User $user): bool
    {
        return $user->hasPermissionTo('treasury.withdraw');
    }
}
