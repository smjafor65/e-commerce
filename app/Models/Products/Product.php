<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";
     protected $fillable = [
        'name', 'sku', 'category', 'brand', 'price', 'sale_price',
        'stock', 'unit', 'status', 'thumbnail', 'description'
    ];
}
