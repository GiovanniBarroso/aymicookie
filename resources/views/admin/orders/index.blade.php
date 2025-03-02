@extends('layouts.app')

@section('title', 'Mis Compras')

@section('content')

    <div class="container py-5">

        <!-- BOTÓN VOLVER -->
        <div class="mb-3">
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver al Panel
            </a>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="card shadow-lg border-0 rounded-4">

            <!-- HEADER -->
            <div
                class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4 py-3 px-4">
                <h1 class="fw-bold fs-4 m-0">🛒 Mis Compras</h1>
            </div>

            <!-- BODY -->
            <div class="card-body p-0">
                @if ($orders->isEmpty())
                    <div class="text-center py-5">
                        <h5 class="text-muted mb-3">🚫 No has realizado ninguna compra aún.</h5>
                        <p>Explora nuestra tienda y realiza tu primer pedido. ¡Te esperamos! 🍪</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle m-0">
                            <thead class="table-dark">
                                <tr>
                                    <th># Pedido</th>
                                    <th>📅 Fecha</th>
                                    <th class="text-center">🔖 Estado</th>
                                    <th class="text-end">💰 Total</th>
                                    <th class="text-center">⚙️ Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="table-row-hover">
                                        <td class="fw-bold">#{{ $order->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->fecha_pedido)->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
                                            @switch($order->estado)
                                                @case('Pagado')
                                                    <span class="badge bg-success px-3 py-2">✅ Pagado</span>
                                                @break

                                                @case('Pendiente')
                                                    <span class="badge bg-warning text-dark px-3 py-2">⌛ Pendiente</span>
                                                @break

                                                @case('Cancelado')
                                                    <span class="badge bg-danger px-3 py-2">❌ Cancelado</span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary px-3 py-2">🔍 Desconocido</span>
                                            @endswitch
                                        </td>
                                        <td class="text-end fw-bold">{{ number_format($order->total, 2, ',', '.') }} €</td>
                                        <td class="text-center">
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-sm btn-outline-primary rounded-pill shadow-sm d-inline-flex align-items-center gap-1">
                                                📄 Ver Detalles
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINACIÓN -->
                    <!-- PAGINACIÓN MEJORADA -->
                    @if ($orders->hasPages())
                        <div class="py-4">
                            <nav>
                                <ul class="pagination justify-content-center pagination-lg">
                                    {{-- Botón anterior --}}
                                    @if ($orders->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link rounded-pill">⬅️</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link rounded-pill" href="{{ $orders->previousPageUrl() }}"
                                                aria-label="Anterior">
                                                ⬅️
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Páginas --}}
                                    @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                                            <a class="page-link rounded-pill"
                                                href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Botón siguiente --}}
                                    @if ($orders->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link rounded-pill" href="{{ $orders->nextPageUrl() }}"
                                                aria-label="Siguiente">
                                                ➡️
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link rounded-pill">➡️</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif

                @endif
            </div>

            <!-- FOOTER -->
            @if ($orders->total() > 0)
                <div class="card-footer text-center py-3 text-muted">
                    Mostrando <strong>{{ $orders->firstItem() }}</strong> a <strong>{{ $orders->lastItem() }}</strong>
                    de <strong>{{ $orders->total() }}</strong> {{ Str::plural('compra', $orders->total()) }}
                </div>
            @endif

        </div>

    </div>

@endsection
<style>
    .pagination .page-item .page-link {
        border-radius: 50% !important;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 5px;
        font-weight: bold;
        color: #343a40;
        background-color: #fff;
        border: 2px solid #dee2e6;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
        transform: scale(1.1);
    }

    .pagination .page-item .page-link:hover {
        background-color: #ffc107;
        color: #000;
        border-color: #ffc107;
        transform: translateY(-3px);
    }
</style>
