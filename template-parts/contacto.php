<?php

/**
 * Template part: Contacto
 * Versión limpia, reutilizable y sin lógica mezclada.
 */
?>

<section class="contacto-section">
    <div class="container">

        <header class="contacto-header">
            <h2 class="section-title">Contacto</h2>
            <p class="section-subtitle">¿Tienes preguntas? Estamos aquí para ayudarte</p>
        </header>

        <div class="contacto-grid">

            <!-- Información -->
            <aside class="contacto-info">
                <h3 class="contacto-info__title">Información de Contacto</h3>

                <?php
                $info = [
                    [
                        'icon' => 'fa-map-marker-alt',
                        'title' => 'Dirección',
                        'content' => 'Calle de la Salud, 123<br>08080 Barcelona, España'
                    ],
                    [
                        'icon' => 'fa-phone',
                        'title' => 'Teléfono',
                        'content' => '<a href="tel:+34931234567">+34 931 234 567</a><br><a href="tel:+34612345678">+34 612 345 678</a>'
                    ],
                    [
                        'icon' => 'fa-envelope',
                        'title' => 'Email',
                        'content' => '<a href="mailto:info@menscoretherapy.com">info@menscoretherapy.com</a><br><a href="mailto:reservas@menscoretherapy.com">reservas@menscoretherapy.com</a>'
                    ],
                    [
                        'icon' => 'fa-clock',
                        'title' => 'Horario',
                        'content' => 'Lunes a Viernes: 9:00 - 21:00<br>Sábados: 10:00 - 18:00'
                    ],
                    [
                        'icon' => 'fa-share-alt',
                        'title' => 'Redes Sociales',
                        'content' => '<a href="#" target="_blank" rel="noopener">@menscoretherapy</a><br>Síguenos en Instagram y Facebook'
                    ]
                ];

                foreach ($info as $item): ?>
                    <div class="contacto-item">
                        <div class="contacto-item__icon">
                            <i class="fas <?= esc_attr($item['icon']) ?>"></i>
                        </div>
                        <div class="contacto-item__content">
                            <h4><?= esc_html($item['title']) ?></h4>
                            <p><?= wp_kses_post($item['content']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </aside>

            <!-- Formulario -->
            <div class="contacto-form">
                <h3 class="contacto-form__title">Envíanos un Mensaje</h3>

                <form id="contactoForm" class="mm-contacto-form" novalidate>
                    <div class="form-group">
                        <label for="contactoNombre">Nombre Completo *</label>
                        <input type="text" id="contactoNombre" name="nombre" required placeholder="Tu nombre completo">
                    </div>

                    <div class="form-group">
                        <label for="contactoEmail">Email *</label>
                        <input type="email" id="contactoEmail" name="email" required placeholder="tu@email.com">
                    </div>


                    <div class="form-group">
                        <label for="contactoMensaje">Mensaje *</label>
                        <textarea id="contactoMensaje" name="mensaje" rows="3" required placeholder="Cuéntanos en qué podemos ayudarte..."></textarea>
                    </div>

                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="contactoPrivacidad" name="privacidad" required>
                            Acepto la <a href="<?= esc_url(get_privacy_policy_url()) ?>" target="_blank" rel="noopener">política de privacidad</a> y el tratamiento de mis datos *
                        </label>
                    </div>

                    <button type="submit" class="btn btn--large">
                        <i class="fas fa-paper-plane"></i> Enviar Mensaje
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>