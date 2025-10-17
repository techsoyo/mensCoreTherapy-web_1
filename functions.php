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
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/_main.css', array(), '1.0.0', 'all');
    wp_enqueue_style('contacto-css', get_template_directory_uri() . '/assets/css/contacto.css', array(), '1.0.0', 'all');
    wp_enqueue_style('reservas-css', get_template_directory_uri() . '/assets/css/reservas.css', array(), '1.0.0', 'all');

    // Script global principal
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'theme_scripts');

// =====================================================
//  Encolar estilos y scripts específicos para la página "Masajes"
// =====================================================
function enqueue_masajes_assets()
{
    if (is_page('masajes')) { // Se ejecuta solo en la página "Masajes"
        wp_enqueue_style('masajes-css', get_template_directory_uri() . '/assets/css/pages/_masajes.css', array(), '1.0.0', 'all');
        wp_enqueue_script('masajes-js', get_template_directory_uri() . '/assets/js/masajes.js', array('jquery'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_masajes_assets');

// =====================================================
//  Encolar scripts específicos para la página "Reservas"
// =====================================================
function enqueue_reservas_assets()
{
    if (is_page('reservas')) { // Se ejecuta solo en la página "Reservas"
        wp_enqueue_script('reservas-js', get_template_directory_uri() . '/assets/js/reservas.js', array('jquery'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_reservas_assets');

// =====================================================
//  Encolar scripts específicos para la página "Contacto"
// =====================================================
function enqueue_contacto_assets()
{
    if (is_page('contacto')) { // Se ejecuta solo en la página "Contacto"
        wp_enqueue_script('contacto-js', get_template_directory_uri() . '/assets/js/contacto.js', array('jquery'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_contacto_assets');

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


// =====================================================
// Registrar Custom Post Type: Producto
function menscoretherapy_register_producto_post_type()
{
    $labels = array(
        'name'               => 'Productos',
        'singular_name'      => 'Producto',
        'menu_name'          => 'Productos',
        'add_new'            => 'Añadir Nuevo',
        'add_new_item'       => 'Añadir Nuevo Producto',
        'edit_item'          => 'Editar Producto',
        'new_item'           => 'Nuevo Producto',
        'view_item'          => 'Ver Producto',
        'search_items'       => 'Buscar Productos',
        'not_found'          => 'No se encontraron productos',
        'not_found_in_trash' => 'No hay productos en la papelera',
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
    );

    register_post_type('producto', $args);
}
add_action('init', 'menscoretherapy_register_producto_post_type');

// Agregar Meta Boxes para los precios
function menscoretherapy_add_producto_meta_boxes()
{
    add_meta_box(
        'producto_precios',
        'Precios del Producto',
        'menscoretherapy_producto_precios_callback',
        'producto',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'menscoretherapy_add_producto_meta_boxes');

// Callback para mostrar los campos de precios
function menscoretherapy_producto_precios_callback($post)
{
    wp_nonce_field('menscoretherapy_save_producto_precios', 'menscoretherapy_producto_precios_nonce');

    $precio = get_post_meta($post->ID, '_producto_precio', true);
    $icono = get_post_meta($post->ID, '_producto_icono', true);
    $beneficios = get_post_meta($post->ID, '_producto_beneficios', true);
?>
    <div style="padding: 10px 0;">
        <p>
            <label for="producto_precio" style="display: inline-block; width: 180px; font-weight: bold;">
                Precio (€):
            </label>
            <input type="text" id="producto_precio" name="producto_precio"
                value="<?php echo esc_attr($precio); ?>" style="width: 200px;"
                placeholder="Ej: 29,99" />
        </p>

        <p>
            <label for="producto_icono" style="display: inline-block; width: 180px; font-weight: bold; vertical-align: top;">
                Icono (Font Awesome):
            </label>
            <input type="text" id="producto_icono" name="producto_icono"
                value="<?php echo esc_attr($icono); ?>" style="width: 300px;"
                placeholder="Ej: fa-solid fa-droplet" />
            <br>
            <span style="margin-left: 185px; font-size: 12px; color: #666;">
                Visita <a href="https://fontawesome.com/icons" target="_blank">FontAwesome</a> para ver los iconos
            </span>
        </p>

        <p>
            <label for="producto_beneficios" style="display: inline-block; width: 180px; font-weight: bold; vertical-align: top;">
                Beneficios:
            </label>
            <textarea id="producto_beneficios" name="producto_beneficios"
                style="width: 400px; height: 150px;"
                placeholder="Ingresa un beneficio por línea&#10;Ej:&#10;Alivia la tensión muscular&#10;100% natural y orgánico&#10;Hidratación profunda"><?php echo esc_textarea($beneficios); ?></textarea>
            <br>
            <span style="margin-left: 185px; font-size: 12px; color: #666;">
                Escribe un beneficio por línea
            </span>
        </p>

        <p style="margin-top: 15px; padding: 10px; background: #f0f0f0; border-left: 4px solid #0073aa;">
            <strong>Nota:</strong> Estos campos se mostrarán en la parte trasera de la card al hacer hover.
        </p>
    </div>
<?php
}

// Guardar los meta datos de precios
function menscoretherapy_save_producto_precios($post_id)
{
    // Verificar nonce
    if (!isset($_POST['menscoretherapy_producto_precios_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['menscoretherapy_producto_precios_nonce'], 'menscoretherapy_save_producto_precios')) {
        return;
    }

    // Verificar autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Verificar permisos
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Guardar los precios
    $campos = array(
        'producto_precio',
        'producto_icono',
        'producto_beneficios'
    );

    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valor = ($campo === 'producto_beneficios')
                ? sanitize_textarea_field($_POST[$campo])
                : sanitize_text_field($_POST[$campo]);
            update_post_meta($post_id, '_' . $campo, $valor);
        }
    }
}
add_action('save_post', 'menscoretherapy_save_producto_precios');

// Enqueue del script de productos (si decides usarlo)
function menscoretherapy_enqueue_productos_scripts()
{
    if (is_page_template('template-parts/nuestros-productos.php') || is_page('nuestros-productos')) {
        wp_enqueue_script(
            'productos-flip',
            get_template_directory_uri() . '/assets/js/productos.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'menscoretherapy_enqueue_productos_scripts');
