<?php

/**
 * Functions and definitions - OPTIMIZED
 * 
 * @package MensCoreTherapy
 */

if (!defined('ABSPATH')) exit;

// =====================================================
//  Configuración del tema
// =====================================================
function menscoretherapy_theme_setup()
{
    // Soporte de características del tema
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    // Registrar ubicaciones de menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'menscoretherapy'),
        'footer'  => __('Menú del Pie de Página', 'menscoretherapy'),
        'legal'   => __('Menú Legal', 'menscoretherapy')
    ));
}
add_action('after_setup_theme', 'menscoretherapy_theme_setup');

// =====================================================
//  Theme Customizer - Información de Contacto
// =====================================================
function menscoretherapy_customize_register($wp_customize)
{
    // ===== SECCIÓN: INFORMACIÓN DE CONTACTO =====
    $wp_customize->add_section('menscoretherapy_contact_info', array(
        'title'       => __('Información de Contacto', 'menscoretherapy'),
        'description' => __('Configura la información de contacto que aparecerá en todo el sitio web.', 'menscoretherapy'),
        'priority'    => 30,
    ));

    // Teléfono
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

    // Dirección
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

    // ===== SECCIÓN: HORARIOS DE ATENCIÓN =====
    $wp_customize->add_section('menscoretherapy_business_hours', array(
        'title'       => __('Horarios de Atención', 'menscoretherapy'),
        'description' => __('Configura los horarios de atención del negocio.', 'menscoretherapy'),
        'priority'    => 31,
    ));

    // Horarios generales (para footer)
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

    // Horarios detallados (para páginas de contacto)
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

    // Horarios de reservas
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

    // ===== SECCIÓN: POLÍTICAS Y TÉRMINOS =====
    $wp_customize->add_section('menscoretherapy_business_policies', array(
        'title'       => __('Políticas del Negocio', 'menscoretherapy'),
        'description' => __('Configura las políticas y términos del negocio.', 'menscoretherapy'),
        'priority'    => 32,
    ));

    // Política de cancelación
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

    // Tiempo de confirmación
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

    // Formas de pago
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

    // ===== SECCIÓN: REDES SOCIALES =====
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

// =====================================================
//  Funciones helper para obtener datos del customizer
// =====================================================
function menscoretherapy_get_contact_info($field, $default = '')
{
    $theme_mods = array(
        'phone'              => 'menscoretherapy_phone',
        'email'              => 'menscoretherapy_email',
        'address'            => 'menscoretherapy_address',
        'hours_general'      => 'menscoretherapy_hours_general',
        'hours_detailed'     => 'menscoretherapy_hours_detailed',
        'hours_reservas'     => 'menscoretherapy_hours_reservas',
        'cancellation_policy' => 'menscoretherapy_cancellation_policy',
        'confirmation_time'  => 'menscoretherapy_confirmation_time',
        'payment_methods'    => 'menscoretherapy_payment_methods',
        'facebook'           => 'menscoretherapy_facebook',
        'instagram'          => 'menscoretherapy_instagram',
        'whatsapp'           => 'menscoretherapy_whatsapp',
    );

    if (isset($theme_mods[$field])) {
        return get_theme_mod($theme_mods[$field], $default);
    }

    return $default;
}

// =====================================================
//  Enqueue scripts y estilos globales - OPTIMIZED
// =====================================================
function menscoretherapy_enqueue_scripts()
{
    // Estilos globales
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    // OPTIMIZED: Font Awesome local (en lugar de CDN)
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '6.0.0');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/_main.css', array(), filemtime(get_template_directory() . '/assets/css/_main.css'));

    // Estilos específicos de páginas
    if (is_page('contacto')) {
        wp_enqueue_style('contacto-css', get_template_directory_uri() . '/assets/css/contacto.css', array(), filemtime(get_template_directory() . '/assets/css/contacto.css'));
    }

    if (is_page('reservas')) {
        wp_enqueue_style('reservas-css', get_template_directory_uri() . '/assets/css/reservas.css', array(), filemtime(get_template_directory() . '/assets/css/reservas.css'));
    }

    // Script global principal
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/main.js'), true);
}
add_action('wp_enqueue_scripts', 'menscoretherapy_enqueue_scripts');

// =====================================================
//  Scripts específicos por página
// =====================================================
function menscoretherapy_enqueue_page_scripts()
{
    // Masajes
    if (is_page('masajes')) {
        wp_enqueue_style('masajes-css', get_template_directory_uri() . '/assets/css/pages/_masajes.css', array(), filemtime(get_template_directory() . '/assets/css/pages/_masajes.css'));
        wp_enqueue_script('masajes-js', get_template_directory_uri() . '/assets/js/masajes.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/masajes.js'), true);

        // Pasar datos PHP a JavaScript
        wp_localize_script('masajes-js', 'masajesData', array(
            'reservasUrl' => esc_url(home_url('/reservas/'))
        ));
    }

    // Reservas
    if (is_page('reservas')) {
        wp_enqueue_script('reservas-js', get_template_directory_uri() . '/assets/js/reservas.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/reservas.js'), true);
    }

    // Contacto
    if (is_page('contacto')) {
        wp_enqueue_script('contacto-js', get_template_directory_uri() . '/assets/js/contacto.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/contacto.js'), true);
    }

    // Productos
    if (is_page('nuestros-productos') || is_page('productos')) {
        wp_enqueue_script('productos-flip', get_template_directory_uri() . '/assets/js/productos.js', array(), filemtime(get_template_directory() . '/assets/js/productos.js'), true);
    }
}
add_action('wp_enqueue_scripts', 'menscoretherapy_enqueue_page_scripts');

// =====================================================
//  OPTIMIZATION: Preload critical assets
// =====================================================
function menscoretherapy_preload_assets()
{
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/css/font-awesome.min.css" as="style">' . "\n";
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/images/logo-sin-fondo.webp" as="image">' . "\n";
}
add_action('wp_head', 'menscoretherapy_preload_assets', 1);

// =====================================================
//  Custom Post Type: Producto
// =====================================================
function menscoretherapy_register_producto_post_type()
{
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
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'producto'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_in_rest'       => true
    );

    register_post_type('producto', $args);
}
add_action('init', 'menscoretherapy_register_producto_post_type');

// =====================================================
//  Custom Post Type: Masaje
// =====================================================
function menscoretherapy_register_masaje_post_type()
{
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
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'masaje'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_in_rest'       => true
    );

    register_post_type('masaje', $args);
}
add_action('init', 'menscoretherapy_register_masaje_post_type');

// =====================================================
//  Meta Boxes para Producto
// =====================================================
function menscoretherapy_add_producto_meta_boxes()
{
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

// =====================================================
//  Meta Boxes para Masaje
// =====================================================
function menscoretherapy_add_masaje_meta_boxes()
{
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

// Callback del meta box para masajes
function menscoretherapy_masaje_meta_box_callback($post)
{
    wp_nonce_field('menscoretherapy_save_masaje_meta', 'masaje_meta_nonce');

    $precio = get_post_meta($post->ID, '_masaje_precio', true);
    $duracion = get_post_meta($post->ID, '_masaje_duracion', true);
    $extras = get_post_meta($post->ID, '_masaje_extras', true);
    $categoria = get_post_meta($post->ID, '_masaje_categoria', true);
?>
    <div style="padding: 15px 0;">
        <table class="form-table">
            <tr>
                <th style="width: 200px;">
                    <label for="masaje_precio">
                        <strong><?php _e('Precio (€):', 'menscoretherapy'); ?></strong>
                    </label>
                </th>
                <td>
                    <input type="text"
                        id="masaje_precio"
                        name="masaje_precio"
                        value="<?php echo esc_attr($precio); ?>"
                        style="width: 200px;"
                        placeholder="Ej: 45,00€" />
                </td>
            </tr>

            <tr>
                <th style="vertical-align: top; padding-top: 10px;">
                    <label for="masaje_duracion">
                        <strong><?php _e('Duración:', 'menscoretherapy'); ?></strong>
                    </label>
                </th>
                <td>
                    <input type="text"
                        id="masaje_duracion"
                        name="masaje_duracion"
                        value="<?php echo esc_attr($duracion); ?>"
                        style="width: 200px;"
                        placeholder="Ej: 60 minutos" />
                </td>
            </tr>

            <tr>
                <th style="vertical-align: top; padding-top: 10px;">
                    <label for="masaje_extras">
                        <strong><?php _e('Incluye/Extras:', 'menscoretherapy'); ?></strong>
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
                <th style="vertical-align: top; padding-top: 10px;">
                    <label for="masaje_categoria">
                        <strong><?php _e('Categoría:', 'menscoretherapy'); ?></strong>
                    </label>
                </th>
                <td>
                    <select id="masaje_categoria" name="masaje_categoria" style="width: 200px;">
                        <option value="terapeutico" <?php selected($categoria, 'terapeutico'); ?>><?php _e('Terapéutico', 'menscoretherapy'); ?></option>
                        <option value="relajante" <?php selected($categoria, 'relajante'); ?>><?php _e('Relajante', 'menscoretherapy'); ?></option>
                        <option value="deportivo" <?php selected($categoria, 'deportivo'); ?>><?php _e('Deportivo', 'menscoretherapy'); ?></option>
                        <option value="prenatal" <?php selected($categoria, 'prenatal'); ?>><?php _e('Prenatal', 'menscoretherapy'); ?></option>
                        <option value="hot-stone" <?php selected($categoria, 'hot-stone'); ?>><?php _e('Piedras Calientes', 'menscoretherapy'); ?></option>
                        <option value="especial" <?php selected($categoria, 'especial'); ?>><?php _e('Especial', 'menscoretherapy'); ?></option>
                    </select>
                </td>
            </tr>
        </table>

        <div style="margin-top: 20px; padding: 15px; background: #f0f6fc; border-left: 4px solid #0073aa; border-radius: 4px;">
            <p style="margin: 0;">
                <strong>ℹ️ <?php _e('Nota:', 'menscoretherapy'); ?></strong>
                <?php _e('Estos campos se mostrarán en las cards de masajes. La descripción principal se ingresa en el editor de contenido arriba.', 'menscoretherapy'); ?>
            </p>
        </div>
    </div>
<?php
}

// Callback del meta box para productos
function menscoretherapy_producto_meta_box_callback($post)
{
    wp_nonce_field('menscoretherapy_save_producto_meta', 'producto_meta_nonce');

    $precio = get_post_meta($post->ID, '_producto_precio', true);
    $icono = get_post_meta($post->ID, '_producto_icono', true);
    $beneficios = get_post_meta($post->ID, '_producto_beneficios', true);
?>
    <div style="padding: 15px 0;">
        <table class="form-table">
            <tr>
                <th style="width: 200px;">
                    <label for="producto_precio">
                        <strong><?php _e('Precio (€):', 'menscoretherapy'); ?></strong>
                    </label>
                </th>
                <td>
                    <input type="text"
                        id="producto_precio"
                        name="producto_precio"
                        value="<?php echo esc_attr($precio); ?>"
                        style="width: 200px;"
                        placeholder="Ej: 29,99" />
                </td>
            </tr>

            <tr>
                <th style="vertical-align: top; padding-top: 10px;">
                    <label for="producto_icono">
                        <strong><?php _e('Icono (Font Awesome):', 'menscoretherapy'); ?></strong>
                    </label>
                </th>
                <td>
                    <input type="text"
                        id="producto_icono"
                        name="producto_icono"
                        value="<?php echo esc_attr($icono); ?>"
                        style="width: 100%; max-width: 400px;"
                        placeholder="Ej: fa-solid fa-droplet" />
                    <p class="description">
                        <?php _e('Visita', 'menscoretherapy'); ?>
                        <a href="https://fontawesome.com/icons" target="_blank" rel="noopener">FontAwesome</a>
                        <?php _e('para ver los iconos disponibles', 'menscoretherapy'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th style="vertical-align: top; padding-top: 10px;">
                    <label for="producto_beneficios">
                        <strong><?php _e('Beneficios:', 'menscoretherapy'); ?></strong>
                    </label>
                </th>
                <td>
                    <textarea id="producto_beneficios"
                        name="producto_beneficios"
                        style="width: 100%; max-width: 500px; height: 150px;"
                        placeholder="<?php esc_attr_e('Ingresa un beneficio por línea', 'menscoretherapy'); ?>&#10;Ej:&#10;Alivia la tensión muscular&#10;100% natural y orgánico&#10;Hidratación profunda"><?php echo esc_textarea($beneficios); ?></textarea>
                    <p class="description">
                        <?php _e('Escribe un beneficio por línea. Se mostrarán como lista en la card.', 'menscoretherapy'); ?>
                    </p>
                </td>
            </tr>
        </table>

        <div style="margin-top: 20px; padding: 15px; background: #f0f6fc; border-left: 4px solid #0073aa; border-radius: 4px;">
            <p style="margin: 0;">
                <strong>ℹ️ <?php _e('Nota:', 'menscoretherapy'); ?></strong>
                <?php _e('Estos campos se mostrarán en la parte trasera de la card cuando el usuario haga hover sobre el producto.', 'menscoretherapy'); ?>
            </p>
        </div>
    </div>
<?php
}

// Guardar meta datos del producto
function menscoretherapy_save_producto_meta($post_id)
{
    // Verificaciones de seguridad
    if (!isset($_POST['producto_meta_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['producto_meta_nonce'], 'menscoretherapy_save_producto_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Guardar campos
    $campos = array(
        'producto_precio'     => 'sanitize_text_field',
        'producto_icono'      => 'sanitize_text_field',
        'producto_beneficios' => 'sanitize_textarea_field'
    );

    foreach ($campos as $campo => $sanitize_function) {
        if (isset($_POST[$campo])) {
            $valor = $sanitize_function($_POST[$campo]);
            update_post_meta($post_id, '_' . $campo, $valor);
        }
    }
}
add_action('save_post', 'menscoretherapy_save_producto_meta');

// Guardar meta datos del masaje
function menscoretherapy_save_masaje_meta($post_id)
{
    // Verificaciones de seguridad
    if (!isset($_POST['masaje_meta_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['masaje_meta_nonce'], 'menscoretherapy_save_masaje_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Guardar campos
    $campos = array(
        'masaje_precio'    => 'sanitize_text_field',
        'masaje_duracion'  => 'sanitize_text_field',
        'masaje_extras'    => 'sanitize_textarea_field',
        'masaje_categoria' => 'sanitize_text_field'
    );

    foreach ($campos as $campo => $sanitize_function) {
        if (isset($_POST[$campo])) {
            $valor = $sanitize_function($_POST[$campo]);
            update_post_meta($post_id, '_' . $campo, $valor);
        }
    }
}
add_action('save_post', 'menscoretherapy_save_masaje_meta');

// =====================================================
//  Flush rewrite rules al activar el tema
// =====================================================
function menscoretherapy_flush_rewrite_rules()
{
    menscoretherapy_register_producto_post_type();
    menscoretherapy_register_masaje_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'menscoretherapy_flush_rewrite_rules');

// =====================================================
//  OPTIMIZATION: Performance improvements
// =====================================================

// Optimizar WP_Query para productos y masajes (usado en template-parts)
function menscoretherapy_optimize_productos_query($args)
{
    if (isset($args['post_type']) && in_array($args['post_type'], ['producto', 'masaje'])) {
        $args['no_found_rows'] = true;
        $args['update_post_meta_cache'] = false;
        $args['update_post_term_cache'] = false;
    }
    return $args;
}
add_filter('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (in_array($query->get('post_type'), ['producto', 'masaje'])) {
            $query->set('no_found_rows', true);
            $query->set('update_post_meta_cache', false);
            $query->set('update_post_term_cache', false);
        }
    }
});

// Añadir lazy loading por defecto a imágenes
function menscoretherapy_add_lazy_loading($content)
{
    if (is_admin()) {
        return $content;
    }

    $content = str_replace('<img ', '<img loading="lazy" ', $content);
    return $content;
}
add_filter('the_content', 'menscoretherapy_add_lazy_loading');
add_filter('post_thumbnail_html', 'menscoretherapy_add_lazy_loading');
