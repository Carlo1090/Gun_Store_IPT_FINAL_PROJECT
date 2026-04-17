<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'AK-47',
            'price' => 50000,
            'stock' => 10,
            'description' => 'Automatic rifle',
            'image' => 'products/AK-47.webp',
        ]);

        Product::create([
            'name' => 'Glock 19',
            'price' => 25000,
            'stock' => 15,
            'description' => 'Compact pistol',
            'image' => 'products/gloc 19.jpg',
        ]);

        Product::create([
            'name' => 'Shotgun',
            'price' => 30000,
            'stock' => 8,
            'description' => 'Pump action shotgun',
            'image' => 'products/shotgun.webp',
        ]);
    }
}
