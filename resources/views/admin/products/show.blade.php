@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ $product->nombre }}</h1>

        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mb-3" width="300"
                alt="Imagen del Producto">
        @endif

        <p><strong>Descripción:</strong> {{ $product->descripcion }}</p>
        <p><strong>Precio:</strong> {{ number_format($product->precio, 2) }} €</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Categoría:</strong> {{ $product->category->nombre }}</p>
        <p><strong>Marca:</strong> {{ $product->brand->nombre }}</p>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver a la lista</a>
    </div>
@endsection
