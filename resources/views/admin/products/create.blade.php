@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Añadir Producto</h1>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="categories_id" class="form-label">Categoría</label>
                <select name="categories_id" id="categories_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="brands_id" class="form-label">Marca</label>
                <select name="brands_id" id="brands_id" class="form-control" required>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </form>
    </div>
@endsection
