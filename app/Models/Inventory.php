<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'part_name',
        'sku',
        'category',
        'stock_quantity',
        'cost_price',
        'selling_price',
        'min_stock',
        'description'
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2'
    ];
}
