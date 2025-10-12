<?php if (!defined("ABSPATH")) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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