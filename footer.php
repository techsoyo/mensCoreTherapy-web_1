<!-- Footer con nueva estructura CSS ITCSS -->
<footer id="site-footer" class="footer" role="contentinfo">
    <div class="footer__bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/fonde-header.webp');"></div>
    <div class="footer__overlay"></div>

    <!-- Contenido principal del footer -->
    <div class="footer__content">
        <div class="footer-container">
            <div class="footer__inner grid grid--3-cols gap-lg align-center">

                <!-- Columna 1: Logo -->
                <div class="footer__logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-sin-fondo.webp"
                        alt="<?php bloginfo('name'); ?> - Centro de masajes masculinos en Barcelona"
                        class="footer__logo-img"
                        width="100"
                        height="67"
                        loading="lazy">
                </div>

                <!-- Columna 2: Botones de acción -->
                <div class="footer__actions text-center">
                    <h4 class="footer__section-title text-white mb-sm">
                        <?php _e('Reservar', 'menscoretherapy'); ?>
                    </h4>
                    <!-- Botón de WhatsApp (justo después del </form> o junto al botón de submit) -->
                    <div class="whatsapp-reserva-option">
                        <p>¿Prefieres reservar por WhatsApp?</p>
                        <a
                            href="https://wa.me/34123456789?text=<?php echo urlencode(
                                                                        "Hola, quiero reservar desde la web. Mis datos son:\n" .
                                                                            "- Nombre: [Tu nombre]\n" .
                                                                            "- Producto: " . (isset($_GET['producto']) ? urldecode($_GET['producto']) : 'No especificado') . "\n" .
                                                                            "- Día: [Día]\n" .
                                                                            "- Hora: [Hora]\n" .
                                                                            "- Email: [Tu email]"
                                                                    ); ?>"
                            class="btn-whatsapp-reserva"
                            target="_blank"
                            rel="noopener noreferrer">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" />
                                <path d="M8 10L12 14L16 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Reservar por WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Columna 3: Información de contactos -->
                <div class="footer__contact">
                    <h4 class="footer__section-title text-white mb-sm">
                        <?php _e('contactos', 'menscoretherapy'); ?>
                    </h4>

                    <div class="footer__contact-grid grid grid--2-cols gap-md text-sm">
                        <!-- Columna izquierda -->
                        <div class="footer__contact-col">
                            <div class="footer__contact-item flex flex--start gap-xs mb-xs">
                                <i class="fa fa-phone text-primary"></i>
                                <span class="text-white">+34 666 777 888</span>
                            </div>
                            <div class="footer__contact-item flex flex--start gap-xs">
                                <i class="fa fa-envelope text-primary"></i>
                                <span class="text-white">info@masajes.com</span>
                            </div>
                        </div>

                        <!-- Columna derecha -->
                        <div class="footer__contact-col">
                            <div class="footer__contact-item flex flex--start gap-xs mb-xs">
                                <i class="fa fa-map-marker text-primary"></i>
                                <span class="text-white">Barcelona, España</span>
                            </div>
                            <div class="footer__contact-item flex flex--start gap-xs">
                                <i class="fa fa-clock-o text-primary"></i>
                                <span class="text-white">Lun-Dom: 10:00-22:00</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer__copyright">
        <div class="footer-container">
            <div class="text-center text-white text-xs py-sm">
                <p class="mb-0">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                    <?php _e('Todos los derechos reservados.', 'menscoretherapy'); ?>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>