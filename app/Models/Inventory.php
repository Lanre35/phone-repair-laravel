<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';
    protected $fillable = [
        'part_name',
        'skuId',
        'categoryId',
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

    public function product()
    {
        return $this->belongsTo(Product::class, 'categoryId');
    }
}
