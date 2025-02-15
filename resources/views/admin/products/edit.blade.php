@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Editar Producto</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $product->nombre }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ $product->descripcion }}</textarea>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" name="precio" id="precio" class="form-control" value="{{ $product->precio }}"
                    step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="categories_id" class="form-label">Categoría</label>
                <select name="categories_id" id="categories_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == $product->categories_id ? 'selected' : '' }}>{{ $category->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="brands_id" class="form-label">Marca</label>
                <select name="brands_id" id="brands_id" class="form-control" required>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brands_id ? 'selected' : '' }}>
                            {{ $brand->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
@endsection
