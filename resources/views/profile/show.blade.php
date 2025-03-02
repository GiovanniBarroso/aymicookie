@extends('layouts.app')

@section('title', 'Detalles del Pedido')

@section('content')

    <div class="container py-5">

        <!-- BOTÓN VOLVER -->
        <div class="mb-3">
            <a href="{{ route('orders.my') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver a Mis Pedidos
            </a>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="card shadow-lg border-0 rounded-4">

            <!-- HEADER -->
            <div
                class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4 py-3 px-4">
                <h1 class="fw-bold fs-4 m-0">📄 Detalles del Pedido #{{ $order->id }}</h1>
                <span class="badge fs-6 px-3 py-2 bg-{{ $order->estado == 'Pagado' ? 'success' : 'warning text-dark' }}">
                    {{ $order->estado }}
                </span>
            </div>

            <!-- BODY -->
            <div class="card-body p-4">

                <!-- INFORMACIÓN GENERAL -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <h5 class="fw-bold">📅 Fecha del Pedido</h5>
                        <p class="text-muted m-0">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div class="col-md-12">
                        <h5 class="fw-bold">📍 Dirección de Envío</h5>
                        <p class="text-muted m-0">{{ $order->address->direccion ?? 'No especificada' }}</p>
                    </div>
                </div>

                <!-- PRODUCTOS DEL PEDIDO -->
                <h5 class="fw-bold mb-3">🛒 Productos del Pedido</h5>

                @if ($order->products->isEmpty())
                    <div class="alert alert-info text-center rounded-pill py-3 shadow-sm">
                        🚫 No hay productos en este pedido.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>🖼️ Imagen</th>
                                    <th>📄 Nombre</th>
                                    <th>💰 Precio</th>
                                    <th>🔢 Cantidad</th>
                                    <th>💵 Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen"
                                                    class="img-thumbnail rounded-3" width="80">
                                            @else
                                                <span class="text-muted fst-italic">Sin imagen</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->nombre }}</td>
                                        <td>{{ number_format($product->pivot->precio, 2) }} €</td>
                                        <td>{{ $product->pivot->cantidad }}</td>
                                        <td>
                                            {{ number_format($product->pivot->precio * $product->pivot->cantidad, 2) }} €
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>

            <!-- FOOTER -->
            <div class="card-footer text-center py-3 text-muted">
                Pedido realizado el <strong>{{ $order->created_at->format('d/m/Y') }}</strong> |
                Total: <strong>{{ number_format($order->total, 2) }} €</strong>
            </div>

        </div>

    </div>

@endsection
