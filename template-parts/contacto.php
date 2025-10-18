<?php

/**
 * Template part for contacto page content
 * Formulario de contacto y información - DYNAMIC VERSION
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
            <!-- Información de contacto - DYNAMIC -->
            <aside class="contacto-info">
                <h3 class="contacto-info__title">Información de contacto</h3>

                <?php
                $phone = menscoretherapy_get_contact_info('phone', '+34 600 123 456');
                $email = menscoretherapy_get_contact_info('email', 'info@masajesmasculinos.com');
                $hours_detailed = menscoretherapy_get_contact_info('hours_detailed', "Lunes a Viernes: 9:00 - 21:00\nSábados: 10:00 - 18:00\nDomingos: Cerrado");
                ?>

                <?php if ($phone): ?>
                    <div class="contacto-item">
                        <div class="contacto-item__icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contacto-item__content">
                            <h4>¿Tienes dudas? Llámanos</h4>
                            <p><a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($email): ?>
                    <div class="contacto-item">
                        <div class="contacto-item__icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contacto-item__content">
                            <h4>Escríbenos</h4>
                            <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($hours_detailed): ?>
                    <div class="contacto-item">
                        <div class="contacto-item__icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contacto-item__content">
                            <h4>Horario de Atención</h4>
                            <p><?php echo nl2br(esc_html($hours_detailed)); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
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
                            // Obtener masajes del CPT
                            $masajes = get_posts(array(
                                'post_type' => 'masaje',
                                'numberposts' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'post_status' => 'publish'
                            ));

                            foreach ($masajes as $masaje) {
                                printf(
                                    '<option value="%s">%s</option>',
                                    esc_attr($masaje->post_title),
                                    esc_html($masaje->post_title)
                                );
                            }

                            // Fallback: obtener productos si no hay masajes
                            if (empty($masajes)) {
                                $productos = get_posts(array(
                                    'post_type' => 'producto',
                                    'numberposts' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post_status' => 'publish'
                                ));

                                foreach ($productos as $producto) {
                                    printf(
                                        '<option value="%s">%s</option>',
                                        esc_attr($producto->post_title),
                                        esc_html($producto->post_title)
                                    );
                                }
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