@extends('layouts.app')

@section('title', 'Mis Compras')

@section('content')

<div class="container">

    <div class="card my-5 rounded-4">
        <div class="card-header pt-3 ps-4 bg-dark rounded-top-4">
            <h1 class="fw-bold text-white">{{ __('Mis Compras') }}</h1>
        </div>
        <div class="card-body p-0 overflow-x-auto">
            @if ($orders->isEmpty())
                <p class="text-center">No has realizado ninguna compra aún.</p>
            @else
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Pedido ID</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                {{-- Convertir explícitamente la fecha usando Carbon --}}
                                <td>{{ \Carbon\Carbon::parse($order->fecha_pedido)->format('d/m/Y H:i') }}</td>
                                <td>{{ $order->estado }}</td>
                                <td>{{ number_format($order->total, 2, ',', '.') }} €</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Ver detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer text-body-secondary">
            {{-- Aquí puedes agregar la paginación si es necesario --}}
            {{-- Ejemplo: {{ $orders->links() }} --}}
        </div>
    </div>

</div>

@endsection
