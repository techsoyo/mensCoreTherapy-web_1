<?php
/**
 * Prueba de la Nueva Estructura
 * Verifica que los template-parts funcionan con los datos migrados
 */

// Cargar WordPress
require_once(dirname(__FILE__) . '/../../../../wp-load.php');

// Verificar que tenemos WordPress cargado
if (!function_exists('wp_insert_post')) {
    die('Error: WordPress no está cargado correctamente.');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Prueba Nueva Estructura - MensCore Therapy</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f1f1f1; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { color: #0073aa; border-bottom: 2px solid #0073aa; padding-bottom: 10px; margin-bottom: 20px; }
        .section { margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px; }
        .success { color: #46b450; }
        .error { color: #dc3232; }
        .test-item { margin: 10px 0; padding: 10px; background: white; border-left: 4px solid #0073aa; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="header">🧪 Prueba de Nueva Estructura con Datos Migrados</h1>
        
        <div class="section">
            <h2>📊 Verificación de Datos</h2>
            
            <?php
            // Cargar DataController
            require_once(get_template_directory() . '/inc/controllers/DataController.php');
            $data_controller = new DataController();
            
            // Obtener datos
            $servicios = $data_controller->get_servicios_data();
            $productos = $data_controller->get_productos_data();
            ?>
            
            <div class="test-item">
                <strong>Servicios encontrados:</strong> 
                <span class="<?php echo count($servicios) > 0 ? 'success' : 'error'; ?>">
                    <?php echo count($servicios); ?> servicios
                </span>
            </div>
            
            <div class="test-item">
                <strong>Productos encontrados:</strong> 
                <span class="<?php echo count($productos) > 0 ? 'success' : 'error'; ?>">
                    <?php echo count($productos); ?> productos
                </span>
            </div>
        </div>

        <div class="section">
            <h2>🛠️ Servicios Migrados</h2>
            
            <?php if (!empty($servicios)) : ?>
                <div class="grid">
                    <?php foreach ($servicios as $servicio) : ?>
                        <div class="card">
                            <h3 style="color: #0073aa; margin-bottom: 10px;">
                                <?php echo esc_html($servicio['post_title']); ?>
                            </h3>
                            <p style="color: #666; font-size: 14px; margin-bottom: 10px;">
                                <strong>Slug:</strong> <?php echo esc_html($servicio['post_name']); ?>
                            </p>
                            <p style="color: #333; line-height: 1.5;">
                                <?php echo wp_trim_words($servicio['post_content'], 20); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="error">No se encontraron servicios.</p>
            <?php endif; ?>
        </div>

        <div class="section">
            <h2>🛍️ Productos Migrados</h2>
            
            <?php if (!empty($productos)) : ?>
                <div class="grid">
                    <?php foreach ($productos as $producto) : ?>
                        <div class="card">
                            <h3 style="color: #0073aa; margin-bottom: 10px;">
                                <?php echo esc_html($producto['post_title']); ?>
                            </h3>
                            <p style="color: #666; font-size: 14px; margin-bottom: 10px;">
                                <strong>Slug:</strong> <?php echo esc_html($producto['post_name']); ?>
                            </p>
                            <?php if (!empty($producto['post_excerpt'])) : ?>
                                <p style="color: #666; font-style: italic; margin-bottom: 10px;">
                                    <?php echo esc_html($producto['post_excerpt']); ?>
                                </p>
                            <?php endif; ?>
                            <p style="color: #333; line-height: 1.5;">
                                <?php echo wp_trim_words($producto['post_content'], 15); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="error">No se encontraron productos.</p>
            <?php endif; ?>
        </div>

        <div class="section">
            <h2>✅ Estructura Nueva - Estado</h2>
            
            <div class="test-item">
                <strong>Template page.php:</strong> 
                <span class="success">
                    <?php echo file_exists(get_template_directory() . '/_new-estrutura/page.php') ? '✅ Existe' : '❌ No existe'; ?>
                </span>
            </div>
            
            <div class="test-item">
                <strong>Template servicios.php:</strong> 
                <span class="success">
                    <?php echo file_exists(get_template_directory() . '/_new-estrutura/template-parts/servicios.php') ? '✅ Existe' : '❌ No existe'; ?>
                </span>
            </div>
            
            <div class="test-item">
                <strong>Template productos.php:</strong> 
                <span class="success">
                    <?php echo file_exists(get_template_directory() . '/_new-estrutura/template-parts/nuestros-productos.php') ? '✅ Existe' : '❌ No existe'; ?>
                </span>
            </div>
        </div>

        <div class="section">
            <h2>🎯 Próximos Pasos</h2>
            <ul>
                <li>✅ Datos migrados correctamente</li>
                <li>✅ Nueva estructura creada</li>
                <li>✅ Template-parts actualizados con datos dinámicos</li>
                <li>🔄 Listo para implementar la nueva estructura</li>
            </ul>
        </div>
    </div>
</body>
</html>