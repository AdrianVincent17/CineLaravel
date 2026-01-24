<x-app-layout>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold">Nueva Película</h4>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 

                        {{-- Título --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Título</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        {{-- Sinopsis --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Sinopsis</label>
                            <textarea name="synopsis" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="row">
                            {{-- Duración --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Duración (min)</label>
                                <input type="number" name="duration" class="form-control" required>
                            </div>

                            {{-- Edad --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Calificación Edad</label>
                                <select name="age_rating" class="form-select">
                                    <option value="TP">TP (Todos los públicos)</option>
                                    <option value="+7">+7</option>
                                    <option value="+12">+12</option>
                                    <option value="+16">+16</option>
                                    <option value="+18">+18</option>
                                </select>
                            </div>
                        </div>

                        {{-- Género --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Género</label>
                            <select name="genre_id" class="form-select" required>
                                <option value="">Selecciona...</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PÓSTER --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Póster de la Película</label>
                            <input type="file" name="poster" class="form-control" accept="image/*" required>
                            <div class="form-text">Formatos: JPG, PNG. Máx 2MB.</div>
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success px-4">Guardar Película</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>