<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriorityModel extends Model
{
    protected $table = 'priorities';
    protected $fillable = [
        'priority',
    ];
}
