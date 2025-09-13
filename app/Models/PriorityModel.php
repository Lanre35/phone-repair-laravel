<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriorityModel extends Model
{
    protected $table = 'priorities';
    protected $fillable = [
        'priority',
    ];

    public function repairs()
    {
        return $this->hasMany(Repair::class, 'priority_id');
    }
}
