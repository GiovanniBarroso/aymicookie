<nav class="navbar navbar-expand-md navbar-dark border-bottom border-info-subtle shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                            <a class="dropdown-item" href="{{ route('profile.password') }}">Update Password</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
                            </form>
                        </div>
                    </li>
                @endguest

                <!-- Carrito de Compras -->
                <li class="nav-item">
                    <a href="#" class="nav-link" id="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-count" class="badge bg-danger" style="display: none;">0</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>



<!-- Modal para previsualizar el carrito -->
<div class="modal fade" id="cartPreviewModal" tabindex="-1" aria-labelledby="cartPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartPreviewModalLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cart-preview-body">
                <p>Tu carrito está vacío.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('cart.index') }}" class="btn btn-primary">Ver Carrito Completo</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




<script>
    document.getElementById('cart-icon').addEventListener('click', function() {
        // Abrir el modal de previsualización
        var myModal = new bootstrap.Modal(document.getElementById('cartPreviewModal'));
        myModal.show();

        fetch("{{ route('cart.preview') }}")
            .then(response => response.json())
            .then(data => {
                console.log(data); // Verificar la respuesta en la consola

                let cartPreviewBody = document.getElementById('cart-preview-body');
                let cartCount = document.getElementById('cart-count');

                // Verifica si 'cart' es un objeto y no un array
                if (Object.keys(data.cart).length > 0) {
                    // Convertir el objeto cart en un array de productos
                    let cartItems = Object.keys(data.cart).map(productId => {
                        let item = data.cart[productId];
                        return `<p>${item.nombre} x ${item.cantidad} - ${item.precio}€</p>`;
                    }).join('');
                    cartPreviewBody.innerHTML = cartItems;
                    cartCount.innerText = Object.keys(data.cart).length;
                    cartCount.style.display = 'inline-block';
                } else {
                    cartPreviewBody.innerHTML = '<p>Tu carrito está vacío.</p>';
                    cartCount.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error al obtener los productos del carrito:', error);
                document.getElementById('cart-preview-body').innerHTML =
                    '<p>No se pudo cargar el carrito.</p>';
            });

    });
</script>
