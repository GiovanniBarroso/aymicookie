@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Añadir Producto</h1>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.products._form')
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </form>
    </div>
@endsection
