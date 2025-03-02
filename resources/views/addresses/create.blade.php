@extends('layouts.app')

@section('title', 'Añadir Nueva Dirección')

@section('content')

    <div class="container py-5">

        <!-- FILA DE BOTÓN Y CABECERA -->
        <h1 class="fw-bold text-brown text-center flex-grow-1 m-0 display-5 mb-5">
            📍 Añadir Nueva Dirección
        </h1>
        <!-- Espaciador para mantener centrado el título -->
        <div style="width: 190px;"></div>


        <!-- FORMULARIO -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4">

                    <!-- HEADER -->
                    <div class="card-header bg-dark text-white rounded-top-4 py-3 px-4 d-flex align-items-center gap-2">
                        📝 <h2 class="fw-bold fs-4 m-0">Formulario de Dirección</h2>
                    </div>

                    <!-- BODY -->
                    <div class="card-body p-4">
                        <form action="{{ route('addresses.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">🏠 Calle</label>
                                <input type="text" name="calle" class="form-control rounded-3 shadow-sm"
                                    placeholder="Ej. Calle Mayor, 123" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">🌆 Ciudad</label>
                                <input type="text" name="ciudad" class="form-control rounded-3 shadow-sm"
                                    placeholder="Ej. Madrid" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">🗺️ Provincia</label>
                                <input type="text" name="provincia" class="form-control rounded-3 shadow-sm"
                                    placeholder="Ej. Madrid" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">📮 Código Postal</label>
                                <input type="text" name="codigo_postal" class="form-control rounded-3 shadow-sm"
                                    placeholder="Ej. 28001" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">🌍 País</label>
                                <input type="text" name="pais" class="form-control rounded-3 shadow-sm"
                                    placeholder="Ej. España" required>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('addresses.index') }}"
                                    class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold shadow-sm">
                                    ⬅️ Cancelar
                                </a>
                                <button type="submit" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm">
                                    ✅ Guardar Dirección
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
