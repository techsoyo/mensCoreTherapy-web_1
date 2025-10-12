<?php if (!defined("ABSPATH")) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo("charset"); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- SEO Meta Tags Optimizados -->
  <?php
  // Generar title dinámico optimizado
  if (is_front_page()) {
    $seo_title = get_bloginfo('name') . ' - ' . get_bloginfo('description');
    $seo_description = get_theme_mod('seo_home_description', 'Servicios profesionales de masajes masculinos en Barcelona. Relajación, bienestar y terapias personalizadas para hombres. Reserva tu sesión de masaje terapéutico.');
  } elseif (is_page_template('page-servicios.php')) {
    $seo_title = 'Servicios de Masajes Masculinos - ' . get_bloginfo('name');
    $seo_description = 'Descubre nuestros servicios profesionales de masajes para hombres: relajante, deportivo, terapéutico y descontracturante. Técnicas especializadas para tu bienestar.';
  } elseif (is_page_template('page-productos.php')) {
    $seo_title = 'Productos de Bienestar - ' . get_bloginfo('name');
    $seo_description = 'Productos premium para masajes y bienestar masculino. Aceites esenciales, cremas terapéuticas y accesorios profesionales de alta calidad.';
  } elseif (is_page_template('page-contactos.php')) {
    $seo_title = 'contactos - ' . get_bloginfo('name');
    $seo_description = 'Contáctanos para reservar tu sesión de masaje masculino en Barcelona. Atención personalizada y profesional. ¡Te esperamos!';
  } elseif (is_page_template('page-reservas.php')) {
    $seo_title = 'Reservar Masaje - ' . get_bloginfo('name');
    $seo_description = 'Reserva tu sesión de masaje masculino online. Elige fecha, hora y tipo de servicio. Sistema de reservas fácil y seguro.';
  } elseif (is_single() || is_page()) {
    $custom_title = get_post_meta(get_the_ID(), '_seo_title', true);
    $seo_title = $custom_title ? $custom_title : get_the_title() . ' - ' . get_bloginfo('name');
    $custom_description = get_post_meta(get_the_ID(), '_seo_description', true);
    $seo_description = $custom_description ? $custom_description : wp_trim_words(get_the_excerpt() ?: get_the_content(), 25, '...');
  } else {
    $seo_title = wp_title('|', false, 'right') . get_bloginfo('name');
    $seo_description = get_bloginfo('description');
  }
  
  // Limpiar description
  $seo_description = wp_strip_all_tags($seo_description);
  $seo_description = str_replace(["\r", "\n", "\t"], ' ', $seo_description);
  $seo_description = trim(preg_replace('/\s+/', ' ', $seo_description));
  if (strlen($seo_description) > 160) {
    $seo_description = substr($seo_description, 0, 157) . '...';
  }
  ?>
  
  <title><?php echo esc_html($seo_title); ?></title>
  <meta name="description" content="<?php echo esc_attr($seo_description); ?>">
  <meta name="keywords" content="masajes masculinos, masaje para hombres, Barcelona, relajación, bienestar, terapia, descontracturante, deportivo">
  <meta name="author" content="<?php bloginfo('name'); ?>">
  <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  
  <!-- Canonical URL -->
  <link rel="canonical" href="<?php echo esc_url(get_permalink()); ?>">
  
  <!-- Open Graph Tags para Redes Sociales -->
  <meta property="og:title" content="<?php echo esc_attr($seo_title); ?>">
  <meta property="og:description" content="<?php echo esc_attr($seo_description); ?>">
  <meta property="og:type" content="<?php echo is_front_page() ? 'website' : (is_single() ? 'article' : 'website'); ?>">
  <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
  <meta property="og:locale" content="es_ES">
  <?php 
  // Imagen para Open Graph
  $og_image = '';
  if (has_post_thumbnail()) {
    $og_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
  } else {
    $og_image = get_template_directory_uri() . '/assets/images/logo-sin-fondo.webp';
  }
  ?>
  <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="<?php echo esc_attr($seo_title); ?>">
  
  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo esc_attr($seo_title); ?>">
  <meta name="twitter:description" content="<?php echo esc_attr($seo_description); ?>">
  <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
  <meta name="twitter:image:alt" content="<?php echo esc_attr($seo_title); ?>">
  
  <!-- Meta adicionales para Local Business -->
  <?php if (is_front_page() || is_page_template('page-contactos.php')) : ?>
  <meta name="geo.region" content="ES-CT">
  <meta name="geo.placename" content="Barcelona">
  <meta name="geo.position" content="41.3851;2.1734">
  <meta name="ICBM" content="41.3851, 2.1734">
  <?php endif; ?>
  
  <!-- Preload de recursos críticos -->
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/logo-sin-fondo.webp" as="image">
  
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <!-- Header con nueva estructura CSS ITCSS -->
  <header
    id="site-header"
    class="header header--fixed header--transparent"
    role="banner"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/fonde-header.webp');"
    aria-label="Navegación principal del sitio con imagen de fondo relajante">

    <!-- Overlay -->
    <div class="header__overlay" aria-hidden="true"></div>

    <!-- Skip to content para accesibilidad -->
    <a class="skip-link" href="#primary" tabindex="1">
      <?php esc_html_e("Saltar al contenido principal", "menscoretherapy"); ?>
    </a>

    <!-- Contenedor principal del header -->
    <div class="container">
      <div class="header__inner flex flex--between flex--center">

        <!-- Logo -->
        <div class="header__logo">
          <a href="<?php echo esc_url(home_url("/")); ?>"
            class="logo-link"
            aria-label="<?php bloginfo('name'); ?> - Ir a inicio">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-sin-fondo.webp"
              alt="<?php bloginfo('name'); ?> - Logotipo del centro de masajes masculinos"
              class="logo-img"
              width="120"
              height="80"
              loading="eager">
          </a>
        </div>

        <!-- Navegación principal -->
        <nav
          id="site-navigation"
          class="header__nav nav nav--primary"
          role="navigation"
          aria-label="<?php esc_attr_e("Menú principal", "menscoretherapy"); ?>">
          <?php
          if (has_nav_menu("primary")) {
            wp_nav_menu([
              "theme_location" => "primary",
              "container"      => false,
              "menu_class"     => "nav__list",
              "menu_id"        => "primary-menu",
              "fallback_cb"    => false
            ]);
          } else {
            // Menú de fallback con nueva estructura
            echo '<ul id="primary-menu" class="nav__list">';
            echo '<li class="nav__item"><a href="' . esc_url(home_url("/")) . '" class="nav__link">Inicio</a></li>';
            echo '<li class="nav__item"><a href="' . esc_url(home_url("/servicios/")) . '" class="nav__link">Servicios</a></li>';
            echo '<li class="nav__item"><a href="' . esc_url(home_url("/contactos/")) . '" class="nav__link">contactos</a></li>';
            echo '<li class="nav__item"><a href="' . esc_url(home_url("/reservas/")) . '" class="nav__link">Reservas</a></li>';
            echo '<li class="nav__item"><a href="' . esc_url(home_url("/productos/")) . '" class="nav__link">Nuestros Productos</a></li>';
            echo '</ul>';
          }
          ?>
        </nav>

        <!-- Botón hamburguesa para móvil -->
        <button
          class="header__toggle btn btn--icon btn--ghost mobile-only"
          aria-label="Abrir menú de navegación"
          aria-expanded="false"
          aria-controls="primary-menu"
          type="button">
          <span class="hamburger">
            <span class="hamburger__line"></span>
            <span class="hamburger__line"></span>
            <span class="hamburger__line"></span>
          </span>
          <span class="sr-only">Menú</span>
        </button>

      </div>
    </div>
  </header>