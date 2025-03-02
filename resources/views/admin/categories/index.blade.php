@extends('layouts.app')

@section('title', 'Categorías - Panel de Administración')

@section('content')

<div class="container">
    <div class="card my-5 rounded-4 shadow">
        <!-- Header de la tabla -->
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white rounded-top-4">
            <h1 class="fw-bold m-0">{{ __('Categories') }}</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-warning fw-bold">
                <i class="fas fa-plus"></i> Agregar Categoría
            </a>
        </div>

        <div class="card-body p-0 overflow-x-auto">
            @if ($categories->count() > 0)
                <table class="table table-hover table-borderless m-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-3">ID</th>
                            <th class="px-3">Nombre</th>
                            <th class="px-3">Descripción</th>
                            <th class="px-3">Fecha de Creación</th>
                            <th class="px-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="px-3">{{ $category->id }}</td>
                                <td class="px-3">{{ $category->nombre }}</td>
                                <td class="px-3">{{ $category->description ?? 'No disponible' }}</td>
                                <td class="px-3">{{ $category->created_at ? $category->created_at->format('d/m/Y') : 'No disponible' }}</td>

                                <!-- Botones de Acción -->
                                <td class="px-3 text-center">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center p-4">No hay categorías registradas.</p>
            @endif
        </div>

        <div class="card-footer text-body-secondary text-center">
            Mostrando {{ $categories->count() }} categorías
        </div>
    </div>
</div>

@endsection
