<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CineLaravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-900 text-white font-sans antialiased">

        <nav class="bg-gray-800 border-b border-gray-700 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold text-red-600">CineLaravel 🍿</span>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <div class="space-x-4">
                                @auth
                                    <a href="{{ url('/genres') }}" class="text-gray-300 hover:text-white">Panel Admin</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Entrar</a>
                                    <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm font-medium">Registrarse</a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <h1 class="text-3xl font-bold mb-8 border-l-4 border-red-600 pl-4">Últimos Estrenos</h1>

                {{-- 
                    AQUÍ ESTÁ EL CAMBIO CLAVE:
                    grid-cols-1: En móvil se ve 1 grande.
                    md:grid-cols-3: En ordenador se ven 3 columnas exactas.
                    gap-8: Más separación entre ellas para que respiren.
                --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    @foreach($movies as $movie)
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-2xl hover:scale-105 transition-transform duration-300 group border border-gray-700">
                        
                        {{-- Imagen Grande --}}
                        <div class="relative aspect-[2/3]">
                            @if($movie->getFirstMediaUrl('poster'))
                                <img src="{{ $movie->getFirstMediaUrl('poster') }}" class="object-cover w-full h-full" alt="{{ $movie->title }}">
                            @else
                                <div class="w-full h-full bg-gray-700 flex items-center justify-center text-gray-500 text-lg">
                                    Sin imagen
                                </div>
                            @endif
                            
                            {{-- Edad --}}
                            <div class="absolute top-3 right-3 bg-black bg-opacity-80 text-white font-bold px-3 py-1 rounded">
                                {{ $movie->age_rating }}
                            </div>
                        </div>

                        {{-- Información --}}
                        <div class="p-6">
                            <h3 class="font-bold text-2xl mb-2 group-hover:text-red-500 transition-colors">{{ $movie->title }}</h3>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="bg-red-600 text-white text-xs px-2 py-1 rounded uppercase tracking-wide">
                                    {{ $movie->genre->name }}
                                </span>
                                <span class="text-gray-400 text-sm flex items-center">
                                    ⏱ {{ $movie->duration }} min
                                </span>
                            </div>

                            <p class="text-gray-400 text-sm line-clamp-3 leading-relaxed">
                                {{ $movie->synopsis }}
                            </p>
                        </div>

                    </div>
                    @endforeach

                </div>

                @if($movies->isEmpty())
                    <div class="text-center text-gray-500 mt-20 text-xl">
                        <p>No hay películas disponibles.</p>
                    </div>
                @endif

            </div>
        </main>

        <footer class="bg-gray-800 py-8 mt-16 text-center text-gray-400">
            &copy; {{ date('Y') }} CineLaravel
        </footer>
    </body>
</html>