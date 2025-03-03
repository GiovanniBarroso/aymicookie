@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')

    <div class="container py-5 mb-5">

        <!-- TÍTULO PRINCIPAL -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-dark">🛠️ Panel de Administración</h1>
            <p class="text-muted">Gestiona toda la tienda desde aquí de manera rápida y sencilla.</p>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="card shadow-lg border-0 rounded-4 p-4">

            <div class="row g-4">

                <!-- Usuarios -->
                <div class="col-md-4">
                    <a href="{{ route('users.index') }}"
                        class="btn btn-outline-primary w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                        <i class="fa-solid fa-user fa-2x mb-2"></i>
                        <span class="fw-bold fs-5">Usuarios</span>
                    </a>
                </div>

                <!-- Pedidos -->
                <div class="col-md-4">
                    <a href="{{ route('orders.index') }}"
                        class="btn btn-outline-secondary w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                        <i class="fa-solid fa-truck fa-2x mb-2"></i>
                        <span class="fw-bold fs-5">Pedidos</span>
                    </a>
                </div>

                <!-- Productos -->
                <div class="col-md-4">
                    <a href="{{ route('products.index') }}"
                        class="btn btn-outline-success w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                        <i class="fa-solid fa-box fa-2x mb-2"></i>
                        <span class="fw-bold fs-5">Productos</span>
                    </a>
                </div>

                <!-- Categorías -->
                <div class="col-md-4">
                    <a href="{{ route('categories.index') }}"
                        class="btn btn-outline-warning w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                        <i class="fa-solid fa-list fa-2x mb-2"></i>
                        <span class="fw-bold fs-5">Categorías</span>
                    </a>
                </div>

                <!-- Marcas -->
                <div class="col-md-4">
                    <a href="{{ route('brands.index') }}"
                        class="btn btn-outline-dark w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                        <i class="fa-solid fa-shop fa-2x mb-2"></i>
                        <span class="fw-bold fs-5">Marcas</span>
                    </a>
                </div>

                <!-- Descuentos -->
                <div class="col-md-4">
                    <a href="{{ route('discounts.index') }}"
                        class="btn btn-outline-danger w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                        <i class="fa-solid fa-tags fa-2x mb-2"></i>
                        <span class="fw-bold fs-5">Descuentos</span>
                    </a>
                </div>

            </div>

        </div>

    </div>

@endsection
