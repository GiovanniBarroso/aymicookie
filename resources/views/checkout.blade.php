@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Confirmar Compra</h2>

        <form action="{{ route('checkout') }}" method="GET">
            <h4>Selecciona una dirección de envío:</h4>
            @foreach (auth()->user()->addresses as $address)
                <div>
                    <input type="radio" name="address_id" value="{{ $address->id }}" required>
                    {{ $address->direccion }}, {{ $address->ciudad }}, {{ $address->código_postal }}, {{ $address->país }}
                </div>
            @endforeach

            <h4>Total a pagar: <strong>{{ number_format($total, 2) }}€</strong></h4>

            <button type="submit" class="btn btn-primary">Pagar con PayPal</button>
        </form>

    </div>
@endsection
