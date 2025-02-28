<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $discounts = [
            [
                'codigo' => 'DESC10',
                'description' => 'Descuento del 10% en toda la tienda',
                'tipo' => 'global',
                'valor' => 10.00,
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addDays(30),
                'products_id' => 2,
                'activo' => true,
            ],
            [
                'codigo' => 'BLACKFRIDAY',
                'description' => 'Descuento especial del 20% por Black Friday',
                'tipo' => 'global',
                'valor' => 20.00,
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addDays(10),
                'products_id' => 3,
                'activo' => true,
            ],
            [
                'codigo' => 'GAMING15',
                'description' => '15% de descuento en la categoría de Gaming',
                'tipo' => 'categoria',
                'valor' => 15.00,
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addDays(20),
                'products_id' => 5,
                'activo' => true,
            ],
            [
                'codigo' => 'OFERTA50',
                'description' => '50% de descuento en producto seleccionado',
                'tipo' => 'producto',
                'valor' => 50.00,
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addDays(15),
                'products_id' => 1, 
                'activo' => true,
            ],
            [
                'codigo' => 'NAVIDAD25',
                'description' => 'Descuento del 25% en productos navideños',
                'tipo' => 'categoria',
                'valor' => 25.00,
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addDays(45),
                'products_id' => 4,
                'activo' => true,
            ],
        ];

        DB::table('discounts')->insert($discounts);
    }
}
