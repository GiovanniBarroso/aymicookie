@extends('layouts.app')

@section('title', 'Gestión de Productos')

@section('content')

    <div class="container py-5">

        <!-- BOTÓN VOLVER -->
        <div class="mb-3">
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver al Panel
            </a>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="card shadow-lg border-0 rounded-4">

            <!-- HEADER -->
            <div
                class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4 py-3 px-4">
                <h1 class="fw-bold fs-4 m-0">📦 Gestión de Productos</h1>
                <a href="{{ route('products.create') }}" class="btn btn-warning fw-bold rounded-pill shadow-sm">
                    ➕ Añadir Producto
                </a>
            </div>

            <!-- BODY -->
            <div class="card-body p-0">
                @if ($products->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="text-muted mb-3">🚫 No hay productos registrados aún.</h5>
                        <p>Empieza creando tu primer producto para tu catálogo. 🛒</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle m-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#ID</th>
                                    <th>🖼️ Imagen</th>
                                    <th>📄 Nombre</th>
                                    <th>📝 Descripción</th>
                                    <th>💰 Precio</th>
                                    <th>📦 Stock</th>
                                    <th>📂 Categoría</th>
                                    <th>🏷️ Marca</th>
                                    <th class="text-center">⚙️ Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen"
                                                    class="img-thumbnail rounded-3" width="80">
                                            @else
                                                <span class="text-muted fst-italic">Sin imagen</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->nombre }}</td>
                                        <td>{{ Str::limit($product->description, 30, '...') }}</td>
                                        <td>{{ number_format($product->precio, 2, ',', '.') }} €</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->category->nombre }}</td>
                                        <td>{{ $product->brand->nombre }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-sm btn-outline-info rounded-pill shadow-sm d-inline-flex align-items-center gap-1">
                                                    📄 Ver
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-sm btn-outline-warning rounded-pill shadow-sm d-inline-flex align-items-center gap-1">
                                                    ✏️ Editar
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                    onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-pill shadow-sm d-inline-flex align-items-center gap-1">
                                                        🗑️ Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @endif
            </div>

            <!-- FOOTER -->
            <div class="card-footer text-center py-3 text-muted">
                Mostrando <strong>{{ $products->count() }}</strong> {{ Str::plural('producto', $products->count()) }}
            </div>

        </div>

    </div>

@endsection
