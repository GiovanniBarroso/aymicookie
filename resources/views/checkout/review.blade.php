@extends('layouts.app')

@section('title', 'Factura del Pedido')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h1 class="mb-4 text-primary text-center fw-bold">
                📜 Factura del Pedido
            </h1>

            <!-- Información de la Empresa -->
            <div class="mb-4 p-3 bg-light rounded">
                <h5 class="fw-bold text-dark">🏢 Información de la Empresa</h5>
                <p class="m-0"><strong>Nombre:</strong> Ay Mi Cookie S.L.</p>
                <p class="m-0"><strong>Dirección:</strong> Calle José León, 123, Sevilla, España</p>
                <p class="m-0"><strong>Teléfono:</strong> +34 912 345 678</p>
                <p class="m-0"><strong>Email:</strong> info@aymicookie.com</p>
                <p class="m-0"><strong>Fecha de Factura:</strong> {{ now()->format('d/m/Y H:i') }}</p>
            </div>

            <!-- Información del Cliente -->
            <div class="mb-4 p-3 bg-light rounded">
                <h5 class="fw-bold text-dark">🧑‍💼 Información del Cliente</h5>
                <p class="m-0"><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                <p class="m-0"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Dirección:</strong> {{ $selected_address->calle }}, {{ $selected_address->ciudad }},
                    {{ $selected_address->codigo_postal }}</p>

            </div>

            <!-- Detalles del Pedido -->
            <div class="mb-4">
                <h5 class="fw-bold text-dark">📦 Detalles del Pedido</h5>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario (sin IVA)</th>
                            <th>Total (sin IVA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                            <tr class="text-center">
                                <td class="text-start">{{ $item['nombre'] }}</td>
                                <td>{{ $item['cantidad'] }}</td>
                                <td>{{ number_format($item['precio'] / 1.21, 2) }}€</td> <!-- Precio sin IVA -->
                                <td>{{ number_format(($item['precio'] / 1.21) * $item['cantidad'], 2) }}€</td>
                                <!-- Total sin IVA -->
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <!-- Método de Pago -->
            <div class="mb-4 p-3 bg-light rounded">
                <h5 class="fw-bold text-dark">💳 Método de Pago</h5>
                <p class="m-0"><strong>Método:</strong> PayPal</p>
                <p class="m-0"><strong>Banco:</strong> Banco Santander</p>
                <p class="m-0"><strong>Titular:</strong> Ay Mi Cookie S.L.</p>
                <p class="m-0"><strong>IBAN:</strong> ES52 0410 3525 5519 2040</p>
            </div>

            @php
                $subtotal = 0;
                foreach ($cart as $item) {
                    $precio_sin_iva = $item['precio'] / 1.21; // Calculamos el precio sin IVA
                    $subtotal += $precio_sin_iva * $item['cantidad']; // Multiplicamos por la cantidad
                }
                $iva_total = $subtotal * 0.21; // Calculamos el IVA (21%)
                $total_final = $subtotal + $iva_total; // Total con IVA
            @endphp

            <div class="d-flex justify-content-end">
                <table class="table w-50">
                    <tbody>
                        <tr>
                            <td class="fw-bold text-end">Subtotal (sin IVA):</td>
                            <td class="text-end">{{ number_format($subtotal, 2) }}€</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-end">IVA (21%):</td>
                            <td class="text-end">{{ number_format($iva_total, 2) }}€</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-end fs-4">Total (con IVA):</td>
                            <td class="text-end fs-4 text-success">{{ number_format($total_final, 2) }}€</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Botón de Pago -->
            <div class="text-center mt-4">
                <form action="{{ route('checkout.pay') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success px-4 py-2 rounded-pill shadow-lg fw-bold">
                        <i class="fab fa-paypal"></i> Pagar con PayPal
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
