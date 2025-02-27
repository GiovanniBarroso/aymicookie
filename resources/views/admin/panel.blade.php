@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')

<div class="container">

    <div class="card mt-5">
        <div class="card-header pt-3">
            <h5>{{ __('Admin Panel') }}</h5>
        </div>
        <div class="card-body">

            <div class="d-flex flex-wrap justify-content-evenly">

                <a class="btn btn-outline-dark btn-lg m-2 border-0">
                    <i class="fa-solid fa-user me-1"></i>
                    {{ __('Users') }}
                </a>

                <a class="btn btn-outline-dark btn-lg m-2 border-0">
                    <i class="fa-solid fa-truck me-1"></i>
                    {{ __('Orders') }}
                </a>

                <a class="btn btn-outline-dark btn-lg m-2 border-0" href="{{ route('products') }}">
                    <i class="fa-solid fa-box me-1"></i>
                    {{ __('Products') }}
                </a>

                <a class="btn btn-outline-dark btn-lg m-2 border-0">
                    <i class="fa-solid fa-list me-1"></i>
                    {{ __('Categories') }}
                </a>

                <a class="btn btn-outline-dark btn-lg m-2 border-0">
                    <i class="fa-solid fa-shop me-1"></i>
                    {{ __('Brands') }}
                </a>

            </div>

        </div>
      </div>

</div>

@endsection
