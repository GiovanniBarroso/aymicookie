<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['nombre' => 'Smartphones', 'description' => 'Dispositivos móviles de última generación.'],
            ['nombre' => 'Laptops', 'description' => 'Portátiles para productividad y gaming.'],
            ['nombre' => 'Tablets', 'description' => 'Tablets para entretenimiento y trabajo.'],
        ]);
    }
}
