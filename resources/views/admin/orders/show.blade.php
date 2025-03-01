@extends('layouts.app')

@section('title', 'Detalles del Pedido')

@section('content')

    <div class="container">

        <div class="card my-5 rounded-4">
            <div class="card-header pt-3 ps-4 bg-dark rounded-top-4">
                <h1 class="fw-bold text-white">Detalles del Pedido #{{ $order->id }}</h1>
            </div>
            <div class="card-body">
                <h5><strong>Fecha de Pedido:</strong> {{ \Carbon\Carbon::parse($order->fecha_pedido)->format('d/m/Y H:i') }}
                </h5>
                <h5><strong>Estado:</strong> {{ $order->estado }}</h5>
                <h5><strong>Total:</strong> {{ number_format($order->total, 2, ',', '.') }} €</h5>

                <h5><strong>Dirección de Envío:</strong></h5>
                <p>{{ $order->address->calle }}, {{ $order->address->ciudad }}, {{ $order->address->provincia }},
                    {{ $order->address->codigo_postal }}</p>
                <p><strong>País:</strong> {{ $order->address->pais }}</p>

                <h5><strong>Productos:</strong></h5>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            <tr>
                                <td>{{ $product->nombre }}</td>
                                <td>{{ $product->pivot->cantidad }}</td>
                                <td>{{ number_format($product->pivot->precio, 2, ',', '.') }} €</td>
                                <td>{{ number_format($product->pivot->cantidad * $product->pivot->precio, 2, ',', '.') }} €
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-body-secondary">
                {{-- Aquí puedes agregar la paginación si es necesario --}}
            </div>
        </div>

    </div>

@endsection
