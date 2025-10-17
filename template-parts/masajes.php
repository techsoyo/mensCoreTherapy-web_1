<?php
/* Template Name: Masajes - Versión Mejorada */
get_header();
?>

<main class="pagina-masajes masajes-container" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/torso.webp');">
  <h1 class="titulo-seccion">Nuestros Masajes Terapéuticos</h1>

  <div class="masajes-grid">
    <?php
    // Recuperar los masajes desde los campos personalizados (hasta 20 posibles)
    $masajes = array();
    for ($i = 1; $i <= 20; $i++) {
      $nombre = get_post_meta(get_the_ID(), "masaje_{$i}_nombre", true);
      $precio = get_post_meta(get_the_ID(), "masaje_{$i}_precio", true);
      $duracion = get_post_meta(get_the_ID(), "masaje_{$i}_duracion", true);
      $descripcion = get_post_meta(get_the_ID(), "masaje_{$i}_descripcion", true);

      if (!empty($nombre)) {
        $masajes[] = array(
          'nombre' => $nombre,
          'precio' => $precio,
          'duracion' => $duracion,
          'descripcion' => !empty($descripcion) ? $descripcion : 'Terapia especializada de masaje terapéutico.',
          'extras' => 'Consulta inicial incluida.',
          'categoria' => 'terapeutico'
        );
      }
    }

    // Mostrar las cards de masajes
    foreach ($masajes as $index => $masaje) :
      $clase_adicional = '';
      if ($masaje['categoria'] == 'especial') {
        $clase_adicional = 'destacado';
      }
      if (in_array($masaje['categoria'], array('prenatal', 'hot-stone'))) {
        $clase_adicional .= ' oferta';
      }
    ?>
      <div class="card-flip <?php echo $clase_adicional; ?>" data-index="<?php echo $index; ?>">
        <div class="card-inner">
          <!-- Cara frontal -->
          <div class="card-front">
            <h3><?php echo esc_html($masaje['nombre']); ?></h3>
            <p><?php echo esc_html($masaje['descripcion']); ?></p>
            <div class="card-badge">
              <span class="badge-type"><?php echo esc_html(ucfirst($masaje['categoria'])); ?></span>
            </div>
          </div>

          <!-- Cara trasera -->
          <div class="card-back">
            <h3><?php echo esc_html($masaje['nombre']); ?></h3>
            <p><strong>Precio:</strong> <?php echo esc_html($masaje['precio']); ?></p>
            <p><strong>Duración:</strong> <?php echo esc_html($masaje['duracion']); ?></p>
            <p><strong>Incluye:</strong> <?php echo esc_html($masaje['extras']); ?></p>
            <div class="card-actions">
              <button class="btn-reservar" onclick="reservarMasaje('<?php echo esc_js($masaje['nombre']); ?>')">
                Reservar Ahora
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Sección de información adicional -->
  <section class="info-adicional">
    <div class="info-grid">
      <div class="info-item">
        <h4>¿Qué incluye cada sesión?</h4>
        <ul>
          <li>Consulta inicial de valoración</li>
          <li>Tratamiento personalizado</li>
          <li>Ambientación con aromaterapia</li>
          <li>Recomendaciones post-tratamiento</li>
        </ul>
      </div>
      <div class="info-item">
        <h4>Política de cancelación</h4>
        <ul>
          <li>Cancelación gratuita hasta 24h antes</li>
          <li>Reprogramación flexible</li>
          <li>Garantía de satisfacción</li>
          <li>Pagos seguros y protegidos</li>
        </ul>
      </div>
    </div>
  </section>
</main>

<script>
  // Función para reservar masajes
  function reservarMasaje(nombreMasaje) {
    // Redirigir a la página de reservas con el masaje seleccionado
    window.location.href = '<?php echo esc_url(home_url('/reservas/')); ?>?masaje=' + encodeURIComponent(nombreMasaje);
  }

  // Animación de entrada para las cards
  function animateCardsOnScroll() {
    const cards = document.querySelectorAll('.card-flip');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add('animate-in');
          }, index * 100);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });

    cards.forEach(card => {
      observer.observe(card);
    });
  }

  // Inicializar animaciones cuando el DOM esté listo
  document.addEventListener('DOMContentLoaded', function() {
    animateCardsOnScroll();

    // Añadir efecto de parallax suave
    const cards = document.querySelectorAll('.card-flip');
    cards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
      });

      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
  });
</script>

<?php get_footer(); ?>