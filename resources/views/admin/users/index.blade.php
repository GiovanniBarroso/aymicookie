@extends('layouts.app')

@section('title', 'Usuarios Registrados')

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
            <div
                class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4 py-3 px-4">
                <h1 class="fw-bold fs-4 m-0">👥 Usuarios Registrados</h1>
            </div>

            <!-- BODY -->
            <div class="card-body p-0">
                @if ($users && $users->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle m-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="px-3"># ID</th>
                                    <th class="px-3">🎖️ Rol</th>
                                    <th class="px-3">📝 Nombre</th>
                                    <th class="px-3">👤 Apellidos</th>
                                    <th class="px-3">📧 Email</th>
                                    <th class="px-3 text-center">⚙️ Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="table-row-hover">
                                        <td class="px-3 fw-bold">#{{ $user->id }}</td>

                                        <td class="px-3">
                                            @switch($user->roles_id)
                                                @case(1)
                                                    <span class="badge bg-danger">🛡️ Admin</span>
                                                @break

                                                @case(2)
                                                    <span class="badge bg-primary">👤 Usuario</span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">❔ Desconocido</span>
                                            @endswitch
                                        </td>

                                        <td class="px-3">{{ $user->name }}</td>
                                        <td class="px-3">{{ $user->apellidos }}</td>
                                        <td class="px-3">{{ $user->email }}</td>

                                        <td class="px-3 text-center d-flex justify-content-center gap-2">
                                            <!-- Editar -->
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-sm btn-warning rounded-pill shadow-sm">
                                                ✏️ Editar
                                            </a>

                                            <!-- Eliminar -->
                                            <button type="button" class="btn btn-sm btn-danger rounded-pill shadow-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}">
                                                🗑️ Eliminar
                                            </button>

                                            <!-- Modal Confirmación -->
                                            <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="deleteUserLabel{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                Confirmar Eliminación
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Seguro que deseas eliminar al usuario
                                                            <strong>{{ $user->name }} {{ $user->apellidos }}</strong>?
                                                            Esta acción no se puede deshacer.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('users.destroy', $user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    🗑️ Eliminar
                                                                </button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Cancelar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <h5 class="text-muted mb-3">🚫 No hay usuarios registrados.</h5>
                        <p>Cuando se registren aparecerán aquí.</p>
                    </div>
                @endif
            </div>

            <!-- FOOTER -->
            <div class="card-footer text-center py-3 text-muted">
                Mostrando <strong>{{ $users->count() }}</strong> {{ Str::plural('usuario', $users->count()) }}
            </div>

        </div>

    </div>

@endsection
