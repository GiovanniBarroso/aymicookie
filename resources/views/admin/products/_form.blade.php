@csrf

<!-- Imagen del Producto -->
@if (isset($product) && $product->image)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del Producto" class="img-fluid" width="150">
    </div>
@endif

<div class="mb-3">
    <label for="image" class="form-label">Imagen del Producto</label>
    <input type="file" name="image" id="image" class="form-control">
    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre del Producto</label>
    <input type="text" name="nombre" id="nombre" class="form-control"
        value="{{ old('nombre', $product->nombre ?? '') }}" required>
    @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $product->descripcion ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="precio" class="form-label">Precio (€)</label>
    <input type="number" name="precio" id="precio" class="form-control"
        value="{{ old('precio', $product->precio ?? '') }}" step="0.01" required>
</div>

<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" name="stock" id="stock" class="form-control"
        value="{{ old('stock', $product->stock ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="categories_id" class="form-label">Categoría</label>
    <select name="categories_id" id="categories_id" class="form-control" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ isset($product) && $category->id == $product->categories_id ? 'selected' : '' }}>
                {{ $category->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="brands_id" class="form-label">Marca</label>
    <select name="brands_id" id="brands_id" class="form-control" required>
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}"
                {{ isset($product) && $brand->id == $product->brands_id ? 'selected' : '' }}>
                {{ $brand->nombre }}
            </option>
        @endforeach
    </select>
</div>
