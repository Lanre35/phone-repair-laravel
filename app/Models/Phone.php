<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';

    protected $fillable = [
        'brand',
        'model_id',
    ];

    public function phoneModel()
    {
        return $this->belongsTo(PhoneModel::class, 'model_id');
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
