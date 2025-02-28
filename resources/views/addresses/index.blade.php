@extends('layouts.app')

@section('content')
    <h2>Mis Direcciones</h2>
    <a href="{{ route('addresses.create') }}" class="btn btn-primary">Añadir Nueva Dirección</a>
    <ul>
        @foreach ($addresses as $address)
            <li>
                {{ $address->calle }}, {{ $address->ciudad }}, {{ $address->provincia }}, {{ $address->codigo_postal }},
                {{ $address->pais }}
                <form action="{{ route('addresses.destroy', $address) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
