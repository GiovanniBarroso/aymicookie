@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio (€)</label>
            <input type="number" name="precio" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categories_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="brands_id" class="form-control" required>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Producto</button>
    </form>
</div>
@endsection
