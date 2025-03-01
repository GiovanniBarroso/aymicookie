@extends('layouts.app')

@section('title', 'Revisión del Pedido')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h1 class="mb-4 text-primary text-center fw-bold">📦 Revisión del Pedido</h1>

            <p><strong>Total:</strong> {{ number_format($total, 2) }}€</p>
            <p><strong>Dirección de Envío:</strong> {{ $address }}</p>

            <form action="{{ route('checkout.pay') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Pagar con PayPal</button>
            </form>

        </div>
    </div>
@endsection
