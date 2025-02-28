@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg p-4">
            <h1 class="mb-4 text-primary text-center">Editar Producto</h1>
            
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        @include('admin.products._form')
                    </div>
                    
                    <div class="col-md-6 text-center">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm mb-3" width="100%" alt="Imagen del Producto">
                        @else
                            <div class="text-muted">No hay imagen disponible</div>
                        @endif
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar Producto</button>
                </div>
            </form>
        </div>
    </div>
@endsection
