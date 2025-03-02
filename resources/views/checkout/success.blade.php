@extends('layouts.app')

@section('title', 'Compra Exitosa')

@section('content')
    <div class="container py-5 mb-5 rounded-4" style="background: linear-gradient(135deg, #f0f4ff, #ffffff); min-height: 80vh;">
        <div class="card shadow-lg border-0 rounded-4 p-5 text-center animate__animated animate__fadeIn">
            <h1 class="mb-4 text-success fw-bold display-5">
                🎉 ¡Gracias por tu compra!
            </h1>

            @if (session('success'))
                <p class="fs-4 text-success">
                    <i class="bi bi-check-circle-fill fs-3"></i> {{ session('success') }} 🎂
                </p>
            @else
                <p class="fs-4 text-muted">
                    <i class="bi bi-box-seam fs-3"></i> Tu pedido ha sido procesado correctamente.
                </p>
            @endif

            <div class="alert alert-info mt-4 shadow-sm rounded-pill fs-5">
                📧 Te hemos enviado un correo con el resumen de tu pedido.
            </div>

            <hr class="my-5">

            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('products.shop') }}" class="btn btn-primary btn-lg px-4 py-2 shadow-sm">
                    🛒 Seguir Comprando
                </a>
                <a href="{{ route('orders') }}" class="btn btn-outline-secondary btn-lg px-4 py-2 shadow-sm">
                    📦 Ver Mis Pedidos
                </a>
            </div>

            @if (isset($order) && $order->estado === 'Pagado')
                <div class="mt-5">
                    <a href="{{ route('factura.pdf', ['pedido' => $order->id]) }}"
                        class="btn btn-warning btn-lg px-4 py-2 shadow-lg fw-bold">
                        📄 Descargar Factura en PDF
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
