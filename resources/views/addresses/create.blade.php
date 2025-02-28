@extends('layouts.app')

@section('content')
    <h2>Añadir Nueva Dirección</h2>
    <form action="{{ route('addresses.store') }}" method="POST">
        @csrf
        <label>Calle:</label>
        <input type="text" name="calle" required>

        <label>Ciudad:</label>
        <input type="text" name="ciudad" required>

        <label>Provincia:</label>
        <input type="text" name="provincia" required>

        <label>Código Postal:</label>
        <input type="text" name="codigo_postal" required>

        <label>País:</label>
        <input type="text" name="pais" required>

        <button type="submit">Guardar Dirección</button>
    </form>
@endsection
