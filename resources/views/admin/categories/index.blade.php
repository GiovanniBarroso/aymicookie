@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')

<div class="container">

    <div class="card my-5 rounded-4">
        <div class="card-header pt-3 ps-4 bg-dark rounded-top-4">
            <h1 class="fw-bold text-white">{{ __('Categories') }}</h1>
        </div>
        <div class="card-body p-0 overflow-x-auto">

        </div>
        <div class="card-footer text-body-secondary">
            {{-- Showing 4 / 4 --}}
        </div>
      </div>

</div>

@endsection
