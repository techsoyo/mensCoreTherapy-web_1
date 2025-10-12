<?php
/**
 * Template part for home page content
 * Solo banner principal - el resto del contenido va en páginas específicas
 */

// Obtener información de contactos (si existe la función)
$ci = function_exists('mm_get_contact_info') ? mm_get_contact_info() : [
    'phone' => '+34 123 456 789',
    'hours' => 'Lunes a Domingo: 10:00 - 22:00'
];
?>

<div class="home-content">
    <!-- Sección Principal (reemplaza hero) -->
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
                        Experiencias de relajación y bienestar
                    </p>
                    <p class="mm-home-banner__description">
                        Discreción, profesionalidad y resultados garantizados. 100% Discreto.
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
