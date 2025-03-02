@extends('layouts.app')

@section('title', 'Detalles del Producto')

@section('content')

<div class="container py-5">

    <!-- BOTÓN VOLVER -->
    <div class="mb-3">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
            🔙 Volver a Productos
        </a>
    </div>

    <!-- CARD DEL PRODUCTO -->
    <div class="card shadow-lg border-0 rounded-4 p-4">

        <div class="row g-4 align-items-center">

            <!-- IMAGEN DEL PRODUCTO -->
            <div class="col-md-6 text-center">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del Producto"
                        class="img-fluid rounded-4 shadow-sm" style="max-height: 400px; object-fit: cover;">
                @else
                    <div class="text-muted fst-italic">🚫 Sin imagen disponible</div>
                @endif
            </div>

            <!-- INFORMACIÓN DEL PRODUCTO -->
            <div class="col-md-6">
                <h1 class="fw-bold text-primary mb-3">{{ $product->nombre }}</h1>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>📝 Descripción:</strong>
                        <div>{{ $product->description }}</div>
                    </li>
                    <li class="list-group-item">
                        <strong>💰 Precio:</strong>
                        <span class="text-success fw-bold">{{ number_format($product->precio, 2, ',', '.') }} €</span>
                    </li>
                    <li class="list-group-item">
                        <strong>📦 Stock:</strong>
                        <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }} px-3 py-2">
                            {{ $product->stock }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <strong>📂 Categoría:</strong> {{ $product->category->nombre }}
                    </li>
                    <li class="list-group-item">
                        <strong>🏷️ Marca:</strong> {{ $product->brand->nombre }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- BOTONES DE ACCIÓN -->
        <div class="d-flex justify-content-center gap-3 mt-5">
            <a href="{{ route('products.edit', $product->id) }}"
                class="btn btn-warning fw-bold rounded-pill shadow-sm px-4 py-2 d-inline-flex align-items-center gap-2">
                ✏️ Editar Producto
            </a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="btn btn-danger fw-bold rounded-pill shadow-sm px-4 py-2 d-inline-flex align-items-center gap-2">
                    🗑️ Eliminar Producto
                </button>
            </form>
        </div>

    </div>

</div>

@endsection
