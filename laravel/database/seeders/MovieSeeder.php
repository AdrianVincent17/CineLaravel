<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        // Recuperamos los IDs de los géneros que acabamos de crear
        $scifi = Genre::where('name', 'Ciencia Ficción')->first();
        $drama = Genre::where('name', 'Drama')->first();
        $action = Genre::where('name', 'Acción')->first();

        //si queremos crear mas generos podemos agregarlos aqui, y luego asignarlos a las peliculas.

        // Creamos Película 1
        if ($scifi) {
            Movie::create([
                'title' => 'Dune: Parte Dos',
                'synopsis' => 'Paul Atreides se une a Chani y a los Fremen mientras busca venganza contra los conspiradores que destruyeron a su familia.',
                'duration' => 166,
                'age_rating' => '+12',
                'genre_id' => $scifi->id
            ]);
        }

        // Creamos Película 2
        if ($drama) {
            Movie::create([
                'title' => 'El Padrino',
                'synopsis' => 'El patriarca envejecido de una dinastía del crimen organizado transfiere el control de su imperio clandestino a su hijo reacio.',
                'duration' => 175,
                'age_rating' => '+16',
                'genre_id' => $drama->id
            ]);
        }
        
        // Creamos Película 3
        if ($action) {
             Movie::create([
                'title' => 'Mad Max: Fury Road',
                'synopsis' => 'En un mundo post-apocalíptico, Max se une a Furiosa para huir de un líder de culto y su ejército en un camión cisterna blindado.',
                'duration' => 120,
                'age_rating' => '+18',
                'genre_id' => $action->id
            ]);
        }
    }
}