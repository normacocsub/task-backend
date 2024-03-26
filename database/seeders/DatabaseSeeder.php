<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use App\Models\UserRol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'email' => 'test@example.com',
            'hash' => Hash::make('Hola123*'),
            'estado' => 'Active'
        ]);

        Rol::factory()->create([
            'nombre' => 'Admin',
            'descripcion' => 'Rol para el admin'
        ]);

        Rol::factory()->create([
            'nombre' => 'Empleado',
            'descripcion' => 'Rol para el empleado'
        ]);

        UserRol::factory()->create([
           'rol_id'=> 1,
           'user_id' => 1
        ]);

    }
}
