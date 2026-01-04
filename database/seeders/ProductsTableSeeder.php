<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\Product;
use App\Models\Products\Product ;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Product 1
        Product::create([
            'name'        => 'Wireless Headphones',
            'sku'         => 'WH123456',
            'category'    => 'Electronics',
            'brand'       => 'AudioTech',
            'description' => 'High-quality wireless headphones with noise cancellation.',
            'price'       => 120.99,
            'sale_price'  => 99.99,
            'stock'       => 25,
            'unit'        => 'pcs',
            'status'      => 'active',
            'thumbnail'   => 'products/headphones.jpg',
            'images'      => "1234.jpg",
        ]);

        // Product 2
        Product::create([
            'name'        => 'Running Shoes',
            'sku'         => 'RS987654',
            'category'    => 'Sports',
            'brand'       => 'Speedster',
            'description' => 'Comfortable running shoes for daily workouts and marathons.',
            'price'       => 75.50,
            'sale_price'  => null,
            'stock'       => 50,
            'unit'        => 'pair',
            'status'      => 'active',
            'thumbnail'   => 'products/shoes.jpg',
            'images'      => "1234.jpg",
        ]);

        // Product 3
        Product::create([
            'name'        => 'Coffee Maker',
            'sku'         => 'CM246810',
            'category'    => 'Home',
            'brand'       => 'BrewMaster',
            'description' => 'Automatic coffee maker with programmable timer and strength settings.',
            'price'       => 150.00,
            'sale_price'  => 129.99,
            'stock'       => 15,
            'unit'        => 'pcs',
            'status'      => 'active',
            'thumbnail'   => 'products/coffeemaker.jpg',
            'images'      => "1234.jpg",
        ]);
    }
}
