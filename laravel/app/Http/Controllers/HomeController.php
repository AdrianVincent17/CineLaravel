<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Traemos todas las películas, ordenadas por las más recientes
        // Usamos 'with' para que la carga del género sea rápida
        $movies = Movie::with('genre')->latest()->get();

        return view('welcome', compact('movies'));
    }
}
