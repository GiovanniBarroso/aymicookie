@extends('layouts.app')
@vite('resources/css/favorites.css')

@section('title', 'Mis Favoritos - Ay Mi Cookie')

@section('content')
    <div class="container  mb-5">
        <!-- 🟠 Encabezado Mejorado -->
        <div class="text-center mb-4">
            <h1 class="fw-bold text-brown animate__animated animate__fadeInDown">
                ❤️ Tus Galletas Favoritas ❤️
            </h1>
            <p class="text-muted fs-5">Guarda tus galletas favoritas y añádelas al carrito cuando quieras.</p>
        </div>

        @if ($favorites->isEmpty())
            <!-- 📌 Sección cuando no hay favoritos -->
            <div class="text-center mt-5 no-favorites">
                <img src="{{ asset('images/no-favorites.webp') }}" class="no-favorites-img mx-auto d-block" alt="No favoritos">
                <h3 class="mt-4 fw-bold text-brown">
                    ¡Ups! No tienes galletas favoritas <span class="animate__animated animate__tada">🍪</span>
                </h3>
                <p class="text-muted fs-5">Explora nuestra tienda y guarda tus favoritas aquí.</p>
                <a href="{{ route('products.shop') }}"
                    class="btn btn-gradient btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold">
                    <i class="fas fa-store"></i> Explorar Tienda
                </a>
            </div>
        @else
            <!-- 📌 Lista de productos favoritos -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-4">
                @foreach ($favorites as $favorite)
                    <div class="col">
                        <div class="card product-card h-100 shadow-sm border-0 bg-light rounded-4">
                            <!-- 📸 Imagen del producto -->
                            <div class="ratio ratio-1x1 overflow-hidden">
                                <img src="{{ asset('storage/' . $favorite->product->image) }}"
                                    class="card-img-top img-fluid rounded-top-4 product-image"
                                    alt="{{ $favorite->product->nombre }}" loading="lazy">
                            </div>

                            <!-- 📌 Contenido -->
                            <div class="card-body d-flex flex-column text-center">
                                <!-- Título y botón de favorito alineados -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title fs-5 fw-bold text-brown m-0">{{ $favorite->product->nombre }}</h5>
                                    <button class="btn-favorite border-0 bg-transparent fs-4 transition"
                                        data-product-id="{{ $favorite->product->id }}" data-favorited="true">
                                        ❤️
                                    </button>
                                </div>

                                <p class="card-text small text-muted">{{ Str::limit($favorite->product->description, 80) }}
                                </p>

                                <span class="price-badge">
                                    <strong>{{ number_format($favorite->product->precio, 2) }} €</strong>
                                </span>

                                <!-- 🟢 Botones Mejorados -->
                                <div class="mt-auto d-flex justify-content-center gap-2">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        document.querySelectorAll('.btn-favorite').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const isFavorited = this.dataset.favorited === "true";

                if (isFavorited) {
                    // Mostrar alerta de confirmación
                    if (!confirm("¿Seguro que quieres eliminar este producto de tus favoritos?")) {
                        return;
                    }
                }

                fetch(`/favorites/toggle/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Content-Type': 'application/json'
                        }
                    }).then(response => response.json())
                    .then(data => {
                        this.style.transition = "transform 0.2s ease-in-out, opacity 0.2s ease-in-out";
                        this.style.opacity = "0";

                        setTimeout(() => {
                            if (isFavorited) {
                                // Eliminar producto de la lista de favoritos
                                this.closest('.col').style.opacity = "0";
                                setTimeout(() => {
                                    this.closest('.col').remove();
                                }, 300);
                            }
                        }, 200);
                    }).catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
