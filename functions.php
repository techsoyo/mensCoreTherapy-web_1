<?php
// =====================================================
//  Registrar tipos de post personalizados
// =====================================================
function registrar_tipos_post_personalizados()
{
    // Registro del tipo de post 'producto'
    register_post_type('producto', array(
        'labels' => array(
            'name' => 'Productos',
            'singular_name' => 'Producto',
            'add_new' => 'Añadir Nuevo',
            'add_new_item' => 'Añadir Nuevo Producto',
            'edit_item' => 'Editar Producto',
            'new_item' => 'Nuevo Producto',
            'view_item' => 'Ver Producto',
            'search_items' => 'Buscar Productos',
            'not_found' => 'No se encontraron productos',
            'not_found_in_trash' => 'No se encontraron productos en la papelera'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'menu_icon' => 'dashicons-products',
        'rewrite' => array('slug' => 'productos'),
        'show_in_rest' => true
    ));
}
add_action('init', 'registrar_tipos_post_personalizados');

// =====================================================
//  Configuración del tema (menús, thumbnails, etc.)
// =====================================================
function theme_setup()
{
    add_theme_support('menus');
    add_theme_support('post-thumbnails');

    // Registrar ubicaciones de menús
    register_nav_menus(array(
        'primary' => 'Menú Principal',
        'footer' => 'Menú del Pie de Página'
    ));
}
add_action('after_setup_theme', 'theme_setup');

// =====================================================
//  Enqueue scripts y estilos globales
// =====================================================
function theme_scripts()
{
    // Estilos globales
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/_main.css');
    wp_enqueue_style('contacto-css', get_template_directory_uri() . '/assets/css/contacto.css');
    wp_enqueue_style('reservas-css', get_template_directory_uri() . '/assets/css/reservas.css');

    // Script global principal
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);

    // JS para página de productos
    if (is_page('productos')) {
        wp_enqueue_script('productos-script', get_template_directory_uri() . '/js/servicios.js', array('jquery'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'theme_scripts');

// =====================================================
//  Encolar estilos y scripts específicos para la página "Masajes"
// =====================================================
function enqueue_masajes_assets()
{
    if (is_page('masajes')) { // Se ejecuta solo en la página "Masajes"
        wp_enqueue_style('masajes-css', get_template_directory_uri() . '/assets/css/pages/_masajes.css');
        wp_enqueue_script('masajes-js', get_template_directory_uri() . '/js/masajes.js', array('jquery'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_masajes_assets');

// =====================================================
//  Campos personalizados para productos
// =====================================================
function agregar_meta_boxes_producto()
{
    add_meta_box(
        'producto_detalles',
        'Detalles del Producto',
        'mostrar_meta_box_producto',
        'producto',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'agregar_meta_boxes_producto');

function mostrar_meta_box_producto($post)
{
    wp_nonce_field('guardar_producto_meta', 'producto_meta_nonce');

    $precio = get_post_meta($post->ID, '_producto_precio', true);
    $icono = get_post_meta($post->ID, '_producto_icono', true);
    $beneficios = get_post_meta($post->ID, '_producto_beneficios', true);

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="producto_precio">Precio:</label></th>';
    echo '<td><input type="text" id="producto_precio" name="producto_precio" value="' . esc_attr($precio) . '" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="producto_icono">Icono (Font Awesome):</label></th>';
    echo '<td><input type="text" id="producto_icono" name="producto_icono" value="' . esc_attr($icono) . '" placeholder="ej: leaf, fire, star" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="producto_beneficios">Beneficios (uno por línea):</label></th>';
    echo '<td><textarea id="producto_beneficios" name="producto_beneficios" rows="5" cols="50">' . esc_textarea($beneficios) . '</textarea></td>';
    echo '</tr>';
    echo '</table>';
}

function guardar_producto_meta($post_id)
{
    if (!isset($_POST['producto_meta_nonce']) || !wp_verify_nonce($_POST['producto_meta_nonce'], 'guardar_producto_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['producto_precio'])) {
        update_post_meta($post_id, '_producto_precio', sanitize_text_field($_POST['producto_precio']));
    }

    if (isset($_POST['producto_icono'])) {
        update_post_meta($post_id, '_producto_icono', sanitize_text_field($_POST['producto_icono']));
    }

    if (isset($_POST['producto_beneficios'])) {
        update_post_meta($post_id, '_producto_beneficios', sanitize_textarea_field($_POST['producto_beneficios']));
    }
}
add_action('save_post', 'guardar_producto_meta');

// =====================================================
//  Flush rewrite rules al activar el tema
// =====================================================
function flush_rewrite_rules_on_activation()
{
    registrar_tipos_post_personalizados();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'flush_rewrite_rules_on_activation');
