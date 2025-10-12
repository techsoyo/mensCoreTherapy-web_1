<?php
/* Template Name: Masajes */
get_header();
?>

<main class="pagina-masajes container">
  <h1 class="titulo-seccion"><?php the_title(); ?></h1>

  <div class="masajes-grid">
    <?php
    // bucle de 3 masajes (puedes aumentar a más si lo deseas)
    for ($i = 1; $i <= 3; $i++) :
      $nombre = get_post_meta(get_the_ID(), "masaje_{$i}_nombre", true);
      $descripcion = get_post_meta(get_the_ID(), "masaje_{$i}_descripcion", true);
      $precio = get_post_meta(get_the_ID(), "masaje_{$i}_precio", true);
      $duracion = get_post_meta(get_the_ID(), "masaje_{$i}_duracion", true);

      if ($nombre) : ?>
        <div class="card-flip">
          <div class="card-inner">
            <!-- Cara frontal -->
            <div class="card-front">
              <h3><?php echo esc_html($nombre); ?></h3>
              <p><?php echo esc_html($descripcion); ?></p>
            </div>

            <!-- Cara trasera -->
            <div class="card-back">
              <h3><?php echo esc_html($nombre); ?></h3>
              <p><strong>Precio:</strong> <?php echo esc_html($precio); ?></p>
              <p><strong>Duración:</strong> <?php echo esc_html($duracion); ?></p>
            </div>
          </div>
        </div>
    <?php endif;
    endfor; ?>
  </div>
</main>

<?php get_footer(); ?>