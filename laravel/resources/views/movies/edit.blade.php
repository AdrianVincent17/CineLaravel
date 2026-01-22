<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Película') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Importante para actualizar --}}

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Título:</label>
                            <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="border rounded w-full py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Sinopsis:</label>
                            <textarea name="synopsis" rows="3" class="border rounded w-full py-2 px-3" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Duración (min):</label>
                                <input type="number" name="duration" value="{{ old('duration', $movie->duration) }}" class="border rounded w-full py-2 px-3" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Edad:</label>
                                <select name="age_rating" class="border rounded w-full py-2 px-3">
                                    {{-- Un pequeño truco para seleccionar el valor actual --}}
                                    @foreach(['TP', '+7', '+12', '+16', '+18'] as $rating)
                                        <option value="{{ $rating }}" {{ $movie->age_rating == $rating ? 'selected' : '' }}>
                                            {{ $rating }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Género:</label>
                            <select name="genre_id" class="border rounded w-full py-2 px-3" required>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ $movie->genre_id == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Cambiar Póster (Opcional):</label>
                            
                            {{-- Mostrar imagen actual si existe --}}
                            @if($movie->getFirstMediaUrl('poster'))
                                <div class="mb-2">
                                    <img src="{{ $movie->getFirstMediaUrl('poster') }}" width="100" class="rounded shadow">
                                </div>
                            @endif

                            <input type="file" name="poster" class="border rounded w-full py-2 px-3" accept="image/*">
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-dark font-bold py-2 px-4 rounded">
                                Actualizar Película
                            </button>
                            <a href="{{ route('movies.index') }}" class="text-blue-500 hover:text-blue-800">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>