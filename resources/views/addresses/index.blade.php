@extends('layouts.app')

@section('title', 'Mis Direcciones')

@section('content')

    <div class="container py-5">

        <!-- FILA DE BOTÓN Y CABECERA -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver al Inicio
            </a>
            <h1 class="fw-bold text-brown text-center flex-grow-1 m-0 display-5">
                📍 Mis Direcciones
            </h1>
            <!-- Espaciador para mantener centrado el título -->
            <div style="width: 190px;"></div>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="card shadow-lg border-0 rounded-4">

            <!-- HEADER -->
            <div
                class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4 py-3 px-4">
                <h2 class="fw-bold fs-4 m-0">🏠 Direcciones Guardadas</h2>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted fs-6">
                        Total: <strong>{{ $addresses->count() }}</strong>
                        {{ Str::plural('dirección', $addresses->count()) }}
                    </span>
                    <a href="{{ route('addresses.create') }}" class="btn btn-success rounded-pill fw-bold shadow-sm">
                        ➕ Añadir Nueva
                    </a>
                    <a href="{{ route('cart.index') }}" class="btn btn-warning rounded-pill fw-bold shadow-sm">
                        👛Volver al carrito
                    </a>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body p-4">
                @if ($addresses->isEmpty())
                    <div class="alert alert-info text-center rounded-pill py-3 shadow-sm">
                        🚫 No tienes direcciones guardadas.
                    </div>
                @else
                    <div class="row justify-content-center">
                        @foreach ($addresses as $address)
                            <div class="col-md-6 col-lg-5">
                                <div class="card shadow-sm border-0 rounded-4 mb-4 h-100">
                                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title fw-bold text-primary mb-3">
                                                🏡 {{ $address->calle }}
                                            </h5>
                                            <p class="card-text text-muted mb-4">
                                                📍 {{ $address->ciudad }}, {{ $address->provincia }}<br>
                                                🏷️ {{ $address->codigo_postal }}, {{ $address->pais }}
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-between gap-2">
                                            <a href="{{ route('addresses.edit', $address) }}"
                                                class="btn btn-outline-primary rounded-pill btn-sm d-inline-flex align-items-center gap-1 shadow-sm">
                                                ✏️ Editar
                                            </a>
                                            <form action="{{ route('addresses.destroy', $address) }}" method="POST"
                                                onsubmit="return confirm('¿Seguro que quieres eliminar esta dirección?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger rounded-pill btn-sm d-inline-flex align-items-center gap-1 shadow-sm">
                                                    ❌ Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- FOOTER -->
            <div class="card-footer text-center py-3 text-muted">
                Mostrando <strong>{{ $addresses->count() }}</strong> {{ Str::plural('dirección', $addresses->count()) }}
                registradas.
            </div>

        </div>

    </div>

@endsection
