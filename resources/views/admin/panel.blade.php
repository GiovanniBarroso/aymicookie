@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')

<div class="container">

    <div class="card my-5 rounded-4">
        <div class="card-header pt-3 bg-dark rounded-top-4">
            <h1 class="text-white">{{ __('Admin Panel') }}</h1>
        </div>
        <div class="card-body">

            <div class="d-flex flex-wrap justify-content-evenly">

                <a class="btn btn-outline-dark btn-lg m-2 border-0" href="{{ route(name: 'users') }}">
                    <i class="fa-solid fa-user me-1"></i>
                    {{ __('Users') }}
                </a>

                <a class="btn btn-outline-dark btn-lg m-2 border-0" href="{{ route('orders') }}">
                    <i class="fa-solid fa-truck me-1"></i>
                    {{ __('Orders') }}
                </a>

                <a class="btn btn-outline-dark btn-lg m-2 border-0" href="{{ route('products.index') }}">
                    <i class="fa-solid fa-box me-1"></i>
                    {{ __('Products') }}
                </a>

                <a class="btn btn-outline-dark btn-lg m-2 border-0" href="{{ route('categories') }}">
                    <i class="fa-solid fa-list me-1"></i>
                    {{ __('Categories') }}
                </a>

                <a class="btn btn-outline-dark btn-lg m-2 border-0" href="{{ route('brands') }}">
                    <i class="fa-solid fa-shop me-1"></i>
                    {{ __('Brands') }}
                </a>

            </div>

        </div>
    </div>

</div>

@endsection
