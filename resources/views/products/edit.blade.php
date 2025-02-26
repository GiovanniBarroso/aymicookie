@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" value="{{ $product->nombre }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio (€)</label>
            <input type="number" name="precio" class="form-control" step="0.01" value="{{ $product->precio }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categories_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->categories_id ? 'selected' : '' }}>
                        {{ $category->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="brands_id" class="form-control" required>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $brand->id == $product->brands_id ? 'selected' : '' }}>
                        {{ $brand->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen Actual</label>
            <br>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Actualizar Producto</button>
    </form>
</div>
@endsection
