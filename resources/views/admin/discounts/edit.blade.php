@extends('layouts.app')

@section('title', 'Editar Descuento')

@section('content')
    <div class="container py-5">

        <!-- CABECERA -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('discounts.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver a Descuentos
            </a>
            <h1 class="text-center text-brown fw-bold flex-grow-1 m-0">✏️ Editar Descuento</h1>
        </div>

        <!-- FORMULARIO -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Código -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Código</label>
                        <input type="text" name="codigo" class="form-control rounded-pill"
                            value="{{ $discount->codigo }}" required>
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Descripción</label>
                        <input type="text" name="description" class="form-control rounded-pill"
                            value="{{ $discount->description }}">
                    </div>

                    <!-- Tipo de Descuento -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tipo de Descuento</label>
                        <select name="tipo" class="form-select rounded-pill">
                            <option value="producto" {{ $discount->tipo == 'producto' ? 'selected' : '' }}>Producto</option>
                            <option value="categoria" {{ $discount->tipo == 'categoria' ? 'selected' : '' }}>Categoría
                            </option>
                            <option value="global" {{ $discount->tipo == 'global' ? 'selected' : '' }}>Global</option>
                        </select>
                    </div>

                    <!-- Valor -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Valor (%)</label>
                        <input type="number" name="valor" class="form-control rounded-pill"
                            value="{{ $discount->valor }}" required min="1" max="100">
                    </div>

                    <!-- Fecha Inicio -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control rounded-pill"
                            value="{{ $discount->fecha_inicio }}" required>
                    </div>

                    <!-- Fecha Fin -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" class="form-control rounded-pill"
                            value="{{ $discount->fecha_fin }}" required>
                    </div>

                    <!-- Producto -->
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Producto (opcional)</label>
                        <select name="products_id" class="form-select rounded-pill">
                            <option value="">No aplica a un producto específico</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ $discount->products_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estado -->
                    <div class="col-md-12 text-center">
                        <div class="form-check form-switch d-inline-flex align-items-center">
                            <input class="form-check-input" type="checkbox" name="activo" id="activo"
                                {{ $discount->activo ? 'checked' : '' }}>
                            <label for="activo" class="form-check-label fw-bold ms-2">
                                {{ $discount->activo ? 'Activo' : 'Inactivo' }}
                            </label>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm">
                            💾 Guardar Cambios
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
