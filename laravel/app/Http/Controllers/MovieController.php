<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        // Traemos las películas y cargamos su género asociado
        $movies = Movie::with('genre')->get();

        return view('movies.index', compact('movies'));
    }
    
   // 1. Mostrar el formulario
    public function create()
    {
        // Necesitamos la lista de géneros para el desplegable (select)
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    // 2. Guardar la película y la imagen
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'title' => 'required|max:255',
            'synopsis' => 'required',
            'duration' => 'required|integer|min:1',
            'age_rating' => 'required',
            'genre_id' => 'required|exists:genres,id',
            'poster' => 'required|image|max:2048' // Máximo 2MB, debe ser imagen
        ]);

        // Guardamos la información básica de la película
        $movie = Movie::create($request->all());

        // --- AQUÍ OCURRE LA MAGIA DE SPATIE ---
        if ($request->hasFile('poster')) {
            $movie->addMediaFromRequest('poster') // Nombre del input en el HTML
                  ->toMediaCollection('poster');  // Nombre de la colección en el Modelo
        }

        return redirect()->route('movies.index')
            ->with('success', 'Película creada correctamente.');
    }
    // 3. Formulario de Edición
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all(); // Necesitamos los géneros para el desplegable
        return view('movies.edit', compact('movie', 'genres'));
    }

    // 4. Actualizar datos (y foto si la hay)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'synopsis' => 'required',
            'duration' => 'required|integer',
            'age_rating' => 'required',
            'genre_id' => 'required',
            'poster' => 'nullable|image|max:2048' // Aquí es nullable, porque igual no quieres cambiar la foto
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($request->all());

        // Si el usuario ha subido una foto nueva...
        if ($request->hasFile('poster')) {
            $movie->clearMediaCollection('poster'); // Borramos la vieja
            $movie->addMediaFromRequest('poster')
                  ->toMediaCollection('poster');    // Ponemos la nueva
        }

        return redirect()->route('movies.index')
            ->with('success', 'Película actualizada correctamente.');
    }

    // 5. Borrar película
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete(); // Esto borra también la imagen automáticamente

        return redirect()->route('movies.index')
            ->with('success', 'Película eliminada.');
    }
}
