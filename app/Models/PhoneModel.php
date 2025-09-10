<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    protected $table = 'phone_models';

    protected $fillable = [
        'model',
        'model_number',
    ];

    public function phones()
    {
        return $this->hasMany(Phone::class, 'model_id');
    }
}
