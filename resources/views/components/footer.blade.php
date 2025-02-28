<footer class="footer text-white py-5" style="background-color: #E85C0D;">
    <div class="container">
        <div class="row">
            <!-- Sección de navegación (Mapa del sitio mejorado) -->
            <div class="col-md-3">
                <h5 class="text-uppercase fw-bold mb-3">Mapa del Sitio</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="/" class="text-white text-decoration-none d-flex align-items-center">
                            <i class="fas fa-home me-2"></i> Inicio
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/shop" class="text-white text-decoration-none d-flex align-items-center">
                            <i class="fas fa-box-open me-2"></i> Productos
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/about" class="text-white text-decoration-none d-flex align-items-center">
                            <i class="fas fa-users me-2"></i> Sobre Nosotros
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/contact" class="text-white text-decoration-none d-flex align-items-center">
                            <i class="fas fa-envelope me-2"></i> Contacto
                        </a>
                    </li>
                </ul>
            </div>


            <!-- Sección de contacto -->
            <div class="col-md-3">
                <h5 class="text-uppercase fw-bold mb-3">Contacto</h5>
                <p><i class="fas fa-envelope"></i> <a href="mailto:info@aymicookie.com"
                        class="text-white">info@aymicookie.com</a></p>
                <p><i class="fas fa-phone"></i> <a href="tel:+34912345678" class="text-white">+34 912 345 678</a></p>
                <p><i class="fas fa-map-marker-alt"></i> Calle José León, 123, Sevilla, España</p>
            </div>

            <!-- Sección de ubicación con mapa mejorado -->
            <div class="col-md-3">
                <h5 class="text-uppercase fw-bold mb-3">Ubicación</h5>
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6340.782293022575!2d-6.015010524436188!3d37.380581072087246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd126c6834aed41f%3A0xbdbf5d259820c143!2sC.%20Jos%C3%A9%20Le%C3%B3n%2C%2041010%20Sevilla!5e0!3m2!1ses!2ses!4v1740738876558!5m2!1ses!2ses"
                        width="100%" height="250" style="border:0; border-radius: 10px;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Sección de redes sociales con iconos más visibles -->
            <div class="col-md-3 text-center">
                <h5 class="text-uppercase fw-bold mb-3">Síguenos</h5>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-tiktok fa-2x"></i></a>
                </div>
            </div>
        </div>

        <hr class="bg-light">

        <!-- Frase atractiva y botón de políticas de privacidad -->
        <div class="text-center mb-3">
            <h6 class="mb-2">🍪 ¡Disfruta de la mejor experiencia con Ay Mi Cookie! 🍪</h6>
            <p>Sabor, calidad y tradición en cada bocado.</p>
            <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#privacyModal">Ver Políticas de
                Privacidad</button>
        </div>

        <!-- Derechos reservados -->
        <div class="text-center">
            <p class="mb-0 fw-bold">&copy; {{ date('Y') }} Ay Mi Cookie - Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<!-- Modal de Políticas de Privacidad -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="privacyModalLabel">Políticas de Privacidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <h6>1. Recopilación de Información</h6>
                <p>Recopilamos información personal cuando interactúas con nuestra página web, incluyendo nombre,
                    dirección de correo electrónico y datos de pago cuando realizas compras.</p>

                <h6>2. Uso de la Información</h6>
                <p>Utilizamos la información recopilada para procesar pedidos, mejorar la experiencia del usuario y
                    enviar actualizaciones sobre productos y promociones.</p>

                <h6>3. Seguridad y Protección</h6>
                <p>Implementamos medidas de seguridad para proteger tu información personal contra accesos no
                    autorizados.</p>

                <h6>4. Derechos del Usuario</h6>
                <p>Tienes derecho a acceder, rectificar o eliminar tus datos personales en cualquier momento.</p>

                <h6>5. Cookies y Tecnologías Similares</h6>
                <p>Utilizamos cookies para mejorar tu experiencia de navegación y personalizar contenido.</p>

                <h6>6. Almacenamiento de Datos</h6>
                <p>Los datos personales se almacenan de forma segura y se conservan solo el tiempo necesario.</p>

                <h6>7. Compartición de Información</h6>
                <p>No vendemos ni compartimos información personal con terceros sin tu consentimiento.</p>

                <h6>8. Modificaciones en la Política</h6>
                <p>Nos reservamos el derecho de modificar nuestra política de privacidad en cualquier momento.</p>
            </div>
        </div>
    </div>
</div>
