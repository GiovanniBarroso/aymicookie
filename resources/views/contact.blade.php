@extends('layouts.app')

@section('title', 'Contáctanos - Ay Mi Cookie')

@section('content')
    <div class="container py-5">
        <!-- Encabezado con Animación -->
        <div class="text-center text-dark">
            <h1 class="fw-bold display-4 animate__animated animate__fadeInDown">
                ¿Necesitas ayuda? 🍪
            </h1>
            <p class="lead animate__animated animate__fadeInUp">
                Estamos aquí para escucharte. Déjanos un mensaje y te responderemos lo antes posible.
            </p>
        </div>

        <!-- Formulario de Contacto Mejorado -->
        <div class="card border-0 shadow-lg mt-5 mx-auto bg-light"
            style="max-width: 600px; border-radius: 20px; padding: 20px;">
            <div class="card-body p-5">
                <h3 class="text-center fw-bold mb-4 text-primary animate__animated animate__fadeIn">Déjanos tu mensaje 💌
                </h3>

                <form id="contactForm" action="{{ route('contact.send') }}" method="POST">
                    @csrf

                    <!-- Campo Nombre -->
                    <div class="mb-4">
                        <label class="form-label styled-label">Nombre Completo</label>
                        <input type="text" name="name" id="name" class="form-control custom-input"
                            placeholder="Ejemplo: Juan Pérez" required>
                        <small class="text-danger d-none" id="nameError">El nombre debe contener al menos 2
                            palabras.</small>
                    </div>

                    <!-- Campo Correo -->
                    <div class="mb-4">
                        <label class="form-label styled-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control custom-input"
                            placeholder="Ejemplo: juanperez@email.com" required>
                        <small class="text-danger d-none" id="emailError">Ingrese un correo válido.</small>
                    </div>

                    <!-- Campo Asunto -->
                    <div class="mb-4">
                        <label class="form-label styled-label">Asunto</label>
                        <input type="text" name="subject" id="subject" class="form-control custom-input"
                            placeholder="Ejemplo: Consulta sobre pedidos" required>
                        <small class="text-danger d-none" id="subjectError">El asunto debe tener al menos 3
                            caracteres.</small>
                    </div>

                    <!-- Campo Mensaje -->
                    <div class="mb-4">
                        <label class="form-label styled-label">Tu Mensaje</label>
                        <textarea name="message" id="message" rows="4" class="form-control custom-input"
                            placeholder="Escribe tu mensaje aquí..." required></textarea>
                        <small class="text-danger d-none" id="messageError">El mensaje debe tener al menos 10
                            caracteres.</small>
                    </div>

                    <!-- Botón de Enviar con Animación -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-gradient fw-bold shadow-sm custom-button">
                            <span class="btn-text">Enviar Mensaje 📩</span>
                            <span class="spinner-border spinner-border-sm d-none"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">¡Mensaje Enviado! ✅</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Tu mensaje ha sido enviado con éxito. Nos pondremos en contacto contigo lo antes posible. 🎉
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Estilo de Labels */
        .styled-label {
            font-weight: bold;
            color: #ff9800;
            font-size: 1rem;
            transition: all 0.3s ease-in-out;
        }

        .custom-input {
            background: #fff;
            border: 2px solid #ced4da;
            border-radius: 10px;
            padding: 12px;
            transition: all 0.3s ease-in-out;
        }

        .custom-input:focus {
            border-color: #ff9800;
            box-shadow: 0 0 10px rgba(255, 152, 0, 0.5);
            outline: none;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #ff9800, #ff5722);
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-size: 18px;
            transition: all 0.3s ease-in-out;
        }

        .btn-gradient:hover {
            background: linear-gradient(90deg, #ff5722, #ff9800);
            transform: scale(1.05);
        }
    </style>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Evita el envío automático

            let isValid = true;

            // Validación del Nombre
            let name = document.getElementById('name').value.trim();
            if (name.split(" ").length < 2) {
                document.getElementById('nameError').classList.remove('d-none');
                isValid = false;
            } else {
                document.getElementById('nameError').classList.add('d-none');
            }

            // Validación del Email
            let email = document.getElementById('email').value.trim();
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                document.getElementById('emailError').classList.remove('d-none');
                isValid = false;
            } else {
                document.getElementById('emailError').classList.add('d-none');
            }

            // Validación del Asunto
            let subject = document.getElementById('subject').value.trim();
            if (subject.length < 3) {
                document.getElementById('subjectError').classList.remove('d-none');
                isValid = false;
            } else {
                document.getElementById('subjectError').classList.add('d-none');
            }

            // Validación del Mensaje
            let message = document.getElementById('message').value.trim();
            if (message.length < 10) {
                document.getElementById('messageError').classList.remove('d-none');
                isValid = false;
            } else {
                document.getElementById('messageError').classList.add('d-none');
            }

            if (isValid) {
                // Mostrar modal de éxito
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                // Simular envío del formulario
                setTimeout(() => {
                    e.target.submit();
                }, 2000);
            }
        });
    </script>
@endsection
