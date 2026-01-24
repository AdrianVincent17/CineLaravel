<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CineLaravel</title>
    {{-- AQUÍ ESTÁ EL TRUCO: Cargamos Bootstrap directamente de internet --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #1a1d20; color: white; }
        .card { transition: transform 0.3s; border: none; }
        .card:hover { transform: scale(1.03); }
        .age-badge { position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.8); padding: 5px 10px; border-radius: 5px; font-weight: bold; }
        .navbar-brand { font-weight: bold; color: #dc3545 !important; font-size: 1.5rem; }
    </style>
</head>
<body>

    {{-- Barra de Navegación --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">CineLaravel 🍿</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/movies') }}" class="btn btn-outline-light btn-sm">Panel Admin</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-light">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-danger btn-sm">Registrarse</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- Contenido Principal --}}
    <div class="container py-4">
        
        <h1 class="mb-4 border-start border-4 border-danger ps-3">Últimos Estrenos</h1>

        {{-- BUSCADOR Y FILTROS (Estilo Bootstrap) --}}
        <div class="card bg-dark text-white border-secondary mb-5 p-3">
            <form action="{{ route('home') }}" method="GET" class="row g-3 align-items-center">
                
                {{-- Buscador --}}
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control bg-secondary text-white border-0" 
                           placeholder="Buscar película..." value="{{ request('search') }}">
                </div>

                {{-- Selector --}}
                <div class="col-md-4">
                    <select name="genre_id" class="form-select bg-secondary text-white border-0">
                        <option value="">Todos los géneros</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones --}}
                <div class="col-md-2 d-grid gap-2 d-md-flex">
                    <button type="submit" class="btn btn-danger w-100">Buscar</button>
                    @if(request('search') || request('genre_id'))
                        <a href="{{ route('home') }}" class="btn btn-secondary">X</a>
                    @endif
                </div>
            </form>
        </div>

        {{-- GRID DE PELÍCULAS --}}
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($movies as $movie)
            <div class="col">
                <div class="card h-100 bg-dark text-white shadow">
                    
                    {{-- Imagen --}}
                    <div style="position: relative; overflow: hidden; height: 400px;">
                        @if($movie->getFirstMediaUrl('poster'))
                            <img src="{{ $movie->getFirstMediaUrl('poster') }}" class="card-img-top h-100 w-100" style="object-fit: cover;" alt="{{ $movie->title }}">
                        @else
                            <div class="d-flex justify-content-center align-items-center h-100 bg-secondary text-white">
                                Sin imagen
                            </div>
                        @endif
                        <span class="age-badge">{{ $movie->age_rating }}</span>
                    </div>

                    {{-- Cuerpo de la tarjeta --}}
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-truncate">{{ $movie->title }}</h5>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-danger">{{ $movie->genre->name }}</span>
                            <small class="text-muted">⏱ {{ $movie->duration }} min</small>
                        </div>
                        <p class="card-text text-secondary small text-truncate">{{ $movie->synopsis }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($movies->isEmpty())
            <div class="text-center text-muted mt-5">
                <h3>No hay películas disponibles 😢</h3>
            </div>
        @endif

    </div>

    <footer class="text-center text-secondary py-5 mt-5 border-top border-secondary">
        &copy; {{ date('Y') }} CineLaravel
    </footer>

    {{-- Script de Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>