<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin',
                'apellidos' => 'Principal',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'roles_id' => 1,
            ],
            [
                'name' => 'Usuario',
                'apellidos' => 'Demo',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'roles_id' => 2,
            ],
        ]);
    }
}
