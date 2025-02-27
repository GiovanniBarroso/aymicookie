@extends('layouts.app')

@section('title', 'Contáctanos - Ay Mi Cookie')

@section('content')
<div class="container py-5">
    <div class="text-center text-white">
        <h1 class="fw-bold">Contáctanos 📩</h1>
        <p class="lead">¿Tienes preguntas, comentarios o sugerencias? ¡Nos encantaría escucharte!  
            Déjanos un mensaje y nuestro equipo te responderá lo más pronto posible. 💌
        </p>
    </div>

    <!-- 📩 FORMULARIO DE CONTACTO -->
    <div class="card bg-dark text-white shadow-lg mt-4 mx-auto" style="max-width: 600px;">
        <div class="card-body p-4">
            <h3 class="text-center fw-bold mb-4">Déjanos tu Mensaje</h3>
            
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" name="name" class="form-control bg-secondary text-white border-0" placeholder="Ejemplo: Juan Pérez" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control bg-secondary text-white border-0" placeholder="Ejemplo: juanperez@email.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Asunto</label>
                    <input type="text" name="subject" class="form-control bg-secondary text-white border-0" placeholder="Ejemplo: Consulta sobre pedidos" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tu Mensaje</label>
                    <textarea name="message" rows="4" class="form-control bg-secondary text-white border-0" placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning fw-bold text-dark">
                        Enviar Mensaje 📩
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 🔗 BOTÓN DE REDES SOCIALES -->
    <div class="text-center mt-5">
        <h3 class="fw-bold text-white">Síguenos en Instagram 📸</h3>
        <p class="text-white-50">Descubre nuestras últimas creaciones y promociones exclusivas.</p>
        <a href="#" class="btn btn-warning fw-bold text-dark px-4 py-2">Síguenos en Instagram</a>
    </div>

</div>
@endsection
