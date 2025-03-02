@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')

    <div class="container py-5">

        <!-- BOTÓN VOLVER -->
        <div class="mb-3">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver a Productos
            </a>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="card shadow-lg border-0 rounded-4 p-4">

            <h1 class="text-center fw-bold text-primary mb-4">✏️ Editar Producto #{{ $product->id }}</h1>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- FORMULARIO -->
                    <div class="col-md-6">
                        @include('admin.products._form')
                    </div>

                    <!-- IMAGEN ACTUAL -->
                    <div class="col-md-6 text-center">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del Producto"
                                class="img-fluid rounded-4 shadow-sm" style="max-height: 400px; object-fit: cover;">
                            <p class="mt-2 text-muted fst-italic">Imagen actual del producto</p>
                        @else
                            <div class="text-muted fst-italic py-5">🚫 Sin imagen disponible</div>
                        @endif
                    </div>

                </div>

                <!-- BOTONES DE ACCIÓN -->
                <div class="d-flex justify-content-center gap-3 mt-5">
                    <a href="{{ route('products.index') }}"
                        class="btn btn-secondary fw-bold rounded-pill shadow-sm px-4 py-2 d-inline-flex align-items-center gap-2">
                        ❌ Cancelar
                    </a>

                    <button type="submit"
                        class="btn btn-success fw-bold rounded-pill shadow-sm px-4 py-2 d-inline-flex align-items-center gap-2">
                        💾 Guardar Cambios
                    </button>
                </div>

            </form>

        </div>

    </div>

@endsection
