@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<!-- Sección Hero -->
<section class="hero d-flex flex-column align-items-center justify-content-center text-center text-white position-relative" style="background-color: #FABC3F; height: 90vh; overflow: hidden;">
    <!-- Imagen ajustada al borde inferior y ancho completo -->
    <img src="{{ asset('images/bg_test.png') }}" alt="Galleta" 
         class="img-fluid position-absolute bottom-0 start-50 translate-middle-x" 
         style="width: 110%; max-width: none;">
</section>


<!-- Sección Visión de la Marca -->
<section class="vision d-flex align-items-center text-center text-white py-5" style="background-color: #8C1C28;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/cookies-stack.png') }}" alt="Galletas" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <p class="fs-5 fw-bold">
                    Poner una Explicación de lo que queremos que encuentren en nuestra página, o nuestra visión de marca
                    <span class="text-warning">(Fuera del Quienes Somos)</span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Productos Recomendados -->
<section class="productos d-flex align-items-center text-center text-white py-5" style="background-color: #C62828;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <p class="fs-5 fw-bold">
                    Productos Recomendados y comentar la sección 
                    <span class="text-warning">"Crea tu propia Cookie"</span> con nuestros ingredientes 
                    <span class="text-warning">(Personalización de Producto)</span>
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/cookies-stack-2.png') }}" alt="Galletas" class="img-fluid">
            </div>
        </div>
    </div>
</section>

@endsection




{{-- ESTRUCTURA DASHBOARD PARA VALIDACION EN DOS PASOS --}}
{{-- 
@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status') === 'two-factor-authentication-enabled')
                            <div class="alert alert-success" role="alert">
                                Two factor authentication has been enabled.
                            </div>
                        @endif

                        @if (session('status') === 'two-factor-authentication-disabled')
                            <div class="alert alert-danger" role="alert">
                                Two factor authentication has been disabled.
                            </div>
                        @endif

                        <form action="user/two-factor-authentication" method="POST">
                            @csrf
                            @if (auth()->user()->two_factor_secret)
                                @method('DELETE')

                                <div class="mb-3">
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                </div>
                                <button class="btn btn-danger">Disable</button>
                            @else
                                <button class="btn btn-success">Enable</button>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
