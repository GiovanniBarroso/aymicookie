@extends('layouts.app')

@section('title', 'Categorías - Panel de Administración')

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
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4 py-3 px-4">
            <h1 class="fw-bold fs-4 m-0">📂 Categorías</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-warning fw-bold rounded-pill shadow-sm">
                ➕ Nueva Categoría
            </a>
        </div>

        <!-- BODY -->
        <div class="card-body p-0">
            @if ($categories->count() > 0)
                <div class="table-responsive">
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
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="px-3">{{ $category->id }}</td>
                                    <td class="px-3">{{ $category->nombre }}</td>
                                    <td class="px-3">{{ $category->description ?? '— Sin descripción —' }}</td>
                                    <td class="px-3">{{ $category->created_at?->format('d/m/Y') ?? '—' }}</td>
                                    <td class="px-3 text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-outline-warning rounded-pill shadow-sm">
                                                ✏️ Editar
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill shadow-sm"
                                                    onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                                    🗑️ Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <h5 class="text-muted mb-3">🚫 No hay categorías registradas.</h5>
                    <p>¡Comienza creando una nueva categoría para organizar mejor tus productos!</p>
                </div>
            @endif
        </div>

        <!-- FOOTER -->
        <div class="card-footer text-center py-3 text-muted">
            Mostrando <strong>{{ $categories->count() }}</strong> {{ Str::plural('categoría', $categories->count()) }}
        </div>

    </div>

</div>

@endsection
