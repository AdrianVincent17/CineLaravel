<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Muestra la lista de géneros.
     */
    public function index()
    {
        // 1. Recuperamos todos los géneros
        $genres = Genre::all();

        // 2. Retornamos la vista pasando los datos
        return view('genres.index', compact('genres'));
    }

   // 1. Muestra el formulario
    public function create()
    {
        return view('genres.create');
    }

    // 2. Guarda el dato en la base de datos
    public function store(Request $request)
    {
        // Validamos que el nombre sea obligatorio y no se repita
        $request->validate([
            'name' => 'required|unique:genres,name|max:255',
        ]);

        // Creamos el género
        Genre::create($request->all());

        // Volvemos a la lista avisando que todo salió bien
        return redirect()->route('genres.index')
            ->with('success', 'Género creado correctamente.');
    }

    // 3. Muestra el formulario de edición con los datos cargados
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
    }

    // 4. Actualiza los datos en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:genres,name,' . $id . '|max:255',
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update($request->all());

        return redirect()->route('genres.index')
            ->with('success', 'Género actualizado correctamente.');
    }

    // 5. Borra el género
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genres.index')
            ->with('success', 'Género eliminado correctamente.');
    }
}