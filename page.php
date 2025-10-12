<?php

/**
 * ARCHIVO DINÁMICO - Motor de renderizado
 * Carga dinámicamente el contenido según la página visitada:
 * /productos/  → template-parts/nuestros-productos.php  
 * /reservas/   → template-parts/reservas.php
 * /contactos/  → template-parts/contactos.php
 * /masajes/    → template-parts/masajes.php
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    while (have_posts()) :
        the_post();

        // Obtener el slug de la página actual
        $slug = get_post_field('post_name', get_post());

        // DEBUG opcional:
        // echo "<!-- DEBUG SLUG: " . esc_html($slug) . " -->";

        // Mapeo de slugs a nombres de template-parts (si difieren)
        $template_map = array(
            'inicio'     => 'home',
            'productos'  => 'nuestros-productos',
            'contactos'  => 'contactos',
            'reservas'   => 'reservas',
            'masajes'    => 'masajes' // añadido para tu nueva página
        );

        // Determinar el nombre del template
        $template_name = isset($template_map[$slug]) ? $template_map[$slug] : $slug;

        // Ruta esperada dentro de /template-parts/
        $template_path = 'template-parts/' . $template_name;

        // Si el archivo existe, lo carga
        if (locate_template($template_path . '.php')) {
            get_template_part($template_path);
        } else {
            // Fallback si el template-part no existe
            echo '<div class="container">';
            echo '<h1>Página en construcción</h1>';
            echo '<p>El contenido para <strong>"' . esc_html($slug) . '"</strong> está siendo preparado.</p>';
            echo '<p><a href="' . esc_url(home_url()) . '">← Volver al inicio</a></p>';
            echo '</div>';
        }

    endwhile;
    ?>
</main><!-- #main -->

<?php get_footer(); ?>