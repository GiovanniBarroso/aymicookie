@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-brown fw-bold">📂 Crear Nueva Categoría</h1>

        <div class="card shadow-sm border-0 rounded-4 p-4">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <!-- Nombre de la categoría -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre de la Categoría</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                           value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descripción (Opcional) -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success fw-bold">Guardar Categoría</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
@endsection
