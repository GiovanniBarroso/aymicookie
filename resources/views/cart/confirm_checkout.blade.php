@extends('layouts.app')

@section('title', 'Confirmar Compra')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h1 class="mb-4 text-primary text-center fw-bold">✅ Confirmar Compra</h1>

            <h5>📍 Dirección de Envío</h5>
            <p>{{ $selected_address->direccion }}</p>

            <h5>🛒 Resumen del Pedido</h5>
            <ul>
                @foreach ($cart as $id => $item)
                    <li>{{ $item['nombre'] }} x {{ $item['cantidad'] }} -
                        {{ number_format($item['precio'] * $item['cantidad'], 2) }}€</li>
                @endforeach
            </ul>
            <p class="fw-bold fs-4">Total: <span class="text-success">{{ number_format($total, 2) }}€</span></p>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">Pagar con PayPal</button>
            </form>
        </div>
    </div>
@endsection
