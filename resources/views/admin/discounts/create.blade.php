@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-brown fw-bold">🛒 Crear Descuento</h1>

        <div class="card shadow-sm border-0 rounded-4 p-4">
            <form method="POST" action="{{ route('discounts.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Código del Descuento</label>
                    <input type="text" name="codigo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tipo de Descuento</label>
                    <select name="tipo" class="form-select" required>
                        <option value="producto">Descuento por Producto</option>
                        <option value="categoria">Descuento por Categoría</option>
                        <option value="global">Descuento Global</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Valor (%)</label>
                    <input type="number" name="valor" class="form-control" required min="1" max="100">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Fecha de Fin</label>
                    <input type="date" name="fecha_fin" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Producto (Opcional)</label>
                    <select name="products_id" class="form-select">
                        <option value="">-- No Aplicar a Producto Específico --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar Descuento</button>
            </form>
        </div>
    </div>
@endsection
