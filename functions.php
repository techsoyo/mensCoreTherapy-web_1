<?php
/**
 * MensCoreTherapy Functions and Definitions
 *
 * Theme functions and definitions file
 *
 * @package MensCoreTherapy
 * @version 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Constants
 */
define('MENSCORETHERAPY_VERSION', '1.0.0');
define('MENSCORETHERAPY_THEME_DIR', get_template_directory());
define('MENSCORETHERAPY_THEME_URI', get_template_directory_uri());

// =====================================================
// THEME SETUP
// =====================================================

/**
 * Sets up theme defaults and registers support for various WordPress features
 */
function menscoretherapy_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain('menscoretherapy', MENSCORETHERAPY_THEME_DIR . '/languages');

    // Add theme support
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'menscoretherapy'),
        'footer'  => __('Menú del Pie de Página', 'menscoretherapy'),
        'legal'   => __('Menú Legal', 'menscoretherapy')
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'menscoretherapy_theme_setup');

// =====================================================
// THEME CUSTOMIZER
// =====================================================

/**
 * Register customizer sections and settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object
 */
function menscoretherapy_customize_register($wp_customize) {
    
    // ===== CONTACT INFORMATION SECTION =====
    $wp_customize->add_section('menscoretherapy_contact_info', array(
        'title'       => __('Información de Contacto', 'menscoretherapy'),
        'description' => __('Configura la información de contacto que aparecerá en todo el sitio web.', 'menscoretherapy'),
        'priority'    => 30,
    ));

    // Phone
    $wp_customize->add_setting('menscoretherapy_phone', array(
        'default'           => '+34 666 777 888',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_phone', array(
        'label'       => __('Teléfono', 'menscoretherapy'),
        'description' => __('Número de teléfono principal del negocio.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_contact_info',
        'type'        => 'tel',
        'priority'    => 10,
    ));

    // Email
    $wp_customize->add_setting('menscoretherapy_email', array(
        'default'           => 'info@masajes.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_email', array(
        'label'       => __('Email', 'menscoretherapy'),
        'description' => __('Dirección de email principal del negocio.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_contact_info',
        'type'        => 'email',
        'priority'    => 20,
    ));

    // Address
    $wp_customize->add_setting('menscoretherapy_address', array(
        'default'           => 'Barcelona, España',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_address', array(
        'label'       => __('Dirección', 'menscoretherapy'),
        'description' => __('Dirección física del negocio.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_contact_info',
        'type'        => 'text',
        'priority'    => 30,
    ));

    // ===== BUSINESS HOURS SECTION =====
    $wp_customize->add_section('menscoretherapy_business_hours', array(
        'title'       => __('Horarios de Atención', 'menscoretherapy'),
        'description' => __('Configura los horarios de atención del negocio.', 'menscoretherapy'),
        'priority'    => 31,
    ));

    // General hours (for footer)
    $wp_customize->add_setting('menscoretherapy_hours_general', array(
        'default'           => 'Lun-Dom: 10:00-22:00',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_hours_general', array(
        'label'       => __('Horarios Generales', 'menscoretherapy'),
        'description' => __('Horarios resumidos para mostrar en el footer.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_business_hours',
        'type'        => 'text',
        'priority'    => 10,
    ));

    // Detailed hours (for contact pages)
    $wp_customize->add_setting('menscoretherapy_hours_detailed', array(
        'default'           => "Lunes a Viernes: 9:00 - 21:00\nSábados: 10:00 - 18:00\nDomingos: Cerrado",
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_hours_detailed', array(
        'label'       => __('Horarios Detallados', 'menscoretherapy'),
        'description' => __('Horarios completos para páginas de contacto y reservas. Usa saltos de línea para separar días.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_business_hours',
        'type'        => 'textarea',
        'priority'    => 20,
    ));

    // Booking hours
    $wp_customize->add_setting('menscoretherapy_hours_reservas', array(
        'default'           => "Lunes a Viernes: 9:00 - 21:00\nSábados: 10:00 - 18:00",
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_hours_reservas', array(
        'label'       => __('Horarios de Reservas', 'menscoretherapy'),
        'description' => __('Horarios disponibles para reservas.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_business_hours',
        'type'        => 'textarea',
        'priority'    => 30,
    ));

    // ===== BUSINESS POLICIES SECTION =====
    $wp_customize->add_section('menscoretherapy_business_policies', array(
        'title'       => __('Políticas del Negocio', 'menscoretherapy'),
        'description' => __('Configura las políticas y términos del negocio.', 'menscoretherapy'),
        'priority'    => 32,
    ));

    // Cancellation policy
    $wp_customize->add_setting('menscoretherapy_cancellation_policy', array(
        'default'           => 'Cancela hasta 24h antes sin costo',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_cancellation_policy', array(
        'label'       => __('Política de Cancelación', 'menscoretherapy'),
        'description' => __('Política de cancelación para reservas.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_business_policies',
        'type'        => 'text',
        'priority'    => 10,
    ));

    // Confirmation time
    $wp_customize->add_setting('menscoretherapy_confirmation_time', array(
        'default'           => 'Te confirmaremos tu cita en menos de 2 horas',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_confirmation_time', array(
        'label'       => __('Tiempo de Confirmación', 'menscoretherapy'),
        'description' => __('Tiempo estimado para confirmar reservas.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_business_policies',
        'type'        => 'text',
        'priority'    => 20,
    ));

    // Payment methods
    $wp_customize->add_setting('menscoretherapy_payment_methods', array(
        'default'           => 'Efectivo, tarjeta o transferencia',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_payment_methods', array(
        'label'       => __('Formas de Pago', 'menscoretherapy'),
        'description' => __('Métodos de pago aceptados.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_business_policies',
        'type'        => 'text',
        'priority'    => 30,
    ));

    // ===== SOCIAL MEDIA SECTION =====
    $wp_customize->add_section('menscoretherapy_social_media', array(
        'title'       => __('Redes Sociales', 'menscoretherapy'),
        'description' => __('Configura los enlaces a redes sociales.', 'menscoretherapy'),
        'priority'    => 33,
    ));

    // Facebook
    $wp_customize->add_setting('menscoretherapy_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_facebook', array(
        'label'       => __('Facebook', 'menscoretherapy'),
        'description' => __('URL completa de la página de Facebook.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_social_media',
        'type'        => 'url',
        'priority'    => 10,
    ));

    // Instagram
    $wp_customize->add_setting('menscoretherapy_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_instagram', array(
        'label'       => __('Instagram', 'menscoretherapy'),
        'description' => __('URL completa del perfil de Instagram.', 'menscoretherapy'),
        'section'     => 'menscoretherapy_social_media',
        'type'        => 'url',
        'priority'    => 20,
    ));

    // WhatsApp
    $wp_customize->add_setting('menscoretherapy_whatsapp', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('menscoretherapy_whatsapp', array(
        'label'       => __('WhatsApp', 'menscoretherapy'),
        'description' => __('Número de WhatsApp (formato: +34666777888).', 'menscoretherapy'),
        'section'     => 'menscoretherapy_social_media',
        'type'        => 'text',
        'priority'    => 30,
    ));
}
add_action('customize_register', 'menscoretherapy_customize_register');

/**
 * Helper function to get contact info from customizer
 *
 * @param string $field   Field name
 * @param string $default Default value
 * @return mixed
 */
function menscoretherapy_get_contact_info($field, $default = '') {
    $theme_mods = array(
        'phone'               => 'menscoretherapy_phone',
        'email'               => 'menscoretherapy_email',
        'address'             => 'menscoretherapy_address',
        'hours_general'       => 'menscoretherapy_hours_general',
        'hours_detailed'      => 'menscoretherapy_hours_detailed',
        'hours_reservas'      => 'menscoretherapy_hours_reservas',
        'cancellation_policy' => 'menscoretherapy_cancellation_policy',
        'confirmation_time'   => 'menscoretherapy_confirmation_time',
        'payment_methods'     => 'menscoretherapy_payment_methods',
        'facebook'            => 'menscoretherapy_facebook',
        'instagram'           => 'menscoretherapy_instagram',
        'whatsapp'            => 'menscoretherapy_whatsapp',
    );

    if (isset($theme_mods[$field])) {
        return get_theme_mod($theme_mods[$field], $default);
    }

    return $default;
}

// =====================================================
// ENQUEUE SCRIPTS AND STYLES
// =====================================================

/**
 * Enqueue global scripts and styles
 */
function menscoretherapy_enqueue_scripts() {
    // Font Awesome 6 CDN
    wp_enqueue_style('font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        array(),
        '6.5.0'
    );

    // Theme stylesheet
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_uri(),
        array(),
        MENSCORETHERAPY_VERSION
    );

    // Main CSS
    wp_enqueue_style(
        'main-css',
        MENSCORETHERAPY_THEME_URI . '/assets/css/_main.css',
        array(),
        filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/css/_main.css')
    );

    // Main JavaScript
    wp_enqueue_script(
        'theme-script',
        MENSCORETHERAPY_THEME_URI . '/assets/js/main.js',
        array('jquery'),
        filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/js/main.js'),
        true
    );

    // Localize script for AJAX
    wp_localize_script('theme-script', 'menscoretherapyData', array(
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('menscoretherapy_nonce'),
        'homeUrl'   => home_url('/'),
        'themeUri'  => MENSCORETHERAPY_THEME_URI
    ));
}
add_action('wp_enqueue_scripts', 'menscoretherapy_enqueue_scripts');

/**
 * Enqueue page-specific scripts and styles
 */
function menscoretherapy_enqueue_page_scripts() {
    // Masajes page
    if (is_page('masajes')) {
        wp_enqueue_style(
            'masajes-css',
            MENSCORETHERAPY_THEME_URI . '/assets/css/pages/_masajes.css',
            array('main-css'),
            filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/css/pages/_masajes.css')
        );
        
        wp_enqueue_script(
            'masajes-js',
            MENSCORETHERAPY_THEME_URI . '/assets/js/masajes.js',
            array('jquery', 'theme-script'),
            filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/js/masajes.js'),
            true
        );
        
        wp_localize_script('masajes-js', 'masajesData', array(
            'reservasUrl' => esc_url(home_url('/reservas/'))
        ));
    }

    // Reservas page
    if (is_page('reservas')) {
        wp_enqueue_style(
            'reservas-css',
            MENSCORETHERAPY_THEME_URI . '/assets/css/reservas.css',
            array('main-css'),
            filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/css/reservas.css')
        );
        
        wp_enqueue_script(
            'reservas-js',
            MENSCORETHERAPY_THEME_URI . '/assets/js/reservas.js',
            array('jquery', 'theme-script'),
            filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/js/reservas.js'),
            true
        );
    }

    // Contacto page
    if (is_page('contacto')) {
        wp_enqueue_style(
            'contacto-css',
            MENSCORETHERAPY_THEME_URI . '/assets/css/contacto.css',
            array('main-css'),
            filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/css/contacto.css')
        );
        
        wp_enqueue_script(
            'contacto-js',
            MENSCORETHERAPY_THEME_URI . '/assets/js/contacto.js',
            array('jquery', 'theme-script'),
            filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/js/contacto.js'),
            true
        );
    }

    // Productos page
    if (is_page('nuestros-productos') || is_page('productos')) {
        wp_enqueue_script(
            'productos-flip',
            MENSCORETHERAPY_THEME_URI . '/assets/js/productos.js',
            array('jquery'),
            filemtime(MENSCORETHERAPY_THEME_DIR . '/assets/js/productos.js'),
            true
        );
    }

    // Páginas legales
    if (is_page(array('aviso-legal', 'politica-de-privacidad', 'politica-de-cookies', 'condiciones-de-uso'))) {
        wp_enqueue_style('legal-page-css', get_template_directory_uri() . '/assets/css/pages/legal-page.css', array(), '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'menscoretherapy_enqueue_page_scripts');

/**
 * Preload critical assets for performance
 */
function menscoretherapy_preload_assets() {
    // Preload Font Awesome
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    
    // Preload logo
    $logo_path = MENSCORETHERAPY_THEME_URI . '/assets/images/logo-sin-fondo.webp';
    if (file_exists(MENSCORETHERAPY_THEME_DIR . '/assets/images/logo-sin-fondo.webp')) {
        echo '<link rel="preload" href="' . esc_url($logo_path) . '" as="image">' . "\n";
    }
}
add_action('wp_head', 'menscoretherapy_preload_assets', 1);

// =====================================================
// CUSTOM POST TYPES
// =====================================================

/**
 * Register Producto custom post type
 */
function menscoretherapy_register_producto_post_type() {
    $labels = array(
        'name'               => __('Productos', 'menscoretherapy'),
        'singular_name'      => __('Producto', 'menscoretherapy'),
        'menu_name'          => __('Productos', 'menscoretherapy'),
        'add_new'            => __('Añadir Nuevo', 'menscoretherapy'),
        'add_new_item'       => __('Añadir Nuevo Producto', 'menscoretherapy'),
        'edit_item'          => __('Editar Producto', 'menscoretherapy'),
        'new_item'           => __('Nuevo Producto', 'menscoretherapy'),
        'view_item'          => __('Ver Producto', 'menscoretherapy'),
        'search_items'       => __('Buscar Productos', 'menscoretherapy'),
        'not_found'          => __('No se encontraron productos', 'menscoretherapy'),
        'not_found_in_trash' => __('No hay productos en la papelera', 'menscoretherapy'),
        'all_items'          => __('Todos los Productos', 'menscoretherapy'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'producto'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('producto', $args);
}
add_action('init', 'menscoretherapy_register_producto_post_type');

/**
 * Register Masaje custom post type
 */
function menscoretherapy_register_masaje_post_type() {
    $labels = array(
        'name'               => __('Masajes', 'menscoretherapy'),
        'singular_name'      => __('Masaje', 'menscoretherapy'),
        'menu_name'          => __('Masajes', 'menscoretherapy'),
        'add_new'            => __('Añadir Nuevo', 'menscoretherapy'),
        'add_new_item'       => __('Añadir Nuevo Masaje', 'menscoretherapy'),
        'edit_item'          => __('Editar Masaje', 'menscoretherapy'),
        'new_item'           => __('Nuevo Masaje', 'menscoretherapy'),
        'view_item'          => __('Ver Masaje', 'menscoretherapy'),
        'search_items'       => __('Buscar Masajes', 'menscoretherapy'),
        'not_found'          => __('No se encontraron masajes', 'menscoretherapy'),
        'not_found_in_trash' => __('No hay masajes en la papelera', 'menscoretherapy'),
        'all_items'          => __('Todos los Masajes', 'menscoretherapy'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'masaje'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('masaje', $args);
}
add_action('init', 'menscoretherapy_register_masaje_post_type');

// =====================================================
// META BOXES
// =====================================================

/**
 * Add meta boxes for Producto post type
 */
function menscoretherapy_add_producto_meta_boxes() {
    add_meta_box(
        'producto_detalles',
        __('Detalles del Producto', 'menscoretherapy'),
        'menscoretherapy_producto_meta_box_callback',
        'producto',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'menscoretherapy_add_producto_meta_boxes');

/**
 * Producto meta box callback
 *
 * @param WP_Post $post Current post object
 */
function menscoretherapy_producto_meta_box_callback($post) {
    wp_nonce_field('menscoretherapy_save_producto_meta', 'producto_meta_nonce');

    $precio     = get_post_meta($post->ID, '_producto_precio', true);
    $icono      = get_post_meta($post->ID, '_producto_icono', true);
    $beneficios = get_post_meta($post->ID, '_producto_beneficios', true);
    ?>
    <div style="padding: 15px 0;">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row" style="width: 200px;">
                        <label for="producto_precio">
                            <strong><?php esc_html_e('Precio (€):', 'menscoretherapy'); ?></strong>
                        </label>
                    </th>
                    <td>
                        <input type="text"
                               id="producto_precio"
                               name="producto_precio"
                               value="<?php echo esc_attr($precio); ?>"
                               style="width: 200px;"
                               placeholder="<?php esc_attr_e('Ej: 29,99', 'menscoretherapy'); ?>" />
                    </td>
                </tr>

                <tr>
                    <th scope="row" style="vertical-align: top; padding-top: 10px;">
                        <label for="producto_icono">
                            <strong><?php esc_html_e('Icono (Font Awesome):', 'menscoretherapy'); ?></strong>
                        </label>
                    </th>
                    <td>
                        <input type="text"
                               id="producto_icono"
                               name="producto_icono"
                               value="<?php echo esc_attr($icono); ?>"
                               style="width: 100%; max-width: 400px;"
                               placeholder="<?php esc_attr_e('Ej: fa-solid fa-droplet', 'menscoretherapy'); ?>" />
                        <p class="description">
                            <?php esc_html_e('Visita', 'menscoretherapy'); ?>
                            <a href="https://fontawesome.com/icons" target="_blank" rel="noopener noreferrer">FontAwesome</a>
                            <?php esc_html_e('para ver los iconos disponibles', 'menscoretherapy'); ?>
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row" style="vertical-align: top; padding-top: 10px;">
                        <label for="producto_beneficios">
                            <strong><?php esc_html_e('Beneficios:', 'menscoretherapy'); ?></strong>
                        </label>
                    </th>
                    <td>
                        <textarea id="producto_beneficios"
                                  name="producto_beneficios"
                                  style="width: 100%; max-width: 500px; height: 150px;"
                                  placeholder="<?php esc_attr_e('Ingresa un beneficio por línea', 'menscoretherapy'); ?>"><?php echo esc_textarea($beneficios); ?></textarea>
                        <p class="description">
                            <?php esc_html_e('Escribe un beneficio por línea. Se mostrarán como lista en la card.', 'menscoretherapy'); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 20px; padding: 15px; background: #f0f6fc; border-left: 4px solid #0073aa; border-radius: 4px;">
            <p style="margin: 0;">
                <strong>ℹ️ <?php esc_html_e('Nota:', 'menscoretherapy'); ?></strong>
                <?php esc_html_e('Estos campos se mostrarán en la parte trasera de la card cuando el usuario haga hover sobre el producto.', 'menscoretherapy'); ?>
            </p>
        </div>
    </div>
    <?php
}

/**
 * Save Producto meta box data
 *
 * @param int $post_id Post ID
 */
function menscoretherapy_save_producto_meta($post_id) {
    // Verify nonce
    if (!isset($_POST['producto_meta_nonce']) || !wp_verify_nonce($_POST['producto_meta_nonce'], 'menscoretherapy_save_producto_meta')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    $campos = array(
        'producto_precio'     => 'sanitize_text_field',
        'producto_icono'      => 'sanitize_text_field',
        'producto_beneficios' => 'sanitize_textarea_field'
    );

    foreach ($campos as $campo => $sanitize_function) {
        if (isset($_POST[$campo])) {
            $valor = call_user_func($sanitize_function, $_POST[$campo]);
            update_post_meta($post_id, '_' . $campo, $valor);
        }
    }
}
add_action('save_post_producto', 'menscoretherapy_save_producto_meta');

/**
 * Add meta boxes for Masaje post type
 */
function menscoretherapy_add_masaje_meta_boxes() {
    add_meta_box(
        'masaje_detalles',
        __('Detalles del Masaje', 'menscoretherapy'),
        'menscoretherapy_masaje_meta_box_callback',
        'masaje',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'menscoretherapy_add_masaje_meta_boxes');

/**
 * Masaje meta box callback
 *
 * @param WP_Post $post Current post object
 */
function menscoretherapy_masaje_meta_box_callback($post) {
    wp_nonce_field('menscoretherapy_save_masaje_meta', 'masaje_meta_nonce');

    $precio    = get_post_meta($post->ID, '_masaje_precio', true);
    $duracion  = get_post_meta($post->ID, '_masaje_duracion', true);
    $extras    = get_post_meta($post->ID, '_masaje_extras', true);
    $categoria = get_post_meta($post->ID, '_masaje_categoria', true);
    ?>
    <div style="padding: 15px 0;">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row" style="width: 200px;">
                        <label for="masaje_precio">
                            <strong><?php esc_html_e('Precio (€):', 'menscoretherapy'); ?></strong>
                        </label>
                    </th>
                    <td>
                        <input type="text"
                               id="masaje_precio"
                               name="masaje_precio"
                               value="<?php echo esc_attr($precio); ?>"
                               style="width: 200px;"
                               placeholder="<?php esc_attr_e('Ej: 45,00€', 'menscoretherapy'); ?>" />
                    </td>
                </tr>

                <tr>
                    <th scope="row" style="vertical-align: top; padding-top: 10px;">
                        <label for="masaje_duracion">
                            <strong><?php esc_html_e('Duración:', 'menscoretherapy'); ?></strong>
                        </label>
                    </th>
                    <td>
                        <input type="text"
                               id="masaje_duracion"
                               name="masaje_duracion"
                               value="<?php echo esc_attr($duracion); ?>"
                               style="width: 200px;"
                               placeholder="<?php esc_attr_e('Ej: 60 minutos', 'menscoretherapy'); ?>" />
                    </td>
                </tr>

                <tr>
                    <th scope="row" style="vertical-align: top; padding-top: 10px;">
                        <label for="masaje_extras">
                            <strong><?php esc_html_e('Incluye/Extras:', 'menscoretherapy'); ?></strong>
                        </label>
                    </th>
                    <td>
                        <textarea id="masaje_extras"
                                  name="masaje_extras"
                                  style="width: 100%; max-width: 500px; height: 100px;"
                                  placeholder="<?php esc_attr_e('Ej: Consulta inicial incluida, Aromaterapia, etc.', 'menscoretherapy'); ?>"><?php echo esc_textarea($extras); ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th scope="row" style="vertical-align: top; padding-top: 10px;">
                        <label for="masaje_categoria">
                            <strong><?php esc_html_e('Categoría:', 'menscoretherapy'); ?></strong>
                        </label>
                    </th>
                    <td>
                        <select id="masaje_categoria" name="masaje_categoria" style="width: 200px;">
                            <option value="terapeutico" <?php selected($categoria, 'terapeutico'); ?>>
                                <?php esc_html_e('Terapéutico', 'menscoretherapy'); ?>
                            </option>
                            <option value="relajante" <?php selected($categoria, 'relajante'); ?>>
                                <?php esc_html_e('Relajante', 'menscoretherapy'); ?>
                            </option>
                            <option value="deportivo" <?php selected($categoria, 'deportivo'); ?>>
                                <?php esc_html_e('Deportivo', 'menscoretherapy'); ?>
                            </option>
                            <option value="prenatal" <?php selected($categoria, 'prenatal'); ?>>
                                <?php esc_html_e('Prenatal', 'menscoretherapy'); ?>
                            </option>
                            <option value="hot-stone" <?php selected($categoria, 'hot-stone'); ?>>
                                <?php esc_html_e('Piedras Calientes', 'menscoretherapy'); ?>
                            </option>
                            <option value="especial" <?php selected($categoria, 'especial'); ?>>
                                <?php esc_html_e('Especial', 'menscoretherapy'); ?>
                            </option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 20px; padding: 15px; background: #f0f6fc; border-left: 4px solid #0073aa; border-radius: 4px;">
            <p style="margin: 0;">
                <strong>ℹ️ <?php esc_html_e('Nota:', 'menscoretherapy'); ?></strong>
                <?php esc_html_e('Estos campos se mostrarán en las cards de masajes. La descripción principal se ingresa en el editor de contenido arriba.', 'menscoretherapy'); ?>
            </p>
        </div>
    </div>
    <?php
}

/**
 * Save Masaje meta box data
 *
 * @param int $post_id Post ID
 */
function menscoretherapy_save_masaje_meta($post_id) {
    // Verify nonce
    if (!isset($_POST['masaje_meta_nonce']) || !wp_verify_nonce($_POST['masaje_meta_nonce'], 'menscoretherapy_save_masaje_meta')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    $campos = array(
        'masaje_precio'    => 'sanitize_text_field',
        'masaje_duracion'  => 'sanitize_text_field',
        'masaje_extras'    => 'sanitize_textarea_field',
        'masaje_categoria' => 'sanitize_text_field'
    );

    foreach ($campos as $campo => $sanitize_function) {
        if (isset($_POST[$campo])) {
            $valor = call_user_func($sanitize_function, $_POST[$campo]);
            update_post_meta($post_id, '_' . $campo, $valor);
        }
    }
}
add_action('save_post_masaje', 'menscoretherapy_save_masaje_meta');

// =====================================================
// PERFORMANCE OPTIMIZATIONS
// =====================================================

/**
 * Optimize queries for custom post types
 *
 * @param WP_Query $query The WP_Query instance
 */
function menscoretherapy_optimize_custom_post_queries($query) {
    // Only run on frontend main queries
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    // Optimize producto and masaje queries
    if (in_array($query->get('post_type'), array('producto', 'masaje'))) {
        // Disable unnecessary counting queries
        $query->set('no_found_rows', true);
        
        // Disable post meta cache if not needed
        if (!$query->get('meta_query')) {
            $query->set('update_post_meta_cache', false);
        }
        
        // Disable term cache if not needed
        if (!$query->get('tax_query')) {
            $query->set('update_post_term_cache', false);
        }
    }
}
add_action('pre_get_posts', 'menscoretherapy_optimize_custom_post_queries');

/**
 * Add lazy loading to images
 *
 * @param string $content Post content
 * @return string Modified content
 */
function menscoretherapy_add_lazy_loading($content) {
    // Skip in admin
    if (is_admin()) {
        return $content;
    }

    // Add loading="lazy" to img tags that don't already have it
    $content = preg_replace(
        '/<img(?![^>]*loading=)([^>]+)>/i',
        '<img loading="lazy"$1>',
        $content
    );

    return $content;
}
add_filter('the_content', 'menscoretherapy_add_lazy_loading', 20);
add_filter('post_thumbnail_html', 'menscoretherapy_add_lazy_loading', 20);
add_filter('widget_text', 'menscoretherapy_add_lazy_loading', 20);

/**
 * Disable emojis for better performance
 */
function menscoretherapy_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'menscoretherapy_disable_emojis');

/**
 * Remove query strings from static resources
 *
 * @param string $src Resource URL
 * @return string Modified URL
 */
function menscoretherapy_remove_query_strings($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'menscoretherapy_remove_query_strings', 15);
add_filter('style_loader_src', 'menscoretherapy_remove_query_strings', 15);

// =====================================================
// THEME ACTIVATION
// =====================================================

/**
 * Flush rewrite rules on theme activation
 */
function menscoretherapy_flush_rewrite_rules() {
    // Register custom post types
    menscoretherapy_register_producto_post_type();
    menscoretherapy_register_masaje_post_type();
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'menscoretherapy_flush_rewrite_rules');

/**
 * Theme deactivation cleanup
 */
function menscoretherapy_theme_deactivation() {
    // Flush rewrite rules
    flush_rewrite_rules();
}
add_action('switch_theme', 'menscoretherapy_theme_deactivation');