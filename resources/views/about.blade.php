@extends('layouts.app')

@section('title', 'Sobre Nosotros - Ay Mi Cookie')

@section('content')

<!-- 🔥 Sección Hero -->
<section class="py-5 text-black text-center" style="background-color: #FABC3F;">
    <div class="container">
        <h1 class="fw-bold display-4">About Us</h1>
        <p class="lead">
            Creemos en el poder de una buena galleta. 🍪 Horneamos con amor y pasión, 
            utilizando los mejores ingredientes para hacer cada mordida inolvidable.
        </p>
    </div>
</section>

<!-- 🎨 Sección Destacada + Estadísticas -->
<section class="py-5 text-white" style="background-color: #8C1C28;">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 align-items-center">
            <div class="col">
                <h2 class="fw-bold text-warning">La tentación nunca supo tan bien</h2>
                <p class="mt-3">
                    En <span class="fw-semibold text-warning">Ay Mi Cookie</span>, llevamos años creando experiencias dulces.  
                    Desde nuestras clásicas galletas de chispas de chocolate hasta combinaciones innovadoras, 
                    cada receta está diseñada para que disfrutes al máximo.
                </p>
                <p>
                    Queremos que cada cliente sienta la calidez y felicidad en cada bocado.  
                    Por eso, seleccionamos ingredientes premium y horneamos con dedicación.   
                </p>
            </div>
            <div class="col text-center">
                <img src="{{ asset('images/galletas.png') }}" alt="Ay Mi Cookie" class="img-fluid">
            </div>
        </div>

        <!-- 🏆 Estadísticas Destacadas -->
        <div class="row text-center mt-5">
            <div class="col-md-4">
                <h2 class="fw-bold text-warning">+10,000</h2>
                <p class="text-white">Galletas Horneadas</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold text-warning">5 Años</h2>
                <p class="text-white">Creando Dulces Momentos</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold text-warning">+3,500</h2>
                <p class="text-white">Clientes Satisfechos</p>
            </div>
        </div>
    </div>
</section>

<!-- 🍪 Historia de la Marca -->
<div class="container py-5">
    <div class="card p-4 border-0 text-black text-center" style="background-color: #FABC3F;">
        <h2 class="fw-bold text-black">Nuestra Historia</h2>
        <p class="mt-3">
            Todo comenzó con una pasión por la repostería y el deseo de compartir sonrisas en cada bocado.  
            Desde una cocina casera hasta una tienda querida por muchos, nuestro viaje ha sido increíble.  
            Hoy, somos más que una galletería; somos una experiencia de sabor, alegría y tradición. ❤️🍪
        </p>
    </div>
</div>

<!-- 📷 Nuestras Creaciones + Galería -->
<section class="py-5 text-white text-center" style="background-color: #8C1C28;">
    <div class="container">
        <h2 class="fw-bold text-warning">Nuestras Creaciones ⭐</h2>
        <p class="text-white">Un vistazo a nuestras irresistibles galletas.</p>
        
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
            <div class="col">
                <img src="{{ asset('images/cookieroja.png
                ') }}" class="img-fluid rounded shadow-lg" alt="Cookie 1" style="width: 100%; height: 250px; object-fit: cover;">
            </div>
            <div class="col">
                <img src="{{ asset('images/galletachoco.png') }}" class="img-fluid rounded shadow-lg" alt="Cookie 2" style="width: 100%; height: 250px; object-fit: cover;">
            </div>
            <div class="col">
                <img src="{{ asset('images/GalletaFeria.png') }}" class="img-fluid rounded shadow-lg" alt="Cookie 3" style="width: 100%; height: 250px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- 📍 Ubicación y Contacto -->
<div class="container py-5">
    <div class="card border-0 p-4 text-center text-black" style="background-color: #FABC3F;">
        <h3 class="fw-bold text-black">¡Ven a conocernos! 📍</h3>
        <p class="mt-2">
            Nos encantaría verte en nuestra tienda y que pruebes nuestras galletas recién horneadas.  
            También puedes pedir online y recibir en casa.
        </p>
    </div>
</div>

@endsection
