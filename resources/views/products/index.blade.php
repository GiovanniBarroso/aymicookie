@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Productos</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Crear Producto</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}€</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
