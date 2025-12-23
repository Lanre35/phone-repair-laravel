<?php

namespace App\Policies;

use App\Models\Repair;
use App\Models\User;

class RepairPolicy
{
    
    /**
     * Determine whether the user can edit the repair.
     */
    public function edit(User $user, Repair $repair): bool
    {
        return $repair->user->is($user);
    }

    /**
     * Determine whether the user can view the repair.
     */
    public function show(User $user, Repair $repair): bool
    {
        return $repair->user->is($user);
        //   return $user->role !== 'USER';
    }

    /**
     * Determine whether the user can delete the repair.
     */
    public function delete(User $user): bool
    {
        return $user->role !== 'USER';
        // return $repair->user->is($user);
    }
}
