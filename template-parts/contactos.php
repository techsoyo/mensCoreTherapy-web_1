<?php

/**
 * Template part for contactos page content
 * Formulario de contactos y información
 */
?>

<section class="contactos-section">
    <div class="contactos-container">
        <header class="contactos-header mb-xl text-center">
            <h2 class="section-title text-primary mb-md">contactos</h2>
            <p class="section-subtitle text-body">Estamos aquí para ayudarte. Contáctanos para cualquier consulta</p>
        </header>

        <div class="contactos-grid">
            <!-- Información de contactos -->
            <div class="contactos-info">
                <h3 class="contactos-info__title">Información de contactos</h3>

                <div class="contactos-item">
                    <div class="contactos-item__icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="contactos-item__content">
                        <h4>Teléfono</h4>
                        <p>+34 600 123 456</p>
                    </div>
                </div>

                <div class="contactos-item">
                    <div class="contactos-item__icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="contactos-item__content">
                        <h4>Email</h4>
                        <p>info@masajesmasculinos.com</p>
                    </div>
                </div>

                <div class="contactos-item">
                    <div class="contactos-item__icon">
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                    <div class="contactos-item__content">
                        <h4>Dirección</h4>
                        <p>Calle Bienestar 123<br>28001 Madrid, España</p>
                    </div>
                </div>

                <div class="contactos-item">
                    <div class="contactos-item__icon">
                        <i class="fa fa-clock"></i>
                    </div>
                    <div class="contactos-item__content">
                        <h4>Horarios</h4>
                        <p>Lun - Vie: 9:00 - 21:00<br>Sáb: 10:00 - 18:00<br>Dom: Cerrado</p>
                    </div>
                </div>
            </div>

            <!-- Formulario de contactos -->
            <div class="contactos-form">
                <h3 class="contactos-form__title">Envíanos un Mensaje</h3>

                <form class="mm-contact-form" id="contactForm" method="post" action="">
                    <div class="form-group">
                        <label for="nombre">Nombre *</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono">
                    </div>

                    <div class="form-group">
                        <label for="servicio">Servicio de Interés</label>
                        <select id="servicio" name="servicio">
                            <option value="">Seleccionar servicio...</option>
                            <?php
                            $servicios = get_posts(array(
                                'post_type' => 'servicio',
                                'numberposts' => -1,
                                'post_status' => 'publish'
                            ));
                            foreach ($servicios as $servicio) {
                                echo '<option value="' . esc_attr($servicio->post_title) . '">' . esc_html($servicio->post_title) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje *</label>
                        <textarea id="mensaje" name="mensaje" rows="5" required placeholder="Cuéntanos cómo podemos ayudarte..."></textarea>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="privacidad" name="privacidad" required>
                            <span class="checkmark"></span>
                            Acepto la <a href="/politica-privacidad/" target="_blank">política de privacidad</a> *
                        </label>
                    </div>

                    <button type="submit" class="btn btn--primary btn--large">
                        <i class="fa fa-paper-plane"></i>
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Aquí se puede agregar la lógica para enviar el formulario
                alert('¡Gracias por tu mensaje! Te contactaremos pronto.');

                // Reset form
                form.reset();
            });
        }
    });
</script>