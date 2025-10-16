<?php

/**
 * Template part for reservas page content
 * Sistema de reservas con formulario
 */
?>

<section class="reservas-section">
    <div class="reservas-container">
        <header class="reservas-header mb-xl text-center">
            <h2 class="section-title text-primary mb-md">Reservar Cita</h2>
            <p class="section-subtitle text-body">Agenda tu sesión de bienestar de forma fácil y rápida</p>
        </header>

        <div class="reservas-grid">
            <!-- Información de reservas -->
            <div class="reservas-info">
                <h3 class="reservas-info__title">Información de Reservas</h3>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-calendar-check"></i>
                    </div>
                    <div class="info-card__content">
                        <h5>Disponibilidad</h5>
                        <p>Lunes a Viernes: 9:00 - 21:00<br>Sábados: 10:00 - 18:00</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-clock"></i>
                    </div>
                    <div class="info-card__content">
                        <h5>Confirmación</h5>
                        <p>Te confirmaremos tu cita en menos de 2 horas</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-shield-alt"></i>
                    </div>
                    <div class="info-card__content">
                        <h5>Política de Cancelación</h5>
                        <p>Cancela hasta 24h antes sin costo</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <div class="info-card__content">
                        <h5>Formas de Pago</h5>
                        <p>Efectivo, tarjeta o transferencia</p>
                    </div>
                </div>
            </div>

            <!-- Formulario de reservas -->
            <div class="reservas-form">
                <h3 class="reservas-form__title">Datos de la Reserva</h3>

                <form class="mm-reservas-form" id="reservasForm" method="post" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre Completo *</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono *</label>
                            <input type="tel" id="telefono" name="telefono" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="servicio">Servicio *</label>
                        <select id="servicio" name="servicio" required>
                            <option value="">Seleccionar servicio...</option>
                            <?php
                            $servicios = get_posts(array(
                                'post_type' => 'servicio',
                                'numberposts' => -1,
                                'post_status' => 'publish'
                            ));
                            foreach ($servicios as $servicio) {
                                $precio = get_post_meta($servicio->ID, '_servicio_precio', true);
                                $duracion = get_post_meta($servicio->ID, '_servicio_duracion', true);
                                $info_extra = '';
                                if ($precio || $duracion) {
                                    $info_extra = ' - ';
                                    if ($precio) $info_extra .= $precio;
                                    if ($duracion) $info_extra .= ' (' . $duracion . ')';
                                }
                                echo '<option value="' . esc_attr($servicio->post_title) . '">' . esc_html($servicio->post_title) . $info_extra . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha">Fecha Preferida *</label>
                            <input type="date" id="fecha" name="fecha" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="hora">Hora Preferida *</label>
                            <select id="hora" name="hora" required>
                                <option value="">Seleccionar hora...</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comentarios">Comentarios o Necesidades Especiales</label>
                        <textarea id="comentarios" name="comentarios" rows="4" placeholder="Cuéntanos si tienes alguna preferencia o necesidad especial..."></textarea>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="confirmacion" name="confirmacion" required>
                            <span class="checkmark"></span>
                            Confirmo que la información proporcionada es correcta *
                        </label>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="privacidad" name="privacidad" required>
                            <span class="checkmark"></span>
                            Acepto la <a href="/politica-privacidad/" target="_blank">política de privacidad</a> *
                        </label>
                    </div>

                    <button type="submit" class="btn btn--primary btn--large">
                        <i class="fa fa-calendar-plus"></i>
                        Solicitar Reserva
                    </button>

                    <p class="form-note">
                        * La reserva estará sujeta a confirmación de disponibilidad
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reservasForm');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validar que todos los campos requeridos estén llenos
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#e74c3c';
                    } else {
                        field.style.borderColor = '#e9ecef';
                    }
                });

                if (isValid) {
                    // Aquí se puede agregar la lógica para enviar la reserva
                    alert('¡Solicitud de reserva enviada! Te contactaremos pronto para confirmar tu cita.');
                    form.reset();
                } else {
                    alert('Por favor, completa todos los campos obligatorios.');
                }
            });
        }
    });
</script>