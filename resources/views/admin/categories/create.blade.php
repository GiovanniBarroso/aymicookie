@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <!-- CABECERA -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-brown display-5">📂 Crear Nueva Categoría</h1>
            <p class="text-muted fs-5">Añade una nueva categoría para organizar mejor tus productos.</p>
        </div>

        <!-- FORMULARIO -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4 p-4">

                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <!-- Nombre de la categoría -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">📌 Nombre de la Categoría <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="nombre"
                                class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre') }}" placeholder="Ejemplo: Galletas Artesanales" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">📝 Descripción (Opcional)</label>
                            <textarea name="description" class="form-control form-control-lg @error('description') is-invalid @enderror"
                                rows="4" placeholder="Describe brevemente la categoría">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- BOTONES -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-lg">
                                🔙 Volver
                            </a>
                            <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                                💾 Guardar Categoría
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
