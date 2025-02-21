@extends('layouts.app')
@section('title', 'DashboardPassword')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
