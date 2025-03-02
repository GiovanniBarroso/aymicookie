@extends('layouts.app')

@section('title', 'Gestión de Descuentos')

@section('content')
    <div class="container py-5">

        <!-- ALERTA DE ÉXITO -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm text-center fw-bold mb-4"
                role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <!-- CABECERA CON BOTONES -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <!-- Botón Volver -->
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-secondary rounded-pill shadow-sm fw-bold">
                🔙 Volver al Panel
            </a>

            <div class="text-center flex-grow-1">
                <h1 class="fw-bold text-brown display-5 m-0">📢 Gestión de Descuentos</h1>
                <p class="text-muted fs-5 mb-0">Administra descuentos para productos, categorías o globales de manera
                    eficiente.</p>
            </div>

            <!-- Botón Añadir -->
            <a href="{{ route('discounts.create') }}" class="btn btn-success btn-lg shadow-sm rounded-pill">
                ➕ Añadir Descuento
            </a>
        </div>


        <!-- TABLA DE DESCUENTOS -->
        <div class="card shadow-lg border-0 rounded-4 p-4">
            @if ($discounts->isEmpty())
                <div class="text-center py-5">
                    <h5 class="text-muted">🚫 No hay descuentos registrados.</h5>
                    <p>¡Crea tu primer descuento y potencia tus ventas!</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-striped table-bordered m-0 shadow-sm rounded-4">
                        <thead class="table-dark">
                            <tr class="text-center align-middle">
                                <th>#</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Producto</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr class="text-center">
                                    <td>#{{ $discount->id }}</td>
                                    <td>
                                        <span class="badge bg-primary fs-6 px-3 py-2">
                                            {{ $discount->codigo }}
                                        </span>
                                    </td>
                                    <td class="text-truncate" style="max-width: 180px;">
                                        {{ $discount->description ?? 'Sin descripción' }}
                                    </td>
                                    <td>
                                        @switch($discount->tipo)
                                            @case('producto')
                                                <span class="badge bg-info px-3 py-2">Producto</span>
                                            @break

                                            @case('categoria')
                                                <span class="badge bg-warning text-dark px-3 py-2">Categoría</span>
                                            @break

                                            @default
                                                <span class="badge bg-success px-3 py-2">Global</span>
                                        @endswitch
                                    </td>
                                    <td class="fw-bold text-danger">-{{ $discount->valor }}%</td>
                                    <td>{{ $discount->product->nombre ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($discount->fecha_inicio)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($discount->fecha_fin)->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('discounts.toggle', $discount->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm rounded-pill shadow-sm px-3 {{ $discount->activo ? 'btn-success' : 'btn-secondary' }}">
                                                {{ $discount->activo ? 'Activo' : 'Inactivo' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('discounts.edit', $discount->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill shadow-sm px-3">
                                                ✏️ Editar
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger rounded-pill shadow-sm px-3"
                                                data-bs-toggle="modal" data-bs-target="#deleteDiscount{{ $discount->id }}">
                                                🗑️
                                            </button>
                                        </div>

                                        <!-- Modal Confirmación -->
                                        <div class="modal fade" id="deleteDiscount{{ $discount->id }}" tabindex="-1"
                                            aria-labelledby="deleteDiscountLabel{{ $discount->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Seguro que deseas eliminar el descuento
                                                        <strong>{{ $discount->codigo }}</strong>? Esta acción no se puede
                                                        deshacer.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('discounts.destroy', $discount->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                🗑️ Eliminar
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
