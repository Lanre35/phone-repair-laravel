<?php

namespace App\Policies;

use App\Models\Inventory;
use App\Models\User;

class InventoryPolicy
{
     public function edit(User $user){
        return $user->role !== 'USER';
     }


    public function update(User $user)
    {
        return $user->role !== 'USER';
    }

}
