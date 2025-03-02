@extends('layouts.app')

@section('title', 'Mis Pedidos')

@section('content')

    <div class="container py-5">

        <!-- FILA DE BOTÓN Y CABECERA -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver al Inicio
            </a>
            <h1 class="fw-bold text-brown text-center flex-grow-1 m-0 display-5">
                🧾 Mis Pedidos
            </h1>
            <!-- Espaciador para mantener alineación -->
            <div style="width: 155px;"></div>
        </div>

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center rounded-pill py-3 shadow-sm">
                🚫 No tienes pedidos registrados.
            </div>
        @else
            <div class="card shadow-lg border-0 rounded-4">

                <!-- HEADER -->
                <div
                    class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4 py-3 px-4">
                    <h2 class="fw-bold fs-4 m-0">📄 Historial de Pedidos</h2>
                    <span class="text-muted fs-6">
                        Total: <strong>{{ $orders->count() }}</strong> {{ Str::plural('pedido', $orders->count()) }}
                    </span>
                </div>

                <!-- BODY -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center m-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>📅 Fecha</th>
                                    <th>💰 Total</th>
                                    <th>📦 Estado</th>
                                    <th class="text-center">⚙️ Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="fw-bold">#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td class="fw-bold text-success">{{ number_format($order->total, 2) }} €</td>
                                        <td>
                                            <span
                                                class="badge rounded-pill px-3 py-2 fs-6
                                                {{ $order->estado == 'Pagado' ? 'bg-success' : ($order->estado == 'Pendiente' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                                {{ $order->estado }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('my-orders.show', $order->id) }}"
                                                class="btn btn-sm btn-outline-primary rounded-pill shadow-sm d-inline-flex align-items-center gap-1">
                                                🔍 Ver Detalles
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="card-footer text-center py-3 text-muted">
                    Mostrando <strong>{{ $orders->count() }}</strong> {{ Str::plural('pedido', $orders->count()) }}
                    registrados.
                </div>

            </div>
        @endif

    </div>

@endsection
