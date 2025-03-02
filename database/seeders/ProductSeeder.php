<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        Product::insert([
            [
                'nombre' => 'Galleta Choco Deluxe',
                'description' => 'Irresistible galleta artesanal elaborada con mantequilla premium y generosos trozos de chocolate negro belga para los verdaderos amantes del cacao.',
                'precio' => 2.50,
                'stock' => 100,
                'categories_id' => 1,
                'brands_id' => 1,
                'image' => 'images/1.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta Doble Chocolate',
                'description' => 'Explosión de sabor con cacao puro y una combinación perfecta de chips de chocolate blanco y negro que se derriten en cada bocado.',
                'precio' => 2.75,
                'stock' => 80,
                'categories_id' => 1,
                'brands_id' => 1,
                'image' => 'images/2.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta Avena y Miel',
                'description' => 'Receta casera con copos de avena integral y miel 100% natural, ideal para un snack saludable sin perder el toque dulce.',
                'precio' => 2.30,
                'stock' => 90,
                'categories_id' => 2,
                'brands_id' => 2,
                'image' => 'images/3.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta Red Velvet',
                'description' => 'Delicada y esponjosa galleta con el inconfundible sabor del Red Velvet y trocitos de chocolate blanco para un final suave y dulce.',
                'precio' => 2.90,
                'stock' => 70,
                'categories_id' => 3,
                'brands_id' => 3,
                'image' => 'images/4.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta de Almendra',
                'description' => 'Crujiente galleta infusionada con vainilla natural y coronada con almendras laminadas recién tostadas.',
                'precio' => 2.60,
                'stock' => 85,
                'categories_id' => 2,
                'brands_id' => 2,
                'image' => 'images/5.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta Brownie',
                'description' => 'El equilibrio perfecto entre galleta y brownie: exterior crujiente con un corazón intensamente húmedo y chocolateado.',
                'precio' => 3.00,
                'stock' => 60,
                'categories_id' => 3,
                'brands_id' => 3,
                'image' => 'images/6.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta Rellena de Nutella',
                'description' => 'Nuestra especialidad: galleta de mantequilla dorada con un relleno cremoso y abundante de Nutella que sorprende en cada mordisco.',
                'precio' => 3.20,
                'stock' => 50,
                'categories_id' => 4,
                'brands_id' => 4,
                'image' => 'images/7.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta de Pistacho',
                'description' => 'Galleta gourmet elaborada con pistachos seleccionados y un delicado toque de esencia de almendra para una experiencia sofisticada.',
                'precio' => 3.50,
                'stock' => 45,
                'categories_id' => 3,
                'brands_id' => 3,
                'image' => 'images/8.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta de Coco',
                'description' => 'Suave y fragante galleta con coco rallado natural y un sutil matiz cítrico de limón fresco.',
                'precio' => 2.40,
                'stock' => 75,
                'categories_id' => 2,
                'brands_id' => 2,
                'image' => 'images/9.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta de Canela',
                'description' => 'Tradicional galleta casera con canela en polvo y azúcar moreno caramelizado para un sabor cálido y especiado.',
                'precio' => 2.20,
                'stock' => 95,
                'categories_id' => 1,
                'brands_id' => 1,
                'image' => 'images/10.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta de Jengibre',
                'description' => 'Receta icónica con jengibre fresco, miel orgánica y especias que evocan la auténtica esencia navideña.',
                'precio' => 2.80,
                'stock' => 55,
                'categories_id' => 3,
                'brands_id' => 3,
                'image' => 'images/11.png',
                'created_at' => $now,
            ],
            [
                'nombre' => 'Galleta de Frambuesa',
                'description' => 'Galleta rellena artesanalmente con mermelada casera de frambuesa, creando el balance perfecto entre dulce y ácido.',
                'precio' => 3.10,
                'stock' => 50,
                'categories_id' => 4,
                'brands_id' => 4,
                'image' => 'images/12.png',
                'created_at' => $now,
            ],
        ]);
    }
}
