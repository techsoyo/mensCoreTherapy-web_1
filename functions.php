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
//  Enqueue scripts y estilos globales - OPTIMIZED
// =====================================================
function menscoretherapy_enqueue_scripts()
{
    // Estilos globales
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    // OPTIMIZED: Font Awesome local (en lugar de CDN)
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '6.0.0');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/_main.css', array(), '1.0.0');

    // Estilos específicos de páginas
    if (is_page('contacto')) {
        wp_enqueue_style('contacto-css', get_template_directory_uri() . '/assets/css/contacto.css', array(), '1.0.0');
    }

    if (is_page('reservas')) {
        wp_enqueue_style('reservas-css', get_template_directory_uri() . '/assets/css/reservas.css', array(), '1.0.0');
    }

    // Script global principal
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'menscoretherapy_enqueue_scripts');

// =====================================================
//  Scripts específicos por página
// =====================================================
function menscoretherapy_enqueue_page_scripts()
{
    // Masajes
    if (is_page('masajes')) {
        wp_enqueue_style('masajes-css', get_template_directory_uri() . '/assets/css/pages/_masajes.css', array(), '1.0.0');
        wp_enqueue_script('masajes-js', get_template_directory_uri() . '/assets/js/masajes.js', array('jquery'), '1.0.0', true);
    }

    // Reservas
    if (is_page('reservas')) {
        wp_enqueue_script('reservas-js', get_template_directory_uri() . '/assets/js/reservas.js', array('jquery'), '1.0.0', true);
    }

    // Contacto
    if (is_page('contacto')) {
        wp_enqueue_script('contacto-js', get_template_directory_uri() . '/assets/js/contacto.js', array('jquery'), '1.0.0', true);
    }

    // Productos
    if (is_page('nuestros-productos') || is_page('productos')) {
        wp_enqueue_script('productos-flip', get_template_directory_uri() . '/assets/js/productos.js', array(), '1.0.0', true);
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

// Callback del meta box
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

// =====================================================
//  Flush rewrite rules al activar el tema
// =====================================================
function menscoretherapy_flush_rewrite_rules()
{
    menscoretherapy_register_producto_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'menscoretherapy_flush_rewrite_rules');

// =====================================================
//  OPTIMIZATION: Performance improvements
// =====================================================

// Optimizar WP_Query para productos (usado en template-parts)
function menscoretherapy_optimize_productos_query($args)
{
    if (isset($args['post_type']) && $args['post_type'] === 'producto') {
        $args['no_found_rows'] = true;
        $args['update_post_meta_cache'] = false;
        $args['update_post_term_cache'] = false;
    }
    return $args;
}
add_filter('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->get('post_type') === 'producto') {
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
