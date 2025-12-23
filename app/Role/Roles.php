<?php

namespace App\Role;

enum Roles
{
    case ADMIN;
    case STAFF;
    case USER;



    public function label(): string
    {
        return match ($this) {
            Roles::ADMIN => 'Admin',
            Roles::STAFF => 'Staff',
            Roles::USER => 'User',
        };
    }
}
