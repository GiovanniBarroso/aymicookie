@csrf

<!-- Subir Imagen -->
<div class="mb-4">
    <label for="image" class="form-label fw-bold">📸 Imagen del Producto</label>
    <input type="file" name="image" id="image"
        class="form-control rounded-pill shadow-sm @error('image') is-invalid @enderror">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Nombre -->
<div class="mb-4">
    <label for="nombre" class="form-label fw-bold">📌 Nombre del Producto</label>
    <input type="text" name="nombre" id="nombre"
        class="form-control rounded-pill shadow-sm @error('nombre') is-invalid @enderror"
        value="{{ old('nombre', $product->nombre ?? '') }}" required>
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Descripción -->
<div class="mb-4">
    <label for="description" class="form-label fw-bold">📝 Descripción</label>
    <textarea name="description" id="description"
        class="form-control rounded-4 shadow-sm @error('description') is-invalid @enderror" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Precio -->
<div class="mb-4">
    <label for="precio" class="form-label fw-bold">💶 Precio (€)</label>
    <input type="number" name="precio" id="precio"
        class="form-control rounded-pill shadow-sm @error('precio') is-invalid @enderror"
        value="{{ old('precio', $product->precio ?? '') }}" step="0.01" required>
    @error('precio')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Stock -->
<div class="mb-4">
    <label for="stock" class="form-label fw-bold">📦 Stock</label>
    <input type="number" name="stock" id="stock"
        class="form-control rounded-pill shadow-sm @error('stock') is-invalid @enderror"
        value="{{ old('stock', $product->stock ?? '') }}" required>
    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Categoría -->
<div class="mb-4">
    <label for="categories_id" class="form-label fw-bold">📂 Categoría</label>
    <select name="categories_id" id="categories_id"
        class="form-select rounded-pill shadow-sm @error('categories_id') is-invalid @enderror" required>
        <option value="">Selecciona una categoría</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('categories_id', $product->categories_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->nombre }}
            </option>
        @endforeach
    </select>
    @error('categories_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Marca -->
<div class="mb-4">
    <label for="brands_id" class="form-label fw-bold">🏷️ Marca</label>
    <select name="brands_id" id="brands_id"
        class="form-select rounded-pill shadow-sm @error('brands_id') is-invalid @enderror" required>
        <option value="">Selecciona una marca</option>
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}"
                {{ old('brands_id', $product->brands_id ?? '') == $brand->id ? 'selected' : '' }}>
                {{ $brand->nombre }}
            </option>
        @endforeach
    </select>
    @error('brands_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
