@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gestión de Productos</h1>

        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Añadir Producto</a>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen" class="img-thumbnail"
                                    width="50">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $product->nombre }}</td>
                        <td>{{ number_format($product->precio, 2) }} €</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->nombre }}</td>
                        <td>{{ $product->brand->nombre }}</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
