<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product',
        'abbreviation'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'categoryId');
    }
}
