@extends('errors.layout')

@section('code', '404')
@section('title', 'Página no encontrada')
@section('message')
    <p class="subtitle">Oops... parece que te has perdido en el espacio digital.</p>
    <img src="{{ asset('images/404-astronaut.gif') }}" alt="Astronauta perdido" class="error-image">

    <div class="actions">
        <a href="{{ route('dashboard') }}" class="btn">Volver al inicio</a>
        <a href="{{ route('products.shop') }}" class="btn secondary">Ir a la tienda</a>
    </div>
@endsection
