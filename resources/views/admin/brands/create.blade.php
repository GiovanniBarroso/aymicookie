@extends('layouts.app')

@section('title', 'Crear Marca')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-brown fw-bold">🛒 Crear Marca</h1>

        <div class="card shadow-sm border-0 rounded-4 p-4">
            <form method="POST" action="{{ route('brands.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre de la Marca</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea name="descripcion" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Guardar Marca</button>
            </form>
        </div>
    </div>
@endsection
