@extends('layouts.app')

@section('title', 'Detalles del Pedido')

@section('content')

    <div class="container py-5">

        <!-- BOTÓN VOLVER -->
        <div class="mb-3">
            <a href="{{ route('orders') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver a Mis Compras
            </a>
        </div>

        <!-- CARD DETALLES DEL PEDIDO -->
        <div class="card shadow-lg border-0 rounded-4">

            <!-- HEADER -->
            <div class="card-header bg-dark text-white rounded-top-4 py-3 px-4">
                <h1 class="fw-bold fs-4 m-0">📦 Detalles del Pedido #{{ $order->id }}</h1>
            </div>

            <!-- BODY -->
            <div class="card-body p-4">

                <!-- INFORMACIÓN DEL PEDIDO -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <h6 class="fw-bold">📅 Fecha de Pedido</h6>
                        <p>{{ \Carbon\Carbon::parse($order->fecha_pedido)->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold">📝 Estado</h6>
                        @switch($order->estado)
                            @case('Pagado')
                                <span class="badge bg-success">✅ Pagado</span>
                            @break

                            @case('Pendiente')
                                <span class="badge bg-warning text-dark">⌛ Pendiente</span>
                            @break

                            @case('Cancelado')
                                <span class="badge bg-danger">❌ Cancelado</span>
                            @break

                            @default
                                <span class="badge bg-secondary">🔍 Desconocido</span>
                        @endswitch
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold">💰 Total</h6>
                        <p class="fw-bold">{{ number_format($order->total, 2, ',', '.') }} €</p>
                    </div>
                </div>

                <!-- DIRECCIÓN DE ENVÍO -->
                <div class="mb-4">
                    <h6 class="fw-bold">📍 Dirección de Envío</h6>
                    <p>{{ $order->address->calle }}, {{ $order->address->ciudad }}, {{ $order->address->provincia }},
                        {{ $order->address->codigo_postal }}</p>
                    <p><strong>País:</strong> {{ $order->address->pais }}</p>
                </div>

                <!-- PRODUCTOS -->
                <div class="table-responsive">
                    <h6 class="fw-bold mb-3">🛒 Productos Comprados</h6>
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unitario</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>{{ $product->nombre }}</td>
                                    <td class="text-center">{{ $product->pivot->cantidad }}</td>
                                    <td class="text-end">{{ number_format($product->pivot->precio, 2, ',', '.') }} €</td>
                                    <td class="text-end">
                                        {{ number_format($product->pivot->cantidad * $product->pivot->precio, 2, ',', '.') }}
                                        €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="card-footer text-center py-3 text-muted">
                Gracias por confiar en <strong>Ay Mi Cookie</strong> 🍪
            </div>

        </div>

    </div>

@endsection
