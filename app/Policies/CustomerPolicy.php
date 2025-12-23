<?php

namespace App\Policies;

use App\Models\User;

class CustomerPolicy
{
    /**
     * Determine whether the user can edit the customer.
     */
    public function edit(User $user): bool
    {
        return $user->role !== 'USER';
    }

    /**
     * Determine whether the user can view the customer.
     */
    public function show(User $user): bool
    {
        return $user->role !== 'USER';
    }

    /**
     * Determine whether the user can delete the customer.
     */
    public function delete(User $user): bool
    {
        return $user->role !== 'USER';
    }

}
