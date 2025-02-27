<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::insert([
            ['nombre' => 'Cookie Lovers'],
            ['nombre' => 'Healthy Bites'],
            ['nombre' => 'Gourmet Treats'],
            ['nombre' => 'Stuffed Joy'],
        ]);
    }
}
