<?php
/**
 * Script para añadir masajes nuevos (campos personalizados)
 * Ejecutar este script una vez para añadir masajes adicionales a la página de masajes
 */

// Incluir WordPress
require_once('../../../wp-load.php'); // Ajustar la ruta según la ubicación del script

// Obtener la página de masajes
$page = get_page_by_path('masajes');
if (!$page) {
    die('Error: No se encontró la página con slug "masajes"');
}

$page_id = $page->ID;
echo "Página encontrada: ID {$page_id}\n";

// Masajes a añadir (del 11 al 20)
$nuevos_masajes = array(
    11 => array(
        'nombre' => 'Masaje Deportivo Avanzado',
        'precio' => '80€',
        'duracion' => '75 min',
        'descripcion' => 'Masaje especializado para atletas y deportistas de alto rendimiento. Enfocado en la recuperación muscular y prevención de lesiones.'
    ),
    13 => array(
        'nombre' => 'Masaje con Piedras Calientes Premium',
        'precio' => '90€',
        'duracion' => '80 min',
        'descripcion' => 'Experiencia premium con piedras volcánicas naturales calentadas, combinadas con aceites esenciales para una relajación profunda.'
    ),
    14 => array(
        'nombre' => 'Masaje Tailandés Tradicional',
        'precio' => '75€',
        'duracion' => '90 min',
        'descripcion' => 'Técnica ancestral tailandesa que combina estiramientos pasivos, presiones y trabajo energético para equilibrar el flujo vital.'
    ),
    15 => array(
        'nombre' => 'Masaje Ayurvédico',
        'precio' => '85€',
        'duracion' => '70 min',
        'descripcion' => 'Masaje basado en la medicina ayurvédica tradicional, utilizando aceites específicos según el dosha individual.'
    ),
    16 => array(
        'nombre' => 'Masaje Craneal',
        'precio' => '65€',
        'duracion' => '50 min',
        'descripcion' => 'Técnica especializada en el cráneo y sistema nervioso, ideal para migrañas, estrés y problemas de sueño.'
    ),
    17 => array(
        'nombre' => 'Masaje Lymphático',
        'precio' => '70€',
        'duracion' => '60 min',
        'descripcion' => 'Drenaje linfático manual para eliminar toxinas, reducir inflamación y mejorar la circulación.'
    ),
    18 => array(
        'nombre' => 'Masaje con Aromaterapia',
        'precio' => '75€',
        'duracion' => '65 min',
        'descripcion' => 'Masaje relajante combinado con aceites esenciales seleccionados según las necesidades individuales.'
    ),
    19 => array(
        'nombre' => 'Masaje Deportivo de Recuperación',
        'precio' => '70€',
        'duracion' => '60 min',
        'descripcion' => 'Especializado en recuperación post-entrenamiento, reducción de ácido láctico y mejora del rendimiento deportivo.'
    ),
    20 => array(
        'nombre' => 'Masaje Integral Full Body',
        'precio' => '95€',
        'duracion' => '90 min',
        'descripcion' => 'Sesión completa que abarca todo el cuerpo, combinando diferentes técnicas para un bienestar total.'
    )
);

// Añadir los campos personalizados
foreach ($nuevos_masajes as $numero => $masaje) {
    update_post_meta($page_id, "masaje_{$numero}_nombre", $masaje['nombre']);
    update_post_meta($page_id, "masaje_{$numero}_precio", $masaje['precio']);
    update_post_meta($page_id, "masaje_{$numero}_duracion", $masaje['duracion']);
    update_post_meta($page_id, "masaje_{$numero}_descripcion", $masaje['descripcion']);

    echo "Añadido masaje {$numero}: {$masaje['nombre']}\n";
}

echo "\n¡Script completado! Se han añadido 10 masajes nuevos (del 11 al 20).\n";
echo "Ahora el template puede mostrar hasta 20 masajes.\n";
echo "Recuerda actualizar el bucle en masajes.php si quieres mostrar más de 10.\n";
?>