@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">📍 Mis Direcciones</h2>

        <div class="text-center mb-4">
            <a href="{{ route('addresses.create') }}" class="btn btn-success px-4 py-2 fw-bold">
                ➕ Añadir Nueva Dirección
            </a>
        </div>

        <div class="row justify-content-center">
            @forelse ($addresses as $address)
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 rounded-4 mb-3">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary">{{ $address->calle }}</h5>
                            <p class="card-text">
                                📍 {{ $address->ciudad }}, {{ $address->provincia }} <br>
                                🏷️ {{ $address->codigo_postal }}, {{ $address->pais }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('addresses.edit', $address) }}" class="btn btn-outline-primary btn-sm">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('addresses.destroy', $address) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('¿Seguro que quieres eliminar esta dirección?')">
                                        ❌ Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center fw-bold text-muted">No tienes direcciones guardadas.</p>
            @endforelse
        </div>
    </div>
@endsection
