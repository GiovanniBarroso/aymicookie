@extends('layouts.app')

@section('title', 'Sobre Nosotros - Ay Mi Cookie')

@section('content')
<div class="relative bg-gray-900 py-16">
    <div class="container mx-auto px-6">

        <!-- 🔥 SECCIÓN DE BIENVENIDA -->
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Ay Mi Cookie" class="w-40 mx-auto drop-shadow-lg animate-bounce">
            <h1 class="text-6xl font-extrabold text-white mt-6">Sobre Nosotros</h1>
            <p class="mt-4 text-xl text-white max-w-2xl mx-auto leading-relaxed">
                Creemos en el poder de una buena galleta. 🎉 Horneamos con amor y pasión, 
                utilizando los mejores ingredientes para hacer cada mordida inolvidable.
            </p>
        </div>

        <!-- 🎨 SECCIÓN DESTACADA (Imagen + Texto) -->
        <div class="mt-16 flex flex-col md:flex-row items-center bg-gray-800 p-10 rounded-xl shadow-2xl">
            <div class="md:w-1/2 text-white">
                <h2 class="text-4xl font-bold">La tentación nunca supo tan bien 🍪</h2>
                <p class="mt-4 leading-relaxed">
                    En <span class="text-yellow-400 font-semibold">Ay Mi Cookie</span>, llevamos años creando experiencias dulces.  
                    Desde nuestras clásicas galletas de chispas de chocolate hasta combinaciones innovadoras, 
                    cada receta está diseñada para que disfrutes al máximo.   
                </p>
                <p class="mt-4 leading-relaxed">
                    Queremos que cada cliente sienta la calidez y felicidad que transmitimos en cada galleta. 
                    Por eso, seleccionamos ingredientes premium y horneamos con dedicación.   
                </p>
            </div>
            <img src="{{ asset('images/about-us.jpg') }}" alt="Ay Mi Cookie" 
                 class="w-full md:w-1/2 rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
        </div>

        <!-- 🍪 SECCIÓN DE LA HISTORIA -->
        <div class="mt-20 bg-blue-600 text-white p-12 rounded-xl shadow-xl text-center">
            <h2 class="text-5xl font-bold">Nuestra Historia</h2>
            <p class="mt-4 text-lg max-w-3xl mx-auto">
                Todo comenzó con una pasión por la repostería y el deseo de compartir sonrisas en cada bocado.  
                Desde una cocina casera hasta una tienda querida por muchos, nuestro viaje ha sido increíble.  
                Hoy, somos más que una galletería; somos una experiencia de sabor, alegría y tradición. ❤️🍪
            </p>
        </div>

        <!-- 📷 GALERÍA DE CREACIONES -->
        <div class="mt-20 bg-blue-600 text-white p-12 rounded-xl shadow-xl text-center">
            <h2 class="text-4xl font-bold">Nuestras Creaciones ⭐</h2>
            <p class="text-lg">Un vistazo a nuestras irresistibles galletas.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
            <div class="relative">
                <img src="{{ asset('images/cookie1.jpg') }}" onerror="this.style.display='none'" class="w-full rounded-xl shadow-lg hover:scale-105 transition duration-300">
            </div>
            <div class="relative">
                <img src="{{ asset('images/cookie2.jpg') }}" onerror="this.style.display='none'" class="w-full rounded-xl shadow-lg hover:scale-105 transition duration-300">
            </div>
            <div class="relative">
                <img src="{{ asset('images/cookie3.jpg') }}" onerror="this.style.display='none'" class="w-full rounded-xl shadow-lg hover:scale-105 transition duration-300">
            </div>
        </div>

        <!-- 📍 SECCIÓN DE CONTACTO -->
        <div class="mt-20 bg-blue-600 text-white p-12 rounded-xl shadow-xl text-center">
            <h3 class="text-4xl font-bold">¡Ven a conocernos! 📍</h3>
            <p class="mt-2 text-lg">
                Nos encantaría verte en nuestra tienda y que pruebes nuestras galletas recién horneadas.
            </p>
            <div class="mt-6">
                <a href="#" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-full shadow-lg hover:bg-yellow-300 transition duration-300 text-lg font-semibold inline-block transform hover:scale-105">
                    Ver Ubicación
                </a>
            </div>
        </div>

        <!-- 🔗 SECCIÓN DE REDES SOCIALES -->
        <div class="mt-16 bg-blue-600 text-white p-12 rounded-xl shadow-xl text-center">
            <h3 class="text-3xl font-bold">Síguenos en Instagram 📸</h3>
            <p class="mt-2 text-lg">Descubre nuestras últimas creaciones y promociones exclusivas.</p>
            <div class="mt-6">
                <a href="#" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-full shadow-lg hover:bg-yellow-300 transition duration-300 text-lg font-semibold inline-block transform hover:scale-105">
                    Síguenos en Instagram
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
