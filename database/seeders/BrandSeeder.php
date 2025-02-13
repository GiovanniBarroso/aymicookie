<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::insert([
            ['nombre' => 'Apple', 'descripcion' => 'Productos de alta tecnología e innovación.'],
            ['nombre' => 'Samsung', 'descripcion' => 'Líder en tecnología móvil y electrodomésticos.'],
            ['nombre' => 'Sony', 'descripcion' => 'Entretenimiento y tecnología de primer nivel.'],
        ]);
    }
}
