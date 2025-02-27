@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')

<div class="container">

    <div class="card my-5 rounded-4">
        <div class="card-header pt-3 ps-4 bg-dark rounded-top-4">
            <h1 class="fw-bold text-white">{{ __('Users') }}</h1>
        </div>
        <div class="card-body p-0 overflow-x-auto">

            @if ($users)

                <table class="table table-striped m-0 table-borderless">
                    <thead>
                        <tr>
                          <th scope="col" class="px-3">Id</th>
                          <th scope="col" class="px-3">Role</th>
                          <th scope="col" class="px-3">Name</th>
                          <th scope="col" class="px-3">Last Name</th>
                          <th scope="col" class="px-3">Email</th>
                        </tr>
                      </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td class="px-3">{{ $user->id }}</td>

                                @switch($user->roles_id)
                                    @case(1)
                                        <td class="px-3">{{ __('Admin') }}</td>
                                        @break
                                    @case(2)
                                        <td class="px-3">{{ __('User') }}</td>
                                        @break
                                    @default
                                @endswitch

                                <td class="px-3">{{ $user->name }}</td>
                                <td class="px-3">{{ $user->apellidos }}</td>
                                <td class="px-3">{{ $user->email }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            @endif

        </div>
        <div class="card-footer text-body-secondary">
            {{-- Showing 4 / 4 --}}
        </div>
      </div>

</div>

@endsection
