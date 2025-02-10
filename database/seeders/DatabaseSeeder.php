<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1️⃣ Insertar los roles antes que los usuarios
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'nombre' => 'Admin', 'descripcion' => 'Administrador del sistema'],
            ['id' => 2, 'nombre' => 'User', 'descripcion' => 'Usuario regular'],
        ]);

        // 2️⃣ Obtener el rol de Admin para asegurarnos de que existe
        $adminRole = DB::table('roles')->where('nombre', 'Admin')->first();

        // 3️⃣ Insertar usuario de prueba con un rol existente
        User::factory()->create([
            'nombre' => 'Test',
            'apellidos' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // ✅ Mejor seguridad con Hash
            'roles_id' => $adminRole->id ?? 1, // ✅ Evita error si el rol no existe
        ]);

        // 4️⃣ Generar 10 usuarios aleatorios con rol de usuario normal
        User::factory(10)->create([
            'roles_id' => 2, // ✅ Asigna a cada usuario el rol de User
        ]);
    }
}
