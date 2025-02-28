@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-brown fw-bold">💖 Mis Favoritos 💖</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
            @foreach ($favorites as $favorite)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 bg-light rounded-4">
                        <!-- Imagen del Producto -->
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('storage/' . $favorite->product->image ?? 'default.jpg') }}"
                                class="card-img-top img-fluid rounded-top-4" alt="{{ $favorite->product->nombre }}"
                                loading="lazy">
                        </div>

                        <!-- Contenido de la Tarjeta -->
                        <div class="card-body d-flex flex-column text-center">
                            <!-- Nombre del Producto y Botón de Favorito alineados -->
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title fs-4 fw-bold text-brown m-0">{{ $favorite->product->nombre }}</h5>
                                <button class="btn-favorite border-0 bg-transparent fs-4 transition"
                                    data-product-id="{{ $favorite->product->id }}" data-favorited="true">
                                    ❤️
                                </button>
                            </div>

                            <p class="card-text small text-muted">{{ Str::limit($favorite->product->description, 50) }}</p>
                            <span class="badge bg-warning text-dark fs-5 py-2 px-3 mb-2">
                                {{ number_format($favorite->product->precio, 2) }} €
                            </span>

                            <div class="mt-auto">
                                <button class="btn btn-warning text-white w-100 add-to-cart rounded-pill shadow-sm"
                                    data-id="{{ $favorite->product->id }}"
                                    aria-label="Agregar {{ $favorite->product->nombre }} al carrito">
                                    <i class="fas fa-cart-plus"></i> Añadir al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
