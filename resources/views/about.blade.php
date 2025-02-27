@extends('layouts.app')

@section('title', 'Sobre Nosotros - Ay Mi Cookie')

@section('content')
<div class="container py-5 text-white">

    <!-- 🔥 SECCIÓN ENCABEZADO -->
    <div class="text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Ay Mi Cookie" class="img-fluid mb-3" style="max-width: 600px;">
        <h1 class="fw-bold">Sobre Nosotros</h1>
        <p class="lead">
            Creemos en el poder de una buena galleta. 🎉 Horneamos con amor y pasión, 
            utilizando los mejores ingredientes para hacer cada mordida inolvidable.
        </p>
    </div>

    <!-- 🎨 SECCIÓN DESTACADA (Imagen + Texto) -->
    <div class="card bg-dark text-white shadow-lg mt-5">
        <div class="row g-0 align-items-center">
            <div class="col-md-6 p-4">
                <h2 class="fw-bold">La tentación nunca supo tan bien 🍪</h2>
                <p class="mt-3">
                    En <span class="text-warning fw-semibold">Ay Mi Cookie</span>, llevamos años creando experiencias dulces.  
                    Desde nuestras clásicas galletas de chispas de chocolate hasta combinaciones innovadoras, 
                    cada receta está diseñada para que disfrutes al máximo.   
                </p>
                <p>
                    Queremos que cada cliente sienta la calidez y felicidad que transmitimos en cada galleta. 
                    Por eso, seleccionamos ingredientes premium y horneamos con dedicación.   
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/galletas.png') }}" alt="Ay Mi Cookie" class="img-fluid rounded-end">
            </div>
        </div>
    </div>

    <!-- 🍪 SECCIÓN HISTORIA -->
    <div class="card bg-warning text-dark shadow-lg mt-5 p-4 text-center">
        <h2 class="fw-bold">Nuestra Historia</h2>
        <p class="mt-3">
            Todo comenzó con una pasión por la repostería y el deseo de compartir sonrisas en cada bocado.  
            Desde una cocina casera hasta una tienda querida por muchos, nuestro viaje ha sido increíble.  
            Hoy, somos más que una galletería; somos una experiencia de sabor, alegría y tradición. ❤️🍪
        </p>
    </div>

    <!-- 📷 GALERÍA DE CREACIONES -->
    <div class="text-center mt-5">
        <h2 class="fw-bold">Nuestras Creaciones ⭐</h2>
        <p class="text-muted">Un vistazo a nuestras irresistibles galletas.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        <div class="col">
            <img src="{{ asset('images/galletachoco.png
            ') }}" class="img-fluid rounded shadow-lg" alt="Cookie 1" style="width: 100%; height: 250px; object-fit: cover;">
        </div>
        <div class="col">
            <img src="{{ asset('images/cookieroja.png') }}" class="img-fluid rounded shadow-lg" alt="Cookie 2" style="width: 100%; height: 250px; object-fit: cover;">
        </div>
        <div class="col">
            <img src="{{ asset('images/GalletaFeria.png') }}" class="img-fluid rounded shadow-lg" alt="Cookie 3" style="width: 100%; height: 250px; object-fit: cover;">
        </div>
    </div>

    <!-- 📍 SECCIÓN DE CONTACTO -->
    <div class="card bg-warning text-dark shadow-lg mt-5 p-4 text-center">
        <h3 class="fw-bold">¡Ven a conocernos! 📍</h3>
        <p class="mt-2">
            Nos encantaría verte en nuestra tienda y que pruebes nuestras galletas recién horneadas.
        </p>
    </div>
</div>
@endsection
