<nav class="navbar navbar-expand-md navbar-dark border-bottom border-info-subtle shadow-sm position-relative" style="background-color: #fabc3f;">
    <div class="container d-flex flex-column align-items-center">
        
        <!-- Contenedor del navbar centrado -->
        <div class="d-flex justify-content-center align-items-center w-100">
            
            <!-- Botones de navegación izquierda -->
            <a class="btn btn-outline-light border-0 me-3 px-3 py-2 fw-bold" role="button" href="/dashboard">Home</a>
            <a class="btn btn-outline-light border-0 px-3 py-2 fw-bold" role="button" href="/shop">Products</a>

            <!-- Logo centrado -->
            <div class="mx-4">
                <a href="{{ url('/dashboard') }}">
                    <img src="images/logo_aymicookie.png" alt="logo" class="img-fluid" style="max-height: 50px;">
                </a>
            </div>

            <!-- Botones de navegación derecha -->
            <a class="btn btn-outline-light border-0 me-3 px-3 py-2 fw-bold" role="button" href="{{ route("about") }}">About us</a>
            <a class="btn btn-outline-light border-0 px-3 py-2 fw-bold" role="button" href="#">Contact us</a>
        </div>

        <!-- Botón hamburguesa para móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="position-absolute end-0 d-flex align-items-center">
        <!-- Contenido del navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item me-3 fw-bold"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li class="nav-item me-3 fw-bold"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown me-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item fw-bold" href="{{ route('profile.edit') }}">Edit Profile</a>
                            <a class="dropdown-item fw-bold" href="{{ route('profile.password') }}">Update Password</a>
                            <a class="dropdown-item fw-bold" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                @endguest

                <!-- Carrito de Compras -->
                <li class="nav-item">
                    <a href="#" class="nav-link fw-bold" id="cart-icon">
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
        var myModal = new bootstrap.Modal(document.getElementById('cartPreviewModal'));
        myModal.show();

        fetch("{{ route('cart.preview') }}")
            .then(response => response.json())
            .then(data => {
                let cartPreviewBody = document.getElementById('cart-preview-body');
                let cartCount = document.getElementById('cart-count');

                if (Object.keys(data.cart).length > 0) {
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
                document.getElementById('cart-preview-body').innerHTML = '<p>No se pudo cargar el carrito.</p>';
            });
    });
</script>
