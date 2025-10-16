<?php
/**
 * Script de verificación: Buscar página de masajes y mostrar su ID
 */

// Incluir WordPress
require_once('../../../wp-load.php');

// Buscar la página por slug
$page = get_page_by_path('masajes');

if ($page) {
    echo "<h2>Página encontrada:</h2>";
    echo "<p><strong>ID:</strong> {$page->ID}</p>";
    echo "<p><strong>Título:</strong> {$page->post_title}</p>";
    echo "<p><strong>Slug:</strong> {$page->post_name}</p>";
    echo "<p><strong>Status:</strong> {$page->post_status}</p>";

    // Mostrar campos personalizados existentes
    echo "<h3>Campos personalizados actuales:</h3>";
    $custom_fields = get_post_meta($page->ID);
    if (!empty($custom_fields)) {
        echo "<ul>";
        foreach ($custom_fields as $key => $values) {
            if (strpos($key, 'masaje_') === 0) { // Solo mostrar campos de masajes
                echo "<li><strong>{$key}:</strong> " . esc_html($values[0]) . "</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>No hay campos personalizados de masajes.</p>";
    }

} else {
    echo "<h2>Error: No se encontró la página con slug 'masajes'</h2>";
    echo "<p>Posibles páginas con contenido relacionado:</p>";

    // Buscar páginas que contengan 'masaje' en el título
    $pages = get_pages();
    echo "<ul>";
    foreach ($pages as $p) {
        if (stripos($p->post_title, 'masaje') !== false) {
            echo "<li>{$p->post_title} (ID: {$p->ID}, Slug: {$p->post_name})</li>";
        }
    }
    echo "</ul>";
}
?>