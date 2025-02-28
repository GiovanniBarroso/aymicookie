@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg p-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-4 text-primary">{{ $product->nombre }}</h1>
                    
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm mb-3" width="100%" alt="Imagen del Producto">
                    @else
                        <div class="text-muted">No hay imagen disponible</div>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Descripción:</strong> {{ $product->description }}</li>
                        <li class="list-group-item"><strong>Precio:</strong> <span class="text-success">{{ number_format($product->precio, 2) }} €</span></li>
                        <li class="list-group-item"><strong>Stock:</strong> <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">{{ $product->stock }}</span></li>
                        <li class="list-group-item"><strong>Categoría:</strong> {{ $product->category->nombre }}</li>
                        <li class="list-group-item"><strong>Marca:</strong> {{ $product->brand->nombre }}</li>
                    </ul>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver a la lista</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar Producto</a>
            </div>
        </div>
    </div>
@endsection