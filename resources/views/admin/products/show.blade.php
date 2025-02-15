@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ $product->nombre }}</h1>

        <p><strong>Descripción:</strong> {{ $product->descripcion }}</p>
        <p><strong>Precio:</strong> {{ $product->precio }} €</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Categoría:</strong> {{ $product->category->nombre }}</p>
        <p><strong>Marca:</strong> {{ $product->brand->nombre }}</p>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver a la lista</a>
    </div>
@endsection
