@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-brown fw-bold">📢 Gestión de Descuentos</h1>

        <!-- Botón para añadir un nuevo descuento -->
        <div class="mb-3 text-end">
            <a href="{{ route('discounts.create') }}" class="btn btn-success">➕ Añadir Descuento</a>
        </div>

        <div class="card shadow-sm border-0 rounded-4 p-4">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Producto</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($discounts as $discount)
                        <tr>
                            <td>{{ $discount->id }}</td>
                            <td><span class="badge bg-primary">{{ $discount->codigo }}</span></td>
                            <td>{{ $discount->description ?? 'Sin descripción' }}</td>
                            <td>
                                @if ($discount->tipo === 'producto')
                                    <span class="badge bg-info">Producto</span>
                                @elseif($discount->tipo === 'categoria')
                                    <span class="badge bg-warning">Categoría</span>
                                @else
                                    <span class="badge bg-success">Global</span>
                                @endif
                            </td>
                            <td class="fw-bold text-danger">-{{ $discount->valor }}%</td>
                            <td>
                                @if ($discount->product)
                                    {{ $discount->product->nombre }}
                                @else
                                    <span class="text-muted">No aplica a un producto específico</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($discount->fecha_inicio)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($discount->fecha_fin)->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('discounts.toggle', $discount->id) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm {{ $discount->activo ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $discount->activo ? 'Activo' : 'Inactivo' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('discounts.edit', $discount->id) }}" class="btn btn-sm btn-primary">✏️
                                    Editar</a>
                                <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteDiscount{{ $discount->id }}">
                                        🗑️ Eliminar
                                    </button>

                                    <!-- Modal de Confirmación -->
                                    <div class="modal fade" id="deleteDiscount{{ $discount->id }}" tabindex="-1"
                                        aria-labelledby="deleteDiscountLabel{{ $discount->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteDiscountLabel{{ $discount->id }}">
                                                        Confirmar Eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar el descuento
                                                    <strong>{{ $discount->codigo }}</strong>? Esta acción no se puede
                                                    deshacer.
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('discounts.destroy', $discount->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">🗑️ Eliminar</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Mostrar mensaje si no hay descuentos -->
            @if ($discounts->isEmpty())
                <div class="text-center mt-3">
                    <p class="text-muted">No hay descuentos creados aún.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
