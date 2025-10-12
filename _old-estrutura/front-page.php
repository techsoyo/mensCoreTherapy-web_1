<?php
/**
 * Template Name: Front Page
 * 
 * The template for displaying the front page.
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    while ( have_posts() ) :
        the_post();

        // Cargar contenido de home
        get_template_part( 'template-parts/home' );

    endwhile; // End of the loop.
    ?>
</main><!-- #main -->

<?php
get_footer();