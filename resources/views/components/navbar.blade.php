<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <!-- Botón de idioma -->
        <div class="d-flex align-items-center">
            <a href="#" class="text-dark me-3">ES</a>
        </div>

        <!-- Menú de navegación a la izquierda -->
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="#">Conócenos</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Productos</a></li>
        </ul>

        <!-- Logo centrado -->
        <a class="navbar-brand mx-auto" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Ay Mi Cookie" height="50">
        </a>

        <!-- Menú de navegación a la derecha -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">Nuestra Casa</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contáctanos</a></li>
        </ul>

        <!-- Ícono del carrito de compras -->
        <div class="cart-icon ms-3 position-relative">
            <a href="{{ route('cart.index') }}" class="text-dark">
                <i class="fas fa-shopping-cart fa-lg"></i>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
        </div>
    </div>
</nav>
