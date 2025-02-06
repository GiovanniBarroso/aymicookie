@extends('layouts.app')

@section('content')
<h1>Lista de Productos</h1>
<a href="{{ route('products.create') }}" class="btn btn-primary">Agregar Producto</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
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
                <td>{{ $product->nombre }}</td>
                <td>{{ $product->descripcion }}</td>
                <td>{{ $product->precio }}€</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category->nombre }}</td>
                <td>{{ $product->brand->nombre }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection