@extends('layouts.app')

@section('title', 'Compra Exitosa')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4 text-center">
            <h1 class="mb-4 text-success fw-bold">🎉 ¡Gracias por tu compra!</h1>

            @if (session('success'))
                <p class="fs-5 text-success">{{ session('success') }} 🎂</p>
            @else
                <p class="fs-5 text-muted">Tu pedido ha sido procesado correctamente.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('products.shop') }}" class="btn btn-primary btn-lg">Seguir Comprando</a>
                <a href="{{ route('orders') }}" class="btn btn-outline-secondary btn-lg">Ver Mis Pedidos</a>
            </div>
        </div>
    </div>
@endsection
