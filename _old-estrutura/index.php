<?php
// Incluye el archivo de cabecera del tema de WordPress, que contiene el DOCTYPE, head, navegación, etc.
get_header(); ?>

<!-- Contenedor principal del contenido de la página -->
<main id="main-content" role="main" class="main-content">
  <div class="container">
    <?php
    // Verifica si hay posts para mostrar
    if (have_posts()) : ?>
      <?php
      // Inicia el bucle de WordPress para recorrer los posts
      while (have_posts()) : the_post(); ?>
        <!-- Artículo individual para cada post -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
          <!-- Título del post -->
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <!-- Contenido del post -->
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
        </article>
      <?php
      // Fin del bucle de posts
      endwhile; ?>

      <!-- Paginación para navegar entre páginas de posts -->
      <div class="mm-pagination"><?php the_posts_pagination(); ?></div>
    <?php
    // Si no hay posts, muestra un mensaje
    else: ?>
      <p><?php _e('No hay contenido.', 'menscoretherapy'); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php
// Incluye el archivo de pie de página del tema de WordPress
get_footer(); ?>
</main>