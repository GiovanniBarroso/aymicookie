@extends('layouts.app')
@section('title', 'Actualizar Contraseña')

@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- 🟠 Tarjeta de Actualización de Contraseña -->
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-warning text-dark fw-bold text-center fs-4 rounded-top-4">
                        <i class="fas fa-lock"></i> Actualizar Contraseña
                    </div>

                    <div class="card-body p-4">
                        <!-- ✅ Mensaje de éxito si se actualiza la contraseña -->
                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success text-center animate__animated animate__fadeIn">
                                <i class="fas fa-check-circle"></i> ¡Tu contraseña ha sido actualizada con éxito!
                            </div>
                        @endif

                        <!-- 🔒 Formulario de Cambio de Contraseña -->
                        <form method="POST" action="{{ route('user-password.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- 📌 Contraseña Actual -->
                            <div class="mb-4">
                                <label for="current_password" class="form-label fw-semibold text-brown">
                                    <i class="fas fa-key"></i> Contraseña Actual
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-secondary">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input id="current_password" type="password"
                                        class="form-control custom-input @error('current_password', 'updatePassword') is-invalid @enderror"
                                        name="current_password" required autofocus>
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        data-target="current_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('current_password', 'updatePassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- 📌 Nueva Contraseña -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold text-brown">
                                    <i class="fas fa-lock"></i> Nueva Contraseña
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-secondary">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control custom-input @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password">
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        data-target="password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- 📌 Confirmar Nueva Contraseña -->
                            <div class="mb-4">
                                <label for="password-confirm" class="form-label fw-semibold text-brown">
                                    <i class="fas fa-lock"></i> Confirmar Nueva Contraseña
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-secondary">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input id="password-confirm" type="password" class="form-control custom-input"
                                        name="password_confirmation" required autocomplete="new-password">
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        data-target="password-confirm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- 🟡 Botón de Actualizar -->
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-warning text-dark fw-bold px-4 py-2 rounded-pill shadow-sm btn-update">
                                    <i class="fas fa-save"></i> Actualizar Contraseña
                                </button>
                            </div>
                        </form>
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

    <!-- 🟢 Script para Mostrar/Ocultar Contraseña -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = document.getElementById(this.dataset.target);
                if (input.type === "password") {
                    input.type = "text";
                    this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    input.type = "password";
                    this.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    </script>
@endsection
