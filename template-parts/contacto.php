<?php

/**
 * Template part for contacto page content
 * Formulario de contacto y información
 */
?>

<section class="contacto-section">
        <header class="contacto-header mb-xl text-center">
            <h2 class="section-title text-primary mb-md">Contacto</h2>
            <p class="section-subtitle text-body">Estamos aquí para ayudarte. Contáctanos para cualquier consulta</p>
        </header>

        <div class="contacto-grid">
            <!-- Información de contacto -->
            <div class="contacto-info" data-aos="fade-right" data-aos-duration="1000">
                <h3 class="contacto-info__title">Información de contacto</h3>

                <div class="contacto-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="contacto-item__icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contacto-item__content">
                        <h4>¿Tienes dudas? Llámanos</h4>
                        <p><a href="tel:+34600123456" class="hover:text-primary transition-colors">+34 600 123 456</a></p>
                    </div>
                </div>

                <div class="contacto-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="contacto-item__icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contacto-item__content">
                        <h4>Escríbenos</h4>
                        <p><a href="mailto:info@masajesmasculinos.com" class="hover:text-primary transition-colors">info@masajesmasculinos.com</a></p>
                    </div>
                </div>

                <div class="contacto-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="contacto-item__icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contacto-item__content">
                        <h4>Horario de Atención</h4>
                        <p>
                            <span class="block">Lunes a Viernes: 9:00 - 21:00</span>
                            <span class="block">Sábados: 10:00 - 18:00</span>
                            <span class="block text-muted">Domingos: Cerrado</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Formulario de contacto -->
            <div class="contacto-form" data-aos="fade-left" data-aos-duration="1000">
                <h3 class="contacto-form__title">Envíanos un Mensaje</h3>

                <form class="contact-form" id="contactForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <?php wp_nonce_field('submit_contact_form', 'contact_form_nonce'); ?>
                    <input type="hidden" name="action" value="submit_contact_form">

                    <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                        <label for="nombre">Nombre <span class="text-primary">*</span></label>
                        <input type="text" 
                               id="nombre" 
                               name="nombre" 
                               required 
                               minlength="2"
                               pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+"
                               title="Por favor, introduce un nombre válido"
                               autocomplete="name">
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                        <label for="email">Email <span class="text-primary">*</span></label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                               title="Por favor, introduce un email válido"
                               autocomplete="email">
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" 
                               id="telefono" 
                               name="telefono"
                               pattern="[0-9+\s-]{9,}"
                               title="Por favor, introduce un número de teléfono válido"
                               autocomplete="tel">
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="400">
                        <label for="servicio">Servicio de Interés <span class="text-primary">*</span></label>
                        <select id="servicio" 
                                name="servicio" 
                                required>
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

                    <div class="form-group" data-aos="fade-up" data-aos-delay="500">
                        <label for="mensaje">Mensaje <span class="text-primary">*</span></label>
                        <textarea id="mensaje" 
                                  name="mensaje" 
                                  required
                                  minlength="10"
                                  rows="5"
                                  placeholder="¿Cómo podemos ayudarte? Cuéntanos los detalles de tu consulta..."
                        ></textarea>
                    </div>

                    <div class="form-group checkbox-group" data-aos="fade-up" data-aos-delay="600">
                        <label class="checkbox-label">
                            <input type="checkbox" 
                                   id="privacidad" 
                                   name="privacidad" 
                                   required>
                            <span class="checkmark"></span>
                            He leído y acepto la <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" 
                               target="_blank" 
                               class="text-primary hover:underline">política de privacidad</a> <span class="text-primary">*</span>
                        </label>
                    </div>

                    <div class="form-group" data-aos="fade-up" data-aos-delay="700">
                        <button type="submit" class="btn btn--large">
                            <span class="btn-text">Enviar Mensaje</span>
                            <i class="fas fa-paper-plane"></i>
                            <div class="btn-loading hidden">
                                <div class="spinner"></div>
                                <span>Enviando...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    // Función para mostrar mensajes
    function showMessage(message, type = 'success') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert--${type} fade-in`;
        alertDiv.innerHTML = `
            <div class="alert-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <p>${message}</p>
            </div>
            <button class="alert-close">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        form.insertAdjacentElement('beforebegin', alertDiv);
        
        // Auto-cerrar después de 5 segundos
        setTimeout(() => {
            alertDiv.classList.add('fade-out');
            setTimeout(() => alertDiv.remove(), 300);
        }, 5000);

        // Botón de cerrar
        alertDiv.querySelector('.alert-close').addEventListener('click', () => {
            alertDiv.classList.add('fade-out');
            setTimeout(() => alertDiv.remove(), 300);
        });
    }

    // Validación del formulario
    function validateForm() {
        const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('error');
            } else {
                input.classList.remove('error');
            }
        });

        return isValid;
    }

    if (form) {
        // Validación en tiempo real
        form.querySelectorAll('input, select, textarea').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (!validateForm()) {
                showMessage('Por favor, completa todos los campos requeridos.', 'error');
                return;
            }

            // Mostrar estado de carga
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) throw new Error('Error en el envío');

                const data = await response.json();

                if (data.success) {
                    showMessage('¡Gracias por tu mensaje! Te contactaremos pronto.');
                    form.reset();
                } else {
                    throw new Error(data.message || 'Error en el envío');
                }
            } catch (error) {
                showMessage(error.message || 'Ha ocurrido un error. Por favor, intenta nuevamente.', 'error');
            } finally {
                // Restaurar botón
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
            }
        });
    }

    // Animaciones de entrada
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 50
        });
    }
});
</script>