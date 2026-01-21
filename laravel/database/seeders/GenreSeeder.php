<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        // Usamos firstOrCreate para evitar duplicados si lo ejecutas mas de una vez
        $genres = ['Acción', 'Comedia', 'Drama', 'Terror', 'Ciencia Ficción', 'Infantil'];

        foreach ($genres as $name) {
            Genre::firstOrCreate(['name' => $name]);
        }
    }
}