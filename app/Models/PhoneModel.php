<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    protected $table = 'phone_models';

    protected $fillable = [
        'brand_id',
        'model',
        'model_number',
    ];

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'brand_id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'device_model_id');
    }
}
