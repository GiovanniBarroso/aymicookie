@extends('layouts.app')

@section('content')
    <div class="container mt-4 mb-5">
        <h1 class="text-center mb-4 text-white">🍪 Encuentra tu galleta favorita 🍪</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Botón para mostrar/ocultar filtros -->
        <div class="text-center mb-4">
            <button id="toggleFilters" class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill shadow-sm"
                type="button" data-bs-toggle="collapse" data-bs-target="#filtersContainer" aria-expanded="false"
                aria-controls="filtersContainer">
                <i class="fas fa-filter"></i> Mostrar Filtros
            </button>
        </div>

        <!-- Contenedor de Filtros con margen dinámico -->
        <div id="filtersContainer" class="collapse">
            <div class="card card-body bg-light p-4 shadow-sm rounded-4 border-0">
                <form method="GET" action="{{ route('products.shop') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select name="category" class="form-select rounded-pill">
                                    <option value="">Todas las categorías</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Categoría</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select name="brand" class="form-select rounded-pill">
                                    <option value="">Todas las marcas</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>Marca</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" name="min_price" class="form-control rounded-pill"
                                    placeholder="Precio mínimo" value="{{ request('min_price') }}">
                                <label>Precio mínimo</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" name="max_price" class="form-control rounded-pill"
                                    placeholder="Precio máximo" value="{{ request('max_price') }}">
                                <label>Precio máximo</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-cookie"></i> Aplicar Filtros
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de Productos -->
        <div id="productsContainer" class="mt-3">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 bg-light rounded-4">
                            <!-- Imagen del Producto -->
                            <div class="ratio ratio-4x3">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="card-img-top img-fluid rounded-top-4" alt="{{ $product->nombre }}"
                                    loading="lazy">
                            </div>

                            <!-- Contenido de la Tarjeta -->
                            <div class="card-body d-flex flex-column text-center">
                                <!-- Nombre del Producto y Botón de Favorito alineados -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title fs-4 fw-bold text-brown m-0">{{ $product->nombre }}</h5>
                                    <button class="btn-favorite border-0 bg-transparent fs-4 transition"
                                        data-product-id="{{ $product->id }}"
                                        data-favorited="{{ in_array($product->id, $favorites) ? 'true' : 'false' }}">
                                        {{ in_array($product->id, $favorites) ? '❤️' : '🤍' }}
                                    </button>
                                </div>



                                <p class="card-text small text-muted">{{ Str::limit($product->description, 50) }}</p>
                                <span class="badge bg-warning text-dark fs-5 py-2 px-3 mb-2">
                                    @if ($product->precio_descuento)
                                        <span class="text-danger text-decoration-line-through">
                                            {{ number_format($product->precio, 2) }} €
                                        </span>
                                        <strong>{{ number_format($product->precio_descuento, 2) }} €</strong>
                                    @else
                                        <strong>{{ number_format($product->precio, 2) }} €</strong>
                                    @endif
                                </span>



                                <div class="mt-auto">
                                    <button class="btn btn-warning text-white w-100 add-to-cart rounded-pill shadow-sm"
                                        data-id="{{ $product->id }}"
                                        aria-label="Agregar {{ $product->nombre }} al carrito">
                                        <i class="fas fa-cart-plus"></i> Añadir al carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>



        <!-- Toast de Notificación -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="cart-toast" class="toast bg-warning text-white align-items-center" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ¡Galleta agregada al carrito! 🍪
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Cerrar"></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterPanel = document.getElementById("filtersContainer");
            const productsContainer = document.getElementById("productsContainer");
            const toggleButton = document.getElementById("toggleFilters");

            function adjustMargin() {
                setTimeout(() => {
                    if (filterPanel.classList.contains("show")) {
                        productsContainer.style.marginTop = filterPanel.offsetHeight + "px";
                    } else {
                        productsContainer.style.marginTop = "0px";
                    }
                }, 300); // Espera a que el collapse termine su animación
            }

            // Escuchar los eventos de Bootstrap Collapse para ajustar el margen dinámicamente
            filterPanel.addEventListener("shown.bs.collapse", adjustMargin);
            filterPanel.addEventListener("hidden.bs.collapse", adjustMargin);

            // Lógica del carrito
            const buttons = document.querySelectorAll('.add-to-cart');
            const toastElement = document.getElementById('cart-toast');
            const toast = new bootstrap.Toast(toastElement, {
                delay: 2000
            });

            buttons.forEach(button => {
                button.addEventListener('click', async event => {
                    event.preventDefault();
                    const productId = button.dataset.id;

                    try {
                        const response = await fetch("{{ route('cart.add') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                cantidad: 1
                            })
                        });

                        const data = await response.json();
                        if (data.success) {
                            toast.show();
                        } else {
                            console.error('Error al agregar el producto:', data.error);
                        }
                    } catch (error) {
                        console.error('Error en la solicitud:', error);
                    }
                });
            });

            document.querySelectorAll('.btn-favorite').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    const isFavorited = this.dataset.favorited === "true"; // Verifica estado actual

                    fetch(`/favorites/toggle/${productId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                'Content-Type': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(data => {
                            this.style.transition =
                                "transform 0.2s ease-in-out, opacity 0.2s ease-in-out";
                            this.style.opacity = "0"; // Desvanecer antes del cambio

                            setTimeout(() => {
                                if (isFavorited) {
                                    this.innerHTML = '🤍'; // Cambia a no favorito
                                    this.dataset.favorited = "false";
                                } else {
                                    this.innerHTML = '❤️'; // Cambia a favorito
                                    this.dataset.favorited = "true";
                                }
                                this.style.opacity = "1"; // Aparecer con transición
                                this.style.transform =
                                    "scale(1.1)"; // Pequeña animación al cambiar
                                setTimeout(() => {
                                    this.style.transform = "scale(1)";
                                }, 150);
                            }, 200);
                        }).catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
@endsection
