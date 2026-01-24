<x-app-layout>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold">Editar Película</h4>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Título --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Título</label>
                            <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="form-control" required>
                        </div>

                        {{-- Sinopsis --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Sinopsis</label>
                            <textarea name="synopsis" rows="3" class="form-control" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Duración</label>
                                <input type="number" name="duration" value="{{ old('duration', $movie->duration) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Edad</label>
                                <select name="age_rating" class="form-select">
                                    @foreach(['TP', '+7', '+12', '+16', '+18'] as $rating)
                                        <option value="{{ $rating }}" {{ $movie->age_rating == $rating ? 'selected' : '' }}>
                                            {{ $rating }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Género</label>
                            <select name="genre_id" class="form-select" required>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ $movie->genre_id == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Cambiar Póster (Opcional)</label>
                            
                            @if($movie->getFirstMediaUrl('poster'))
                                <div class="mb-2 p-2 border rounded d-inline-block">
                                    <img src="{{ $movie->getFirstMediaUrl('poster') }}" width="100" class="rounded">
                                    <div class="small text-muted text-center mt-1">Actual</div>
                                </div>
                            @endif

                            <input type="file" name="poster" class="form-control" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-4">Actualizar Cambios</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>