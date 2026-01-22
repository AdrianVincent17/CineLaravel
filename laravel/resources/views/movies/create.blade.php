<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Película') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- ¡OJO! El enctype es OBLIGATORIO para subir archivos --}}
                    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 

                        {{-- Título --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Título:</label>
                            <input type="text" name="title" class="border rounded w-full py-2 px-3" required>
                        </div>

                        {{-- Sinopsis --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Sinopsis:</label>
                            <textarea name="synopsis" rows="3" class="border rounded w-full py-2 px-3" required></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            {{-- Duración --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Duración (min):</label>
                                <input type="number" name="duration" class="border rounded w-full py-2 px-3" required>
                            </div>

                            {{-- Calificación Edad --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Edad:</label>
                                <select name="age_rating" class="border rounded w-full py-2 px-3">
                                    <option value="TP">TP (Todos los públicos)</option>
                                    <option value="+7">+7</option>
                                    <option value="+12">+12</option>
                                    <option value="+16">+16</option>
                                    <option value="+18">+18</option>
                                </select>
                            </div>
                        </div>

                        {{-- Género (Cargado desde BD) --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Género:</label>
                            <select name="genre_id" class="border rounded w-full py-2 px-3" required>
                                <option value="">Selecciona un género...</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- IMAGEN (Póster) --}}
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Póster de la Película:</label>
                            <input type="file" name="poster" class="border rounded w-full py-2 px-3" accept="image/*" required>
                            <p class="text-xs text-gray-500 mt-1">Formatos: JPG, PNG. Máx 2MB.</p>
                        </div>

                        {{-- Botones --}}
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-dark font-bold py-2 px-4 rounded">
                                Guardar Película
                            </button>
                            <a href="{{ route('movies.index') }}" class="text-blue-500 hover:text-blue-800">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>