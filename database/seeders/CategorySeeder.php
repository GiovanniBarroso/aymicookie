<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['nombre' => 'Clásicas'],
            ['nombre' => 'Saludables'],
            ['nombre' => 'Gourmet'],
            ['nombre' => 'Rellenas'],
        ]);
    }
}
