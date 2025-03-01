@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-brown fw-bold">✏️ Editar Categoría</h1>

        <div class="card shadow-sm border-0 rounded-4 p-4">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Nombre de la Categoría -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="nombre" class="form-control rounded-pill @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre', $category->nombre) }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Descripción</label>
                        <input type="text" name="description" class="form-control rounded-pill @error('description') is-invalid @enderror"
                               value="{{ old('description', $category->description) }}">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botón de Estado -->
                    <div class="col-md-12 text-center">
                        <label class="form-label fw-bold">Estado</label><br>
                        <input type="checkbox" name="activo" id="activo" {{ $category->activo ? 'checked' : '' }}>
                        <label for="activo" class="fw-bold">{{ $category->activo ? 'Activo' : 'Inactivo' }}</label>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill shadow-sm">
                            💾 Guardar Cambios
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary fw-bold px-4 py-2 rounded-pill shadow-sm">
                            ❌ Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
