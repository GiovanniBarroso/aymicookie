@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">✏️ Editar Dirección</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="card-body">
                        <form action="{{ route('addresses.update', $address) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold">🏠 Calle</label>
                                <input type="text" name="calle" class="form-control rounded-3"
                                    value="{{ $address->calle }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">🌆 Ciudad</label>
                                <input type="text" name="ciudad" class="form-control rounded-3"
                                    value="{{ $address->ciudad }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">🗺️ Provincia</label>
                                <input type="text" name="provincia" class="form-control rounded-3"
                                    value="{{ $address->provincia }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">📮 Código Postal</label>
                                <input type="text" name="codigo_postal" class="form-control rounded-3"
                                    value="{{ $address->codigo_postal }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">🌍 País</label>
                                <input type="text" name="pais" class="form-control rounded-3"
                                    value="{{ $address->pais }}" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('addresses.index') }}"
                                    class="btn btn-outline-secondary px-4 py-2 fw-bold">
                                    ⬅️ Volver Atrás
                                </a>
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                                    💾 Actualizar Dirección
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
