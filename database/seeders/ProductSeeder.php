<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            [
                'nombre' => 'iPhone 14 Pro',
                'description' => 'El último modelo de Apple con tecnología avanzada.',
                'precio' => 1199.99,
                'stock' => 50,
                'categories_id' => 1,
                'brands_id' => 1,
            ],
            [
                'nombre' => 'Samsung Galaxy S23',
                'description' => 'Smartphone con pantalla AMOLED y excelente rendimiento.',
                'precio' => 999.99,
                'stock' => 40,
                'categories_id' => 1,
                'brands_id' => 2,
            ],
            [
                'nombre' => 'Sony VAIO Laptop',
                'description' => 'Portátil potente para trabajo y entretenimiento.',
                'precio' => 1499.99,
                'stock' => 30,
                'categories_id' => 2,
                'brands_id' => 3,
            ],
        ]);
    }
}
