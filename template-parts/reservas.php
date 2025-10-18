<?php

/**
 * Template part for reservas page content
 * Sistema de reservas con formulario - DYNAMIC VERSION
 */
?>

<section class="reservas-section">
    <div class="reservas-container">
        <header class="reservas-header mb-xl text-center">
            <h2 class="section-title text-primary mb-md">Reservar Cita</h2>
            <p class="section-subtitle text-body">Agenda tu sesión de bienestar de forma fácil y rápida</p>
        </header>

        <div class="reservas-grid">
            <!-- Información de reservas - DYNAMIC -->
            <div class="reservas-info">
                <h3 class="reservas-info__title">Información de Reservas</h3>

                <?php
                $hours_reservas = menscoretherapy_get_contact_info('hours_reservas', "Lunes a Viernes: 9:00 - 21:00\nSábados: 10:00 - 18:00");
                $confirmation_time = menscoretherapy_get_contact_info('confirmation_time', 'Te confirmaremos tu cita en menos de 2 horas');
                $cancellation_policy = menscoretherapy_get_contact_info('cancellation_policy', 'Cancela hasta 24h antes sin costo');
                $payment_methods = menscoretherapy_get_contact_info('payment_methods', 'Efectivo, tarjeta o transferencia');
                ?>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-calendar-check"></i>
                    </div>
                    <div class="info-card__content">
                        <h5>Disponibilidad</h5>
                        <p><?php echo nl2br(esc_html($hours_reservas)); ?></p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-clock"></i>
                    </div>
                    <div class="info-card__content">
                        <h5>Confirmación</h5>
                        <p><?php echo esc_html($confirmation_time); ?></p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-shield-alt"></i>
                    </div>
                    <div class="info-card__content">
                        <h5>Política de Cancelación</h5>
                        <p><?php echo esc_html($cancellation_policy); ?></p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card__icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <div class="info-card__content">
                        <h5>Formas de Pago</h5>
                        <p><?php echo esc_html($payment_methods); ?></p>
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
                            <option value="">Seleccionar servicio…</option>

                            <?php
                            /* ----- Leer masajes desde la página “Masajes” (ID 56) ----- */
                            $page_id = 56; // ID real de la página “Masajes”
                            for ($i = 1; $i <= 20; $i++) {
                                $nombre   = get_post_meta($page_id, "masaje_{$i}_nombre",   true);
                                $precio   = get_post_meta($page_id, "masaje_{$i}_precio",   true);
                                $duracion = get_post_meta($page_id, "masaje_{$i}_duracion", true);

                                if ($nombre) {
                                    $info = trim(($precio ?: '') . ' ' . ($duracion ? "($duracion)" : ''));
                                    echo '<option value="' . esc_attr($nombre) . '">' . esc_html($nombre . ' ' . $info) . '</option>';
                                }
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
                                <option value="">Seleccionar hora…</option>
                                <?php
                                $horas = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
                                foreach ($horas as $h) {
                                    echo '<option value="' . $h . '">' . $h . '</option>';
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
                            <span class="checkmark"></span>
                            Confirmo que la información proporcionada es correcta *
                        </label>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="privacidad" name="privacidad" required>
                            <span class="checkmark"></span>
                            Acepto la <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" target="_blank">política de privacidad</a> *
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