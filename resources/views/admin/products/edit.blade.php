@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Editar Producto</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.products._form')
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
@endsection
