<?php

/**
 * Template part for contacto page content
 * Formulario de contacto y información
 */
?>

<section class="contacto-section">
    <div class="contacto-container">
        <!-- Header -->
        <header class="contacto-header">
            <h2 class="section-title">Contacto</h2>
            <p class="section-subtitle">Estamos aquí para ayudarte. Contáctanos para cualquier consulta</p>
        </header>

        <div class="contacto-grid">
            <!-- Información de contacto -->
            <aside class="contacto-info">
                <h3 class="contacto-info__title">Información de contacto</h3>

                <div class="contacto-item">
                    <div class="contacto-item__icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contacto-item__content">
                        <h4>¿Tienes dudas? Llámanos</h4>
                        <p><a href="tel:+34600123456">+34 600 123 456</a></p>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-item__icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contacto-item__content">
                        <h4>Escríbenos</h4>
                        <p><a href="mailto:info@masajesmasculinos.com">info@masajesmasculinos.com</a></p>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-item__icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contacto-item__content">
                        <h4>Horario de Atención</h4>
                        <p>
                            Lunes a Viernes: 9:00 - 21:00<br>
                            Sábados: 10:00 - 18:00<br>
                            Domingos: Cerrado
                        </p>
                    </div>
                </div>
            </aside>

            <!-- Formulario de contacto -->
            <div class="contacto-form">
                <h3 class="contacto-form__title">Envíanos un Mensaje</h3>

                <form class="contact-form" id="contactForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <?php wp_nonce_field('submit_contact_form', 'contact_form_nonce'); ?>
                    <input type="hidden" name="action" value="submit_contact_form">

                    <div class="form-group">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            required
                            minlength="2"
                            pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+"
                            title="Por favor, introduce un nombre válido"
                            autocomplete="name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                            title="Por favor, introduce un email válido"
                            autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            pattern="[0-9+\s-]{9,}"
                            title="Por favor, introduce un número de teléfono válido"
                            autocomplete="tel">
                    </div>

                    <div class="form-group">
                        <label for="servicio">Servicio de Interés <span class="required">*</span></label>
                        <select id="servicio" name="servicio" required>
                            <option value="">Selecciona un servicio...</option>
                            <?php
                            $servicios = get_posts(array(
                                'post_type' => 'servicio',
                                'numberposts' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'post_status' => 'publish'
                            ));

                            foreach ($servicios as $servicio) {
                                printf(
                                    '<option value="%s">%s</option>',
                                    esc_attr($servicio->post_title),
                                    esc_html($servicio->post_title)
                                );
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group form-group--full">
                        <label for="mensaje">Mensaje <span class="required">*</span></label>
                        <textarea
                            id="mensaje"
                            name="mensaje"
                            required
                            minlength="10"
                            rows="5"
                            placeholder="¿Cómo podemos ayudarte? Cuéntanos los detalles de tu consulta..."></textarea>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="privacidad" name="privacidad" required>
                            He leído y acepto la
                            <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" target="_blank" rel="noopener">política de privacidad</a>
                            <span class="required">*</span>
                        </label>
                    </div>

                    <div class="form-group form-group--full">
                        <button type="submit" class="btn btn--large">
                            <span class="btn-text">Enviar Mensaje</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        'use strict';

        const form = document.getElementById('contactForm');
        if (!form) return;

        // Función para mostrar mensajes
        function showMessage(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert--' + type;
            alertDiv.innerHTML = '<p>' + message + '</p><button class="alert-close">×</button>';

            form.insertAdjacentElement('beforebegin', alertDiv);

            // Auto-cerrar después de 5 segundos
            setTimeout(function() {
                alertDiv.remove();
            }, 5000);

            // Botón de cerrar
            alertDiv.querySelector('.alert-close').addEventListener('click', function() {
                alertDiv.remove();
            });
        }

        // Validación del formulario
        function validateForm() {
            const inputs = form.querySelectorAll('[required]');
            let isValid = true;

            inputs.forEach(function(input) {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });

            return isValid;
        }

        // Validación en tiempo real
        form.querySelectorAll('input, select, textarea').forEach(function(input) {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });

        // Envío del formulario
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateForm()) {
                showMessage('Por favor, completa todos los campos requeridos.', 'error');
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('.btn-text');

            // Deshabilitar botón
            submitBtn.disabled = true;
            btnText.textContent = 'Enviando...';

            // Simular envío (reemplazar con AJAX real)
            setTimeout(function() {
                showMessage('¡Gracias por tu mensaje! Te contactaremos pronto.', 'success');
                form.reset();
                submitBtn.disabled = false;
                btnText.textContent = 'Enviar Mensaje';
            }, 1000);
        });
    })();
</script>