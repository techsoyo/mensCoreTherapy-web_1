<?php

/**
 * Template part for reservas page content
 * Sistema de reservas con formulario
 */
?>

<section class="reservas-section">
    <div class="reservas-container">
        <!-- Header -->
        <header class="reservas-header">
            <h2 class="section-title">Reservar Cita</h2>
            <p class="section-subtitle">Agenda tu sesión de bienestar de forma fácil y rápida</p>
        </header>

        <div class="reservas-grid">
            <!-- Información de reservas -->
            <aside class="reservas-info">
                <h3 class="reservas-info__title">Información de Reservas</h3>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-calendar-check"></i>
                    </div>
                    <div class="info-card__content">
                        <h4>Disponibilidad</h4>
                        <p>Lunes a Viernes: 9:00 - 21:00<br>Sábados: 10:00 - 18:00</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-clock"></i>
                    </div>
                    <div class="info-card__content">
                        <h4>Confirmación</h4>
                        <p>Te confirmaremos tu cita en menos de 2 horas</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-shield-alt"></i>
                    </div>
                    <div class="info-card__content">
                        <h4>Política de Cancelación</h4>
                        <p>Cancela hasta 24h antes sin costo</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <div class="info-card__content">
                        <h4>Formas de Pago</h4>
                        <p>Efectivo, tarjeta o transferencia</p>
                    </div>
                </div>
            </aside>

            <!-- Formulario de reservas -->
            <div class="reservas-form">
                <h3 class="reservas-form__title">Datos de la Reserva</h3>

                <form class="mm-reservas-form" id="reservasForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <?php wp_nonce_field('submit_reserva_form', 'reserva_form_nonce'); ?>
                    <input type="hidden" name="action" value="submit_reserva_form">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre Completo *</label>
                            <input type="text" id="nombre" name="nombre" required autocomplete="name">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono *</label>
                            <input type="tel" id="telefono" name="telefono" required autocomplete="tel">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="servicio">Servicio *</label>
                        <select id="servicio" name="servicio" required>
                            <option value="">Seleccionar servicio...</option>
                            <?php
                            $servicios = get_posts(array(
                                'post_type' => 'servicio',
                                'numberposts' => -1,
                                'post_status' => 'publish',
                                'orderby' => 'title',
                                'order' => 'ASC'
                            ));

                            foreach ($servicios as $servicio) {
                                $precio = get_post_meta($servicio->ID, '_servicio_precio', true);
                                $duracion = get_post_meta($servicio->ID, '_servicio_duracion', true);
                                $info_extra = '';

                                if ($precio || $duracion) {
                                    $info_parts = array();
                                    if ($precio) $info_parts[] = $precio;
                                    if ($duracion) $info_parts[] = $duracion;
                                    $info_extra = ' - ' . implode(' | ', $info_parts);
                                }

                                printf(
                                    '<option value="%s">%s%s</option>',
                                    esc_attr($servicio->post_title),
                                    esc_html($servicio->post_title),
                                    esc_html($info_extra)
                                );
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
                                <?php
                                for ($h = 9; $h <= 20; $h++) {
                                    $hora = sprintf('%02d:00', $h);
                                    printf('<option value="%s">%s</option>', $hora, $hora);
                                }
                                ?>
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
                            Confirmo que la información proporcionada es correcta *
                        </label>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="privacidad" name="privacidad" required>
                            Acepto la <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" target="_blank" rel="noopener">política de privacidad</a> *
                        </label>
                    </div>

                    <button type="submit" class="btn btn--primary btn--large">
                        <i class="fa fa-calendar-plus"></i>
                        Solicitar Reserva
                    </button>

                    <p class="form-note">* La reserva estará sujeta a confirmación de disponibilidad</p>
                </form>
            </div>
        </div>
    </div>
</section>

