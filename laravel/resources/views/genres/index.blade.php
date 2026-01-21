<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestionar Géneros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Botón Superior (Aún no funciona, pero lo dejamos listo) --}}
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('genres.create') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            + Nuevo Género
                        </a>
                    </div>

                    {{-- Tabla de Datos --}}
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nombre del Género
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($genres as $genre)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap font-bold">
                                        {{ $genre->name }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        {{-- Botón Editar --}}
                                        <a href="{{ route('genres.edit', $genre->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">
                                            Editar
                                        </a>

                                        {{-- Botón Borrar (Requiere un formulario por seguridad) --}}
                                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de querer borrar este género?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bg-transparent border-0 cursor-pointer">
                                                Borrar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Mensaje si está vacío --}}
                    @if($genres->isEmpty())
                    <div class="text-center py-4 text-gray-500">
                        No hay géneros creados aún.
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>