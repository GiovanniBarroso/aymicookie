@extends('layouts.app')

@section('title', 'Marcas - Panel de Administración')

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

        <!-- BOTÓN VOLVER -->
        <div class="mb-3">
            <a href="{{ route('admin.panel') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver al Panel
            </a>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="card shadow-lg border-0 rounded-4 my-4">

            <!-- HEADER -->
            <div
                class="card-header d-flex justify-content-between align-items-center bg-dark text-white rounded-top-4 py-3 px-4">
                <h1 class="fw-bold fs-4 m-0">🏷️ Marcas</h1>
                <a href="{{ route('brands.create') }}" class="btn btn-warning fw-bold rounded-pill shadow-sm">
                    <i class="fas fa-plus"></i> Agregar Marca
                </a>
            </div>

            <!-- BODY -->
            <div class="card-body p-0 overflow-x-auto">
                @if ($brands->count() > 0)
                    <table class="table table-hover align-middle m-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="px-3">#</th>
                                <th class="px-3">Nombre</th>
                                <th class="px-3">Descripción</th>
                                <th class="px-3">Creación</th>
                                <th class="px-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td class="px-3 fw-bold">#{{ $brand->id }}</td>
                                    <td class="px-3">{{ $brand->nombre }}</td>
                                    <td class="px-3">{{ $brand->descripcion ?? 'No disponible' }}</td>
                                    <td class="px-3">
                                        {{ $brand->created_at ? $brand->created_at->format('d/m/Y') : 'No disponible' }}
                                    </td>
                                    <td class="px-3 text-center">
                                        <a href="{{ route('brands.edit', $brand->id) }}"
                                            class="btn btn-sm btn-warning rounded-pill shadow-sm">
                                            ✏️ Editar
                                        </a>
                                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow-sm"
                                                onclick="return confirm('¿Seguro que deseas eliminar esta marca?')">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-5">
                        <h5 class="text-muted">🚫 No hay marcas registradas.</h5>
                    </div>
                @endif
            </div>

            <!-- FOOTER -->
            <div class="card-footer text-center py-3 text-muted">
                Mostrando <strong>{{ $brands->count() }}</strong> {{ Str::plural('marca', $brands->count()) }}
            </div>
        </div>
    </div>

@endsection
