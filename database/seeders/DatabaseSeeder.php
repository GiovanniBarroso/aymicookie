<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,      // Inserta los roles
            UserSeeder::class,      // Inserta los usuarios
            BrandSeeder::class,     // Inserta las marcas
            CategorySeeder::class,  // Inserta las categorías
            ProductSeeder::class,   // Inserta los productos
        ]);
    }
}
