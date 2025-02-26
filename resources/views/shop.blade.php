<!-- Mejorada shop.blade.php con filtros y diseño optimizado -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Tienda de Productos</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filtros -->
        <form method="GET" action="{{ route('products.shop') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <select name="category" class="form-control">
                        <option value="">Todas las categorías</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="brand" class="form-control">
                        <option value="">Todas las marcas</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="min_price" class="form-control" placeholder="Precio mínimo"
                        value="{{ request('min_price') }}">
                </div>
                <div class="col-md-3">
                    <input type="number" name="max_price" class="form-control" placeholder="Precio máximo"
                        value="{{ request('max_price') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
        </form>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->nombre }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Sin imagen">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nombre }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <p><strong>Precio:</strong> {{ number_format($product->precio, 2) }} €</p>
                            <a href="#" class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Agregar al
                                Carrito</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll('.add-to-cart'); // Seleccionamos todos los botones

            buttons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenimos que el enlace se ejecute normalmente

                    let productId = this.getAttribute('data-id'); // Obtenemos el ID del producto
                    console.log("Intentando agregar producto con ID:", productId); // Para depurar

                    // Enviar una solicitud fetch al servidor para agregar el producto
                    fetch("{{ route('cart.add') }}", {
                            method: "POST", // Método POST
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}" // Asegúrate de que el token esté presente
                            },
                            body: JSON.stringify({
                                product_id: productId, // Pasamos el ID del producto
                                cantidad: 1 // Asumimos que el carrito agrega solo 1 unidad por clic
                            })
                        })
                        .then(response => response.json()) // Procesamos la respuesta como JSON
                        .then(data => {
                            console.log("Respuesta del servidor:",
                            data); // Verificamos la respuesta del servidor
                            if (data.success) {
                                alert('Producto agregado al carrito');
                            } else {
                                alert('Error al agregar el producto');
                            }
                        })
                        .catch(error => console.error('Error en la petición:',
                        error)); // Capturamos errores en la solicitud
                });
            });
        });
    </script>
@endsection
