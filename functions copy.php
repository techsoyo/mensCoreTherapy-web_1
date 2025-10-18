<?php

/**
 * Functions and definitions - VERSIÓN REFACTORIZADA
 *
 * @package MensCoreTherapy
 */
if (!defined('ABSPATH')) exit;

// =====================================================
// Configuración del tema
// =====================================================
function menscoretherapy_theme_setup()
{
    // Soporte de características del tema
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);
    add_theme_support('responsive-embeds');
    add_theme_support('customize-selective-refresh-widgets');

    // Tamaños de imagen personalizados
    add_image_size('producto-thumb', 300, 200, true);
    add_image_size('producto-large', 600, 400, true);

    // Registrar ubicaciones de menús
    register_nav_menus([
        'primary' => __('Menú Principal', 'menscoretherapy'),
        'footer' => __('Menú del Pie de Página', 'menscoretherapy'),
        'legal' => __('Menú Legal', 'menscoretherapy')
    ]);
}
add_action('after_setup_theme', 'menscoretherapy_theme_setup');

// =====================================================
// Configuración de contacto (mejora)
// =====================================================
function menscoretherapy_get_contact_info()
{
    return [
        'phone' => get_option('menscoretherapy_phone', '+34 666 777 888'),
        'email' => get_option('menscoretherapy_email', 'info@masajes.com'),
        'address' => get_option('menscoretherapy_address', 'Barcelona, España'),
        'hours' => get_option('menscoretherapy_hours', 'Lun-Dom: 10:00-22:00'),
        'whatsapp' => get_option('menscoretherapy_whatsapp', '+34666777888')
    ];
}

// =====================================================
// Headers de seguridad
// =====================================================
function menscoretherapy_security_headers()
{
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'menscoretherapy_security_headers');

// =====================================================
// Enqueue scripts y estilos optimizados
// =====================================================
function menscoretherapy_enqueue_scripts()
{
    $version = wp_get_theme()->get('Version');

    // Estilos críticos
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_uri(),
        [],
        $version
    );

    // Font Awesome local (mejor rendimiento)
    wp_enqueue_style(
        'font-awesome',
        get_template_directory_uri() . '/assets/fonts/fontawesome.min.css',
        [],
        '6.0.0'
    );

    // CSS principal
    wp_enqueue_style(
        'main-css',
        get_template_directory_uri() . '/assets/css/_main.css',
        ['theme-style'],
        $version
    );

    // JavaScript principal
    wp_enqueue_script(
        'theme-script',
        get_template_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        $version,
        true
    );

    // Localizar scripts
    wp_localize_script('theme-script', 'menscoretherapy_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('menscoretherapy_nonce'),
        'contact_info' => menscoretherapy_get_contact_info()
    ]);
}
add_action('wp_enqueue_scripts', 'menscoretherapy_enqueue_scripts');

// =====================================================
// Scripts específicos por página optimizados
// =====================================================
function menscoretherapy_enqueue_page_scripts()
{
    $version = wp_get_theme()->get('Version');

    // Página de masajes
    if (is_page(['masajes', 'servicios'])) {
        wp_enqueue_style(
            'masajes-css',
            get_template_directory_uri() . '/assets/css/pages/_masajes.css',
            ['main-css'],
            $version
        );
        wp_enqueue_script(
            'masajes-js',
            get_template_directory_uri() . '/assets/js/masajes.js',
            ['jquery'],
            $version,
            true
        );
    }

    // Página de reservas
    if (is_page('reservas')) {
        wp_enqueue_style(
            'reservas-css',
            get_template_directory_uri() . '/assets/css/reservas.css',
            ['main-css'],
            $version
        );
        wp_enqueue_script(
            'reservas-js',
            get_template_directory_uri() . '/assets/js/reservas.js',
            ['jquery'],
            $version,
            true
        );
    }

    // Página de contacto
    if (is_page('contacto')) {
        wp_enqueue_style(
            'contacto-css',
            get_template_directory_uri() . '/assets/css/contacto.css',
            ['main-css'],
            $version
        );
        wp_enqueue_script(
            'contacto-js',
            get_template_directory_uri() . '/assets/js/contacto.js',
            ['jquery'],
            $version,
            true
        );
    }

    // Páginas de productos
    if (is_page(['productos', 'nuestros-productos']) || is_singular('producto')) {
        wp_enqueue_script(
            'productos-flip',
            get_template_directory_uri() . '/assets/js/productos.js',
            ['jquery'],
            $version,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'menscoretherapy_enqueue_page_scripts');

// =====================================================
// Custom Post Type: Producto (mejorado)
// =====================================================
function menscoretherapy_register_producto_post_type()
{
    $labels = [
        'name' => __('Productos', 'menscoretherapy'),
        'singular_name' => __('Producto', 'menscoretherapy'),
        'menu_name' => __('Productos', 'menscoretherapy'),
        'add_new' => __('Añadir Nuevo', 'menscoretherapy'),
        'add_new_item' => __('Añadir Nuevo Producto', 'menscoretherapy'),
        'edit_item' => __('Editar Producto', 'menscoretherapy'),
        'new_item' => __('Nuevo Producto', 'menscoretherapy'),
        'view_item' => __('Ver Producto', 'menscoretherapy'),
        'search_items' => __('Buscar Productos', 'menscoretherapy'),
        'not_found' => __('No se encontraron productos', 'menscoretherapy'),
        'not_found_in_trash' => __('No hay productos en la papelera', 'menscoretherapy'),
        'all_items' => __('Todos los Productos', 'menscoretherapy'),
        'archives' => __('Archivo de Productos', 'menscoretherapy'),
        'attributes' => __('Atributos del Producto', 'menscoretherapy')
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'producto', 'with_front' => false],
        'capability_type' => 'post',
        'has_archive' => 'productos',
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields'],
        'show_in_rest' => true,
        'rest_base' => 'productos',
        'rest_controller_class' => 'WP_REST_Posts_Controller'
    ];

    register_post_type('producto', $args);
}
add_action('init', 'menscoretherapy_register_producto_post_type');

// =====================================================
// Meta Boxes para Producto (mejorados)
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

// Callback del meta box mejorado
function menscoretherapy_producto_meta_box_callback($post)
{
    wp_nonce_field('menscoretherapy_save_producto_meta', 'producto_meta_nonce');

    $precio = get_post_meta($post->ID, '_producto_precio', true);
    $icono = get_post_meta($post->ID, '_producto_icono', true);
    $beneficios = get_post_meta($post->ID, '_producto_beneficios', true);
    $duracion = get_post_meta($post->ID, '_producto_duracion', true);
    $destacado = get_post_meta($post->ID, '_producto_destacado', true);
?>
    <table class="form-table">
        <tbody>
            <tr>
                <th><label for="producto_precio"><?php _e('Precio (€):', 'menscoretherapy'); ?></label></th>
                <td>
                    <input type="number"
                        id="producto_precio"
                        name="producto_precio"
                        value="<?php echo esc_attr($precio); ?>"
                        class="regular-text"
                        min="0"
                        step="0.01"
                        placeholder="0.00" />
                    <p class="description"><?php _e('Introduce el precio sin el símbolo €', 'menscoretherapy'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="producto_duracion"><?php _e('Duración:', 'menscoretherapy'); ?></label></th>
                <td>
                    <input type="text"
                        id="producto_duracion"
                        name="producto_duracion"
                        value="<?php echo esc_attr($duracion); ?>"
                        class="regular-text"
                        placeholder="60 minutos" />
                    <p class="description"><?php _e('Ejemplo: "60 minutos", "1 hora", "90 min"', 'menscoretherapy'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="producto_icono"><?php _e('Icono (Font Awesome):', 'menscoretherapy'); ?></label></th>
                <td>
                    <input type="text"
                        id="producto_icono"
                        name="producto_icono"
                        value="<?php echo esc_attr($icono); ?>"
                        class="regular-text"
                        placeholder="fas fa-spa" />
                    <p class="description">
                        <?php _e('Visita', 'menscoretherapy'); ?>
                        <a href="https://fontawesome.com/icons" target="_blank" rel="noopener">FontAwesome</a>
                        <?php _e('para ver los iconos disponibles. Ejemplo: "fas fa-spa"', 'menscoretherapy'); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th><label for="producto_beneficios"><?php _e('Beneficios:', 'menscoretherapy'); ?></label></th>
                <td>
                    <textarea id="producto_beneficios"
                        name="producto_beneficios"
                        rows="5"
                        class="large-text"
                        placeholder="Escribe un beneficio por línea..."><?php echo esc_textarea($beneficios); ?></textarea>
                    <p class="description"><?php _e('Escribe un beneficio por línea. Se mostrarán como lista en la card.', 'menscoretherapy'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="producto_destacado"><?php _e('Producto Destacado:', 'menscoretherapy'); ?></label></th>
                <td>
                    <label for="producto_destacado">
                        <input type="checkbox"
                            id="producto_destacado"
                            name="producto_destacado"
                            value="1"
                            <?php checked($destacado, '1'); ?> />
                        <?php _e('Marcar como producto destacado', 'menscoretherapy'); ?>
                    </label>
                    <p class="description"><?php _e('Los productos destacados aparecerán primero en el listado.', 'menscoretherapy'); ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="description">
        <strong>ℹ️ <?php _e('Nota:', 'menscoretherapy'); ?></strong><br>
        <?php _e('Estos campos se mostrarán en la parte trasera de la card cuando el usuario haga hover sobre el producto.', 'menscoretherapy'); ?>
    </p>
<?php
}

// Guardar meta datos del producto (mejorado)
function menscoretherapy_save_producto_meta($post_id)
{
    // Verificaciones de seguridad
    if (
        !isset($_POST['producto_meta_nonce']) ||
        !wp_verify_nonce($_POST['producto_meta_nonce'], 'menscoretherapy_save_producto_meta')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Validar y guardar campos
    $campos = [
        'producto_precio' => 'sanitize_text_field',
        'producto_duracion' => 'sanitize_text_field',
        'producto_icono' => 'sanitize_text_field',
        'producto_beneficios' => 'sanitize_textarea_field',
        'producto_destacado' => 'sanitize_text_field'
    ];

    foreach ($campos as $campo => $sanitize_function) {
        if (isset($_POST[$campo])) {
            $valor = $sanitize_function($_POST[$campo]);

            // Validaciones específicas
            if ($campo === 'producto_precio') {
                $valor = floatval($valor);
                $valor = $valor >= 0 ? $valor : 0;
            }

            update_post_meta($post_id, '_' . $campo, $valor);
        } else {
            // Campos checkbox que pueden no estar presentes
            if ($campo === 'producto_destacado') {
                delete_post_meta($post_id, '_' . $campo);
            }
        }
    }
}
add_action('save_post', 'menscoretherapy_save_producto_meta');

// =====================================================
// Menús de navegación mejorados
// =====================================================
class Menscoretherapy_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= '<li' . $id . $class_names . '>';

        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty($item->url) ? ' href="'   . esc_attr($item->url) . '"' : '';

        $item_output = $args->before ?? '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ($args->link_before ?? '') . apply_filters('the_title', $item->title, $item->ID) . ($args->link_after ?? '');
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// Menú de fallback mejorado
function menscoretherapy_fallback_menu()
{
    echo '<ul class="nav-menu fallback-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Inicio', 'menscoretherapy') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/productos/')) . '">' . __('Productos', 'menscoretherapy') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/masajes/')) . '">' . __('Masajes', 'menscoretherapy') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/reservas/')) . '">' . __('Reservas', 'menscoretherapy') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contacto/')) . '">' . __('Contacto', 'menscoretherapy') . '</a></li>';
    echo '</ul>';
}

// Menú legal de fallback
function menscoretherapy_legal_fallback()
{
    echo '<nav class="footer-legal-nav" aria-label="Menú de textos legales">';
    echo '<ul class="footer-legal-menu">';

    $legal_pages = [
        'aviso-legal' => __('Aviso Legal', 'menscoretherapy'),
        'politica-de-privacidad' => __('Política de Privacidad', 'menscoretherapy'),
        'politica-de-cookies' => __('Política de Cookies', 'menscoretherapy'),
        'condiciones-de-uso' => __('Condiciones de Uso', 'menscoretherapy')
    ];

    foreach ($legal_pages as $slug => $title) {
        $page = get_page_by_path($slug);
        if ($page) {
            printf(
                '<li><a href="%s">%s</a></li>',
                esc_url(get_permalink($page->ID)),
                esc_html($title)
            );
        }
    }

    echo '</ul>';
    echo '</nav>';
}

// =====================================================
// Configuraciones del panel de administración
// =====================================================
function menscoretherapy_admin_menu()
{
    add_theme_page(
        __('Configuración del Tema', 'menscoretherapy'),
        __('Configuración', 'menscoretherapy'),
        'manage_options',
        'menscoretherapy-config',
        'menscoretherapy_config_page'
    );
}
add_action('admin_menu', 'menscoretherapy_admin_menu');

function menscoretherapy_config_page()
{
    if (isset($_POST['submit'])) {
        update_option('menscoretherapy_phone', sanitize_text_field($_POST['phone']));
        update_option('menscoretherapy_email', sanitize_email($_POST['email']));
        update_option('menscoretherapy_address', sanitize_text_field($_POST['address']));
        update_option('menscoretherapy_hours', sanitize_text_field($_POST['hours']));
        update_option('menscoretherapy_whatsapp', sanitize_text_field($_POST['whatsapp']));

        echo '<div class="notice notice-success"><p>' . __('Configuración guardada correctamente.', 'menscoretherapy') . '</p></div>';
    }

    $contact_info = menscoretherapy_get_contact_info();
?>
    <div class="wrap">
        <h1><?php _e('Configuración del Tema', 'menscoretherapy'); ?></h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th><label for="phone"><?php _e('Teléfono:', 'menscoretherapy'); ?></label></th>
                    <td><input type="text" id="phone" name="phone" value="<?php echo esc_attr($contact_info['phone']); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th><label for="email"><?php _e('Email:', 'menscoretherapy'); ?></label></th>
                    <td><input type="email" id="email" name="email" value="<?php echo esc_attr($contact_info['email']); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th><label for="address"><?php _e('Dirección:', 'menscoretherapy'); ?></label></th>
                    <td><input type="text" id="address" name="address" value="<?php echo esc_attr($contact_info['address']); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th><label for="hours"><?php _e('Horarios:', 'menscoretherapy'); ?></label></th>
                    <td><input type="text" id="hours" name="hours" value="<?php echo esc_attr($contact_info['hours']); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th><label for="whatsapp"><?php _e('WhatsApp:', 'menscoretherapy'); ?></label></th>
                    <td><input type="text" id="whatsapp" name="whatsapp" value="<?php echo esc_attr($contact_info['whatsapp']); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// =====================================================
// Optimizaciones finales
// =====================================================

// Flush rewrite rules al activar el tema
function menscoretherapy_flush_rewrite_rules()
{
    menscoretherapy_register_producto_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'menscoretherapy_flush_rewrite_rules');

// Limpiar head de WordPress
function menscoretherapy_clean_head()
{
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
}
add_action('init', 'menscoretherapy_clean_head');

// Optimizar queries de productos
function menscoretherapy_pre_get_posts($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if (is_home() && !is_front_page()) {
            $query->set('posts_per_page', 6);
        }

        if (is_post_type_archive('producto')) {
            $query->set('posts_per_page', 12);
            $query->set('meta_key', '_producto_destacado');
            $query->set('orderby', ['meta_value_num' => 'DESC', 'menu_order' => 'ASC']);
        }
    }
}
add_action('pre_get_posts', 'menscoretherapy_pre_get_posts');

?>