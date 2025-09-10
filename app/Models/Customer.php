<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address'
    ];

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
