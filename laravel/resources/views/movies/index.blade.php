<x-app-layout>
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Gestión de Películas</h2>
        <a href="{{ route('movies.create') }}" class="btn btn-primary">
            + Nueva Película
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="ps-4">Póster</th>
                        <th scope="col">Título</th>
                        <th scope="col">Género</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Edad</th>
                        <th scope="col" class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr>
                        <td class="ps-4">
                            @if($movie->getFirstMediaUrl('poster'))
                                <img src="{{ $movie->getFirstMediaUrl('poster') }}" width="50" class="rounded border">
                            @else
                                <span class="badge bg-secondary">Sin img</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $movie->title }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $movie->genre->name }}</span>
                        </td>
                        <td>{{ $movie->duration }} min</td>
                        <td>{{ $movie->age_rating }}</td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>

                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('¿Borrar {{ $movie->title }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Borrar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @if($movies->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No hay películas registradas todavía.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>