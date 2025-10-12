<?php if (!defined('ABSPATH')) exit; ?>
<section class="hero servicios-hero">
  <div class="hero-overlay"></div>
  
  <div class="container">
    <h1 class="hero-title"><?php _e('Nuestros Servicios', 'menscoretherapy'); ?></h1>
    <p class="hero-subtitle"><?php _e('Experiencias de bienestar personalizadas para hombres', 'menscoretherapy'); ?></p>

    <?php
    // Obtener servicios de la base de datos usando la función preparada
    $servicios = get_servicios_data();

    // Debug: mostrar información
    echo '<!-- DEBUG: Servicios encontrados: ' . count($servicios) . ' -->';
    if (!empty($servicios)) {
      echo '<!-- DEBUG: Primer servicio: ' . print_r($servicios[0], true) . ' -->';
    }

    if (!empty($servicios)) :
    ?>
      <div class="grid grid--3">
        <?php foreach ($servicios as $servicio) : ?>
          <article class="card card--flip" onclick="this.classList.toggle('is-flipped')">
            <div class="card__inner">
              <!-- CARA FRONTAL -->
              <div class="card__front">
                <div class="card__content">
                  <h3 class="card__title"><?php echo esc_html($servicio['nombre']); ?></h3>
                  <p class="card__description"><?php echo esc_html($servicio['descripcion']); ?></p>
                  <div class="card__hint">Clic para más información</div>
                </div>
              </div>

              <!-- CARA TRASERA -->
              <div class="card__back">
                <div class="card__content">
                  <h3 class="card__title"><?php echo esc_html($servicio['nombre']); ?></h3>

                  <?php if (!empty($servicio['precio']) && $servicio['precio'] !== '0.00') : ?>
                    <div class="card__price-section">
                      <div class="card__label">Precio</div>
                      <div class="card__price">€<?php echo esc_html($servicio['precio']); ?></div>
                    </div>
                  <?php endif; ?>

                  <?php if (!empty($servicio['duracion']) && $servicio['duracion'] !== 'No especificada') : ?>
                    <div class="card__duration-section">
                      <div class="card__label">Duración</div>
                      <div class="card__duration"><?php echo esc_html($servicio['duracion']); ?></div>
                    </div>
                  <?php endif; ?>

                  <?php if ((empty($servicio['precio']) || $servicio['precio'] === '0.00') && 
                            (empty($servicio['duracion']) || $servicio['duracion'] === 'No especificada')) : ?>
                    <div class="card__no-info">
                      <div>Información</div>
                      <div>disponible próximamente</div>
                    </div>
                  <?php endif; ?>

                  <a href="<?php echo home_url('/reservas/'); ?>" class="btn btn--primary">Reservar</a>
                  <div class="card__hint">Clic para volver</div>
                </div>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php else : ?>
      <p>No hay servicios disponibles actualmente.</p>
    <?php endif; ?>
  </div>
</section>