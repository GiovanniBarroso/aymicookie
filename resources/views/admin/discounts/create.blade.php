@extends('layouts.app')

@section('title', 'Crear Descuento')

@section('content')
    <div class="container py-5">

        <!-- CABECERA -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('discounts.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver a Descuentos
            </a>
            <h1 class="text-center text-brown fw-bold flex-grow-1 m-0">🛒 Crear Descuento</h1>
        </div>

        <!-- FORMULARIO -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <form method="POST" action="{{ route('discounts.store') }}">
                @csrf

                <div class="row g-4">
                    <!-- Código -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Código del Descuento</label>
                        <input type="text" name="codigo" class="form-control rounded-pill" required>
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Descripción</label>
                        <input type="text" name="description" class="form-control rounded-pill">
                    </div>

                    <!-- Tipo -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tipo de Descuento</label>
                        <select name="tipo" class="form-select rounded-pill" required>
                            <option value="producto">Producto</option>
                            <option value="categoria">Categoría</option>
                            <option value="global">Global</option>
                        </select>
                    </div>

                    <!-- Valor -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Valor (%)</label>
                        <input type="number" name="valor" class="form-control rounded-pill" required min="1"
                            max="100">
                    </div>

                    <!-- Fecha de Inicio -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control rounded-pill" required>
                    </div>

                    <!-- Fecha de Fin -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" class="form-control rounded-pill" required>
                    </div>

                    <!-- Producto -->
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Producto (Opcional)</label>
                        <select name="products_id" class="form-select rounded-pill">
                            <option value="">-- No aplicar a producto específico --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm">
                            💾 Guardar Descuento
                        </button>
                        <a href="{{ route('discounts.index') }}"
                            class="btn btn-secondary fw-bold px-4 py-2 rounded-pill shadow-sm ms-2">
                            ❌ Cancelar
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
