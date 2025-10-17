<?php if (!defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Header principal -->
    <header
        id="site-header"
        class="header header--fixed header--transparent"
        role="banner"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/fonde-header.webp'); ?>');"
        aria-label="<?php esc_attr_e('Navegación principal del sitio con imagen de fondo relajante', 'menscoretherapy'); ?>">

        <!-- Overlay decorativo -->
        <div class="header__overlay" aria-hidden="true"></div>

        <!-- Contenedor del header -->
        <div class="container">
            <div class="header__inner flex flex--between flex--center">

                <!-- Logo -->
                <div class="header__logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                        class="logo-link"
                        aria-label="<?php bloginfo('name'); ?> - Ir a inicio">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-sin-fondo.webp'); ?>"
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
                    aria-label="<?php esc_attr_e('Menú principal', 'menscoretherapy'); ?>">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'nav__list',
                            'menu_id'        => 'primary-menu',
                            'fallback_cb'    => false
                        ]);
                    } else {
                        // Menú de fallback con enlaces actualizados
                        echo '<ul id="primary-menu" class="nav__list">';
                        echo '<li class="nav__item"><a href="' . esc_url(home_url('/')) . '" class="nav__link">Inicio</a></li>';
                        echo '<li class="nav__item"><a href="' . esc_url(home_url('/productos/')) . '" class="nav__link">Productos</a></li>';
                        echo '<li class="nav__item"><a href="' . esc_url(home_url('/masajes/')) . '" class="nav__link">Masajes</a></li>';
                        echo '<li class="nav__item"><a href="' . esc_url(home_url('/reservas/')) . '" class="nav__link">Reservas</a></li>';
                        echo '<li class="nav__item"><a href="' . esc_url(home_url('/contacto/')) . '" class="nav__link">Contacto</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </nav>

                <!-- Botón hamburguesa (móvil) -->
                <button
                    class="header__toggle btn btn--icon btn--ghost mobile-only"
                    aria-label="<?php esc_attr_e('Abrir menú de navegación', 'menscoretherapy'); ?>"
                    aria-expanded="false"
                    aria-controls="primary-menu"
                    type="button">
                    <span class="hamburger">
                        <span class="hamburger__line"></span>
                        <span class="hamburger__line"></span>
                        <span class="hamburger__line"></span>
                    </span>
                    <span class="sr-only"><?php esc_html_e('Menú', 'menscoretherapy'); ?></span>
                </button>

            </div>
        </div>
    </header>