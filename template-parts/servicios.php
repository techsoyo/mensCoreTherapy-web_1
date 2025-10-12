<?php

/**
 * Template part for servicios page content
 * Muestra servicios con cards flip para mostrar precio y duración
 */

// Obtener servicios desde la base de datos
$servicios_query = new WP_Query(array(
    'post_type' => 'servicio',
    'posts_per_page' => -1,
    'post_status' => 'publish'
));
?>

<section class="servicios-section">
    <div class="container">
        <header class="servicios-header mb-xl text-center">
            <h2 class="section-title text-primary mb-md">Nuestros Servicios</h2>
            <p class="section-subtitle text-body">Experiencias de bienestar personalizadas para hombres</p>
        </header>

        <?php if ($servicios_query->have_posts()) : ?>
            <div class="mm-servicios-grid">
                <?php while ($servicios_query->have_posts()) : $servicios_query->the_post();
                    // Usamos $servicios_query->post->ID para garantizar que obtenemos el ID del post dentro de este bucle personalizado
                    $precio = get_post_meta($servicios_query->post->ID, '_servicio_precio', true);
                    $duracion = get_post_meta($servicios_query->post->ID, '_servicio_duracion', true);
                ?>
                    <article class="mm-servicio-card" onclick="this.classList.toggle('is-flipped')">
                        <div class="mm-servicio-card__inner">
                            <!-- CARA FRONTAL -->
                            <div class="mm-servicio-card__front">
                                <div class="mm-servicio-card__content">
                                    <h3 class="mm-servicio-card__title"><?php the_title(); ?></h3>
                                    <p class="mm-servicio-card__description"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                                    <div class="mm-servicio-card__hint">Clic para más información</div>
                                </div>
                            </div>

                            <!-- CARA TRASERA -->
                            <div class="mm-servicio-card__back">
                                <div class="mm-servicio-card__content">
                                    <h3 class="mm-servicio-card__title"><?php the_title(); ?></h3>

                                    <div class="mm-servicio-card__price-section">
                                        <div class="mm-servicio-card__label">Precio</div>
                                        <div class="mm-servicio-card__price"><?php echo $precio ? esc_html($precio) : 'Consultar'; ?></div>
                                    </div>

                                    <div class="mm-servicio-card__duration-section">
                                        <div class="mm-servicio-card__label">Duración</div>
                                        <div class="mm-servicio-card__duration"><?php echo $duracion ? esc_html($duracion) : 'Variable'; ?></div>
                                    </div>

                                    <a href="<?php echo home_url('/reservas/'); ?>" class="btn btn--primary">Reservar</a>
                                    <div class="mm-servicio-card__hint">Clic para volver</div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="no-servicios text-center">
                <p>No hay servicios disponibles en este momento.</p>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

        <!-- Llamada a la acción -->
        <div class="servicios-cta text-center mt-xl">
            <h3 class="cta-title text-primary mb-md">¿Listo para relajarte?</h3>
            <p class="cta-subtitle text-body mb-md">Reserva tu sesión de bienestar personalizada</p>
            <a href="<?php echo esc_url(home_url('/reservas/')); ?>"
                class="btn btn--primary btn--large">
                Reservar Cita
            </a>
        </div>
    </div>
</section>