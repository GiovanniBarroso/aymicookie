@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <!-- CABECERA -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-brown display-5">✏️ Editar Categoría</h1>
            <p class="text-muted fs-5">Modifica la información de la categoría seleccionada y actualiza su estado.</p>
        </div>

        <!-- FORMULARIO -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4 p-5">

                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold">📌 Nombre de la Categoría <span class="text-danger">*</span></label>
                            <input type="text" name="nombre"
                                class="form-control form-control-lg rounded-pill @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre', $category->nombre) }}" required placeholder="Ejemplo: Galletas Premium">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">📝 Descripción</label>
                            <input type="text" name="description"
                                class="form-control form-control-lg rounded-pill @error('description') is-invalid @enderror"
                                value="{{ old('description', $category->description) }}" placeholder="Describe brevemente la categoría">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center mb-4">
                            <div class="form-check form-switch d-flex align-items-center justify-content-center gap-2">
                                <input class="form-check-input" type="checkbox" role="switch" name="activo" id="activo" {{ $category->activo ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="activo">
                                    {{ $category->activo ? '✅ Activo' : '⛔ Inactivo' }}
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 shadow-sm">
                                ❌ Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning text-white btn-lg fw-bold rounded-pill px-4 shadow-sm">
                                💾 Guardar Cambios
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
