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
                'nombre' => 'Galleta Choco Deluxe',
                'description' => 'Deliciosa galleta con trozos de chocolate negro belga.',
                'precio' => 2.50,
                'stock' => 100,
                'categories_id' => 1, // Clásicas
                'brands_id' => 1,     // Cookie Lovers
            ],
            [
                'nombre' => 'Galleta Doble Chocolate',
                'description' => 'Galleta de cacao con chips de chocolate blanco y negro.',
                'precio' => 2.75,
                'stock' => 80,
                'categories_id' => 1, // Clásicas
                'brands_id' => 1,     // Cookie Lovers
            ],
            [
                'nombre' => 'Galleta Avena y Miel',
                'description' => 'Galleta saludable con avena y miel natural.',
                'precio' => 2.30,
                'stock' => 90,
                'categories_id' => 2, // Saludables
                'brands_id' => 2,     // Healthy Bites
            ],
            [
                'nombre' => 'Galleta Red Velvet',
                'description' => 'Suave galleta roja con trozos de chocolate blanco.',
                'precio' => 2.90,
                'stock' => 70,
                'categories_id' => 3, // Gourmet
                'brands_id' => 3,     // Gourmet Treats
            ],
            [
                'nombre' => 'Galleta de Almendra',
                'description' => 'Galleta crujiente con almendras laminadas y un toque de vainilla.',
                'precio' => 2.60,
                'stock' => 85,
                'categories_id' => 2, // Saludables
                'brands_id' => 2,     // Healthy Bites
            ],
            [
                'nombre' => 'Galleta Brownie',
                'description' => 'Mezcla perfecta entre galleta y brownie, con un interior suave y denso.',
                'precio' => 3.00,
                'stock' => 60,
                'categories_id' => 3, // Gourmet
                'brands_id' => 3,     // Gourmet Treats
            ],
            [
                'nombre' => 'Galleta Rellena de Nutella',
                'description' => 'Galleta con un corazón cremoso de Nutella.',
                'precio' => 3.20,
                'stock' => 50,
                'categories_id' => 4, // Rellenas
                'brands_id' => 4,     // Stuffed Joy
            ],
            [
                'nombre' => 'Galleta de Pistacho',
                'description' => 'Galleta gourmet con pistachos troceados y esencia de almendra.',
                'precio' => 3.50,
                'stock' => 45,
                'categories_id' => 3, // Gourmet
                'brands_id' => 3,     // Gourmet Treats
            ],
            [
                'nombre' => 'Galleta de Coco',
                'description' => 'Galleta con ralladura de coco y un ligero toque de limón.',
                'precio' => 2.40,
                'stock' => 75,
                'categories_id' => 2, // Saludables
                'brands_id' => 2,     // Healthy Bites
            ],
            [
                'nombre' => 'Galleta de Canela',
                'description' => 'Aromática galleta con canela y azúcar moreno.',
                'precio' => 2.20,
                'stock' => 95,
                'categories_id' => 1, // Clásicas
                'brands_id' => 1,     // Cookie Lovers
            ],
            [
                'nombre' => 'Galleta de Jengibre',
                'description' => 'Galleta especiada con jengibre y miel, ideal para Navidad.',
                'precio' => 2.80,
                'stock' => 55,
                'categories_id' => 3, // Gourmet
                'brands_id' => 3,     // Gourmet Treats
            ],
            [
                'nombre' => 'Galleta de Frambuesa',
                'description' => 'Galleta rellena de mermelada de frambuesa casera.',
                'precio' => 3.10,
                'stock' => 50,
                'categories_id' => 4, // Rellenas
                'brands_id' => 4,     // Stuffed Joy
            ],
        ]);
    }
}
