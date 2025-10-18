<?php

/**
 * Footer template - OPTIMIZED
 * 
 * @package MensCoreTherapy
 */

if (!defined('ABSPATH')) exit;
?>

<footer id="site-footer" class="footer" role="contentinfo">
    <div class="footer__bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/fonde-header.webp');"></div>
    <div class="footer__overlay"></div>

    <div class="footer__content footer-container">
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

            <!-- Columna 3: Información de contacto - DYNAMIC -->
            <div class="footer__contact">
                <h4 class="footer__section-title">Contacto</h4>
                <div class="footer__contact-grid">
                    <?php
                    $phone = menscoretherapy_get_contact_info('phone', '+34 666 777 888');
                    $email = menscoretherapy_get_contact_info('email', 'info@masajes.com');
                    $address = menscoretherapy_get_contact_info('address', 'Barcelona, España');
                    $hours = menscoretherapy_get_contact_info('hours_general', 'Lun-Dom: 10:00-22:00');
                    ?>

                    <?php if ($phone): ?>
                        <div class="footer__contact-item">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if ($email): ?>
                        <div class="footer__contact-item">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if ($address): ?>
                        <div class="footer__contact-item">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span><?php echo esc_html($address); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($hours): ?>
                        <div class="footer__contact-item">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span><?php echo esc_html($hours); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <?php
                // Redes sociales
                $facebook = menscoretherapy_get_contact_info('facebook');
                $instagram = menscoretherapy_get_contact_info('instagram');
                $whatsapp = menscoretherapy_get_contact_info('whatsapp');

                if ($facebook || $instagram || $whatsapp):
                ?>
                    <div class="footer__social">
                        <h5 class="footer__social-title">Síguenos</h5>
                        <div class="footer__social-links">
                            <?php if ($facebook): ?>
                                <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ($instagram): ?>
                                <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ($whatsapp): ?>
                                <a href="https://wa.me/<?php echo esc_attr(str_replace(array(' ', '+'), '', $whatsapp)); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Copyright -->
    <div class="footer__copyright footer-container">
        <p>&copy; <?php echo date('Y'); ?> Men's Core Therapy. Todos los derechos reservados.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>