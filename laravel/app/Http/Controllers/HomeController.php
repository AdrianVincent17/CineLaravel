<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre; // <--- Importante: Necesitamos los géneros para el filtro
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Iniciamos la consulta base (con los géneros cargados)
        $query = Movie::with('genre');

        // 2. ¿El usuario escribió algo en el buscador?
        if ($request->filled('search')) {
            // Buscamos películas cuyo título contenga esa palabra (LIKE)
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 3. ¿El usuario eligió un género específico?
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }

        // 4. Ejecutamos la consulta y obtenemos los resultados
        $movies = $query->latest()->get();

        // 5. También necesitamos la lista de géneros para llenar el desplegable
        $genres = Genre::all();

        return view('welcome', compact('movies', 'genres'));
    }
}