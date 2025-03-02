@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')

    <div class="container py-5">

        <!-- BOTÓN VOLVER -->
        <div class="mb-3">
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                🔙 Volver a Usuarios
            </a>
        </div>

        <!-- CARD FORMULARIO -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-dark text-white rounded-top-4 py-3 px-4">
                <h1 class="fw-bold fs-4 m-0">✏️ Editar Usuario #{{ $user->id }}</h1>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="name"
                            class="form-control rounded-pill @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control rounded-pill"
                            value="{{ old('apellidos', $user->apellidos) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email"
                            class="form-control rounded-pill @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Rol</label>
                        <select name="roles_id" class="form-select rounded-pill">
                            <option value="1" {{ $user->roles_id == 1 ? 'selected' : '' }}>🛡️ Admin</option>
                            <option value="2" {{ $user->roles_id == 2 ? 'selected' : '' }}>👤 Usuario</option>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm">
                            💾 Guardar Cambios
                        </button>
                        <a href="{{ route('users.index') }}"
                            class="btn btn-secondary fw-bold px-4 py-2 rounded-pill shadow-sm">
                            ❌ Cancelar
                        </a>
                    </div>
                </form>
            </div>

        </div>

    </div>

@endsection
