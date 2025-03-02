@extends('layouts.app')

@section('title', 'Editar Marca')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-brown fw-bold">✏️ Editar Marca</h1>

        <div class="card shadow-sm border-0 rounded-4 p-4">
            <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Nombre de la Marca -->
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="nombre" class="form-control rounded-pill @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre', $brand->nombre) }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Descripción</label>
                        <textarea name="descripcion" class="form-control rounded @error('descripcion') is-invalid @enderror">{{ old('descripcion', $brand->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill shadow-sm">
                            💾 Guardar Cambios
                        </button>
                        <a href="{{ route('brands.index') }}" class="btn btn-secondary fw-bold px-4 py-2 rounded-pill shadow-sm">
                            ❌ Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
