<?php

/**
 * Footer template
 * 
 * @package MensCoreTherapy
 */

if (!defined('ABSPATH')) exit;
?>

<footer id="site-footer" class="footer" role="contentinfo">
    <div class="footer__bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/fonde-header.webp');"></div>
    <div class="footer__overlay"></div>

    <div class="footer__content">
        <div class="footer-container">
            <div class="footer__inner">

                <!-- Columna 1: Logo -->
                <div class="footer__logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?> - Inicio">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-sin-fondo.webp"
                            alt="<?php bloginfo('name'); ?>"
                            class="footer__logo-img"
                            width="100"
                            height="67"
                            loading="lazy">
                    </a>
                </div>

                <!-- Columna 2: Textos Legales -->
                <div class="footer__legal">
                    <h4 class="footer__section-title">Textos Legales - Condiciones de uso y Políticas</h4>
                    <?php
                    if (has_nav_menu('legal')) {
                        wp_nav_menu(array(
                            'theme_location' => 'legal',
                            'menu_class'     => 'footer__legal-menu',
                            'container'      => 'nav',
                            'container_class' => 'footer__legal-nav',
                            'depth'          => 1,
                            'fallback_cb'    => false
                        ));
                    } else {
                        // Fallback si no hay menú asignado
                        echo '<nav class="footer__legal-nav">';
                        echo '<ul class="footer__legal-menu">';

                        // Buscar páginas comunes de textos legales
                        $legal_pages = array(
                            'aviso-legal',
                            'politica-de-privacidad',
                            'politica-de-cookies',
                            'condiciones-de-uso'
                        );

                        foreach ($legal_pages as $slug) {
                            $page = get_page_by_path($slug);
                            if ($page) {
                                printf(
                                    '<li><a href="%s">%s</a></li>',
                                    esc_url(get_permalink($page->ID)),
                                    esc_html($page->post_title)
                                );
                            }
                        }

                        echo '</ul>';
                        echo '</nav>';
                    }
                    ?>
                </div>

                <!-- Columna 3: Información de contacto -->
                <div class="footer__contact">
                    <h4 class="footer__section-title">Contacto</h4>
                    <div class="footer__contact-grid">
                        <div class="footer__contact-item">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <a href="tel:+34666777888">+34 666 777 888</a>
                        </div>
                        <div class="footer__contact-item">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <a href="mailto:info@masajes.com">info@masajes.com</a>
                        </div>
                        <div class="footer__contact-item">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>Barcelona, España</span>
                        </div>
                        <div class="footer__contact-item">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span>Lun-Dom: 10:00-22:00</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer__copyright">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> Men's Core Therapy. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>