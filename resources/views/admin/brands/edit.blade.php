@extends('layouts.app')

@section('title', 'Editar Marca')

@section('content')
    <div class="container py-5">
        <h1 class="text-center fw-bold mb-5 text-primary">✏️ Editar Marca #{{ $brand->id }}</h1>

        <div class="card shadow-lg border-0 rounded-4 p-4">
            <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Nombre -->
                    <div class="col-md-12">
                        <label for="nombre" class="form-label fw-bold">🏷️ Nombre de la Marca</label>
                        <input type="text" name="nombre" id="nombre"
                            class="form-control rounded-pill shadow-sm @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $brand->nombre) }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label fw-bold">📝 Descripción</label>
                        <textarea name="descripcion" id="descripcion"
                            class="form-control rounded-4 shadow-sm @error('descripcion') is-invalid @enderror" rows="4">{{ old('descripcion', $brand->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="col-md-12 d-flex justify-content-between mt-4">
                        <a href="{{ route('brands.index') }}"
                            class="btn btn-secondary fw-bold px-4 py-2 rounded-pill shadow-sm">
                            ❌ Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill shadow-sm">
                            💾 Guardar Cambios
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
