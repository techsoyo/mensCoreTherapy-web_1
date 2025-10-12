<?php
/**
 * Functions.php - Archivo principal del tema Men's Core Therapy
 *
 * Este archivo ha sido refactorizado para seguir mejores prácticas de WordPress.
 * Toda la funcionalidad se ha organizado en controladores separados por responsabilidad.
 *
 * @package Men's Core Therapy
 * @version 1.0.0
 * @author Desarrollador
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * =============================================================================
 * CARGA DE CONTROLADORES
 * =============================================================================
 *
 * Incluye todos los controladores organizados por funcionalidad.
 * Los controladores manejan diferentes aspectos del tema:
 * - ThemeController: Setup del tema, enqueue de recursos
 * - PostTypesController: Registro de Custom Post Types
 * - FormsController: Procesamiento de formularios
 * - DataController: Consultas y manipulación de datos
 * - AccessibilityController: Funciones de accesibilidad
 * - PerformanceController: Optimizaciones de rendimiento
 * - AdminController: Funciones administrativas
 */

// Incluir archivo de controladores
require_once get_template_directory() . '/inc/controllers.php';

/**
 * =============================================================================
 * FUNCIONES LEGACY Y COMPATIBILIDAD
 * =============================================================================
 *
 * Mantener algunas funciones globales para compatibilidad
 * con código existente que pueda depender de ellas.
 */

// Función helper para debugging
if (!function_exists('menscoretherapy_debug')) {
    function menscoretherapy_debug($data, $label = 'Debug') {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            echo '<pre style="background:#f5f5f5;padding:10px;margin:10px;border:1px solid #ccc;">';
            echo '<strong>' . esc_html($label) . ':</strong><br>';
            print_r($data);
            echo '</pre>';
        }
    }
}

// Get contact information
if (!function_exists('mm_get_contact_info')) {
    function mm_get_contact_info()
    {
        return array(
            'phone' => '+34 123 456 789',
            'email' => 'info@menscoretherapy.com',
            'address' => 'Calle Ejemplo 123, Madrid',
            'whatsapp' => '+34 123 456 789',
            'hours' => 'Lunes a Domingo: 10:00 - 22:00'
        );
    }
}

// Get page URL by slug
if (!function_exists('mm_link_by_slug')) {
    function mm_link_by_slug($slug)
    {
        $page = get_page_by_path($slug);
        if ($page) {
            return get_permalink($page->ID);
        }

        // Fallback URLs if pages don't exist
        $fallback_urls = array(
            'reservas' => home_url('/page-reservas/'),
            'servicios' => home_url('/page-servicios/'),
            'contactos' => home_url('/page-contactos/'),
            'productos' => home_url('/page-productos/')
        );

        return isset($fallback_urls[$slug]) ? $fallback_urls[$slug] : home_url('/');
    }
}

// Función helper para logging
if (!function_exists('menscoretherapy_log')) {
    function menscoretherapy_log($message, $level = 'info') {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $prefix = '[Men\'s Core Therapy] ';
            error_log($prefix . strtoupper($level) . ': ' . $message);
        }
    }
}

/**
 * =============================================================================
 * INICIALIZACIÓN DEL TEMA
 * =============================================================================
 *
 * El tema se inicializa automáticamente a través de los controladores
 * incluidos en el archivo controllers.php
 */

// Mensaje de confirmación de carga
menscoretherapy_log('Tema Men\'s Core Therapy cargado correctamente', 'success');
