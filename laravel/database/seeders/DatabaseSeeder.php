<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CREAR ROLES (Si no existen)
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);

        // 2. CREAR USUARIO ADMINISTRADOR
        // Comprobamos si ya existe para no dar error
        $user = User::firstOrCreate(
            ['email' => 'admin@cine.com'], // Buscamos por email
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'), // La contraseña será 'password'
            ]
        );

        // 3. ASIGNAR ROL AL ADMIN
        $user->assignRole($roleAdmin);

        // 4. LLAMAR A LOS SEEDERS DEL GÉNERO Y PELÍCULAS
        $this->call([
            GenreSeeder::class,
            MovieSeeder::class,
        ]);
    }
}