<?php

/**
 * Template part for legal pages
 * Para páginas legales, políticas, condiciones, etc.
 */
?>

<section class="legal-page-section">
  <div class="legal-container container">
    <article class="legal-article">

      <!-- Encabezado -->
      <header class="legal-header">
        <h1 class="legal-title"><?php the_title(); ?></h1>

        <?php if (get_the_modified_date()) : ?>
          <p class="legal-date">
            <strong>Última actualización:</strong>
            <?php echo get_the_modified_date('d/m/Y'); ?>
          </p>
        <?php endif; ?>
      </header>

      <!-- Contenido -->
      <div class="legal-content">
        <?php the_content(); ?>
      </div>

      <!-- Botón volver -->
      <footer class="legal-footer">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">
          <i class="fa fa-arrow-left"></i> Volver al inicio
        </a>
      </footer>

    </article>
  </div>
</section>