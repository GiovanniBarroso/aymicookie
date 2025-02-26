@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Producto</h1>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $product->nombre }}</h3>
            <p class="card-text">{{ $product->description }}</p>
            <p><strong>Precio:</strong> {{ $product->precio }} €</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <p><strong>Categoría:</strong> {{ $product->category->nombre }}</p>
            <p><strong>Marca:</strong> {{ $product->brand->nombre }}</p>

            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="200">
            @endif

            <br><br>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
