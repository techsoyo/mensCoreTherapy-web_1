<?php

/**
 * ARCHIVO DINÁMICO - Motor de renderizado
 * Carga dinámicamente el contenido según la página visitada:
 * /servicios/ → template-parts/servicios.php
 * /productos/ → template-parts/nuestros-productos.php  
 * /reservas/ → template-parts/reservas.php
 * /contactos/ → template-parts/contactos.php
 */

get_header(); ?>
<!-- DEBUG: Usando PAGE.PHP -->

<main id="main" class="site-main" role="main">
    <?php
    while (have_posts()) :
        the_post();

        // Obtener el slug de la página actual
        $slug = get_post_field('post_name', get_post());
        
        // DEBUG: Mostrar el slug detectado
        echo "<!-- DEBUG SLUG: " . $slug . " -->";

        // Mapeo especial para casos donde el slug no coincide con el nombre del template-part
        $template_map = array(
            'inicio' => 'home',
            'ns-servicios' => 'servicios', // Apunta al template part correcto
            'servicios' => 'servicios',
            'productos' => 'nuestros-productos',
            'contactos' => 'contactos'
        );

        // Usar mapeo si existe, sino usar el slug directamente
        $template_name = isset($template_map[$slug]) ? $template_map[$slug] : $slug;

        // Cargar el template-part correspondiente
        $template_path = 'template-parts/' . $template_name;

        if (locate_template($template_path . '.php')) {
            get_template_part($template_path);
        } else {
            // Fallback si no encuentra el template-part
            echo '<div class="container">';
            echo '<h1>Página en construcción</h1>';
            echo '<p>El contenido para "' . esc_html($slug) . '" está siendo preparado.</p>';
            echo '<p><a href="' . home_url() . '">← Volver al inicio</a></p>';
            echo '</div>';
        }

    endwhile;
    ?>
</main><!-- #main -->

<?php
get_footer();
