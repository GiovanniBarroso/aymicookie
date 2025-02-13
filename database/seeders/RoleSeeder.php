<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'nombre' => 'Admin', 'descripcion' => 'Administrador del sistema'],
            ['id' => 2, 'nombre' => 'User', 'descripcion' => 'Usuario regular'],
        ]);
    }
}
