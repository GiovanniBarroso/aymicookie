@extends('layouts.app')
@section('title', 'Editar Perfil')

@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- 🟠 Tarjeta de Edición de Perfil -->
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-warning text-dark fw-bold text-center fs-4 rounded-top-4">
                        <i class="fas fa-user-edit"></i> Editar Perfil
                    </div>

                    <div class="card-body p-4">
                        <!-- 🟢 Mensaje de éxito -->
                        @if (session('status') === 'profile-information-updated')
                            <div class="alert alert-success text-center animate__animated animate__fadeIn">
                                <i class="fas fa-check-circle"></i> ¡Tu perfil ha sido actualizado con éxito!
                            </div>
                        @endif

                        <!-- 📝 Formulario de Edición -->
                        <form method="POST" action="{{ route('user-profile-information.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- 📌 Nombre -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-brown">
                                    <i class="fas fa-user"></i> Nombre Completo
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-secondary">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input id="name" type="text"
                                        class="form-control custom-input @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', auth()->user()->name) }}" required autocomplete="name"
                                        autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- 📌 Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-brown">
                                    <i class="fas fa-envelope"></i> Correo Electrónico
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-secondary">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control custom-input @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', auth()->user()->email) }}" required
                                        autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- 🟡 Botón de Actualizar -->
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-warning text-dark fw-bold px-4 py-2 rounded-pill shadow-sm btn-update">
                                    <i class="fas fa-save"></i> Actualizar Perfil
                                </button>
                            </div>
                        </form>

                        <!-- ⚙️ Gestión de Cuenta -->
                        <hr class="my-5">
                        <h2 class="text-center fw-bold text-brown mb-4">
                            ⚙️ Gestión de tu Cuenta
                        </h2>

                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <!-- Direcciones -->
                            <a href="{{ route('addresses.index') }}"
                                class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm fw-bold">
                                <i class="fas fa-map-marker-alt"></i> Mis Direcciones
                            </a>

                            <!-- Pedidos -->
                            <a href="{{ route('orders.my') }}"
                                class="btn btn-outline-success px-4 py-2 rounded-pill shadow-sm fw-bold">
                                <i class="fas fa-box"></i> Mis Pedidos
                            </a>

                            <!-- Facturas -->
                            <a href="{{ route('factura.pdf') }}"
                                class="btn btn-outline-warning px-4 py-2 rounded-pill shadow-sm fw-bold">
                                <i class="fas fa-file-invoice"></i> Mis Facturas
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🌟 Estilos Personalizados -->
    <style>
        .custom-input {
            background: #fff;
            border: 2px solid #ced4da;
            border-radius: 10px;
            padding: 12px;
            transition: all 0.3s ease-in-out;
        }

        .custom-input:focus {
            border-color: #ff9800;
            box-shadow: 0 0 10px rgba(255, 152, 0, 0.5);
            outline: none;
        }

        .btn-update {
            transition: all 0.3s ease-in-out;
        }

        .btn-update:hover {
            background: linear-gradient(135deg, #ff9800, #ff5722);
            color: white;
            transform: scale(1.05);
        }
    </style>
@endsection
