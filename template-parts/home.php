<?php

/**
 * Template part for home page content
 * Página principal con banner e información destacada
 */

// Obtener información de contactos (si existe la función)
$ci = function_exists('mm_get_contact_info') ? mm_get_contact_info() : [
    'phone' => '673 000 000',
    'hours' => 'Lunes a Domingo 10:00-22:00'
];
?>

<div class="home-content">
    <!-- Banner Principal -->
    <section class="mm-home-banner"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/home.webp');"
        role="banner">
        <div class="mm-home-banner__overlay">
            <div class="container">
                <div class="mm-home-banner__content">
                    <h1 class="mm-home-banner__title">
                        Masajes Profesionales para Hombres
                    </h1>
                    <p class="mm-home-banner__subtitle">
                        ¿Listo para tu experiencia de bienestar?
                    </p>
                    <p class="mm-home-banner__description">
                        Discreción, profesionalidad y resultados garantizados. 100% Discreto.
                        Reserva tu cita ahora y descubre una nueva dimensión de relajación y bienestar
                    </p>

                    <div class="mm-home-banner__cta">
                        <a href="<?php echo esc_url(home_url('/reservas/')); ?>"
                            class="btn btn--primary">
                            Reservar Cita
                        </a>
                        <a href="<?php echo esc_url(home_url('/servicios/')); ?>"
                            class="btn btn--white">
                            Ver Servicios
                        </a>
                    </div>

                    <div class="mm-home-banner__info">
                        <span>tel. <?php echo esc_html($ci['phone']); ?></span>
                        <span class="sep">|</span>
                        <span><?php echo esc_html($ci['hours']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Llamada a la Acción Final -->
    <!-- <section class="mm-home-cta"> -->
        <!-- <div class="container">
            <div class="mm-home-cta__content">
                <h2 class="mm-home-cta__title">¿Listo para tu experiencia de bienestar?</h2>
                <p class="mm-home-cta__description">
                    Reserva tu cita ahora y descubre una nueva dimensión de relajación y bienestar
                </p>
                <div class="mm-home-cta__buttons">
                    <a href="<?php echo esc_url(home_url('/reservas/')); ?>"
                        class="btn btn--primary">
                        Reservar Ahora
                    </a>
                    <a href="tel:<?php echo esc_attr(str_replace(' ', '', $ci['phone'])); ?>"
                        class="btn btn--secondary">
                        Llamar: <?php echo esc_html($ci['phone']); ?>
                    </a>
                </div>
                <div class="mm-home-cta__info">
                    Atención personalizada y profesional
                </div>
            </div>
        </div> -->
    </section>
</div>