<?php
// Obtener productos desde la base de datos
$productos_query = new WP_Query(array(
    'post_type' => 'producto',
    'posts_per_page' => -1,
    'post_status' => 'publish'
));
?>

<section class="productos-section">
    <div class="productos-section-container">
        <div class="section-header">
            <h2>Nuestros Productos</h2>
            <p>Productos premium para complementar tu experiencia de bienestar</p>
        </div>

        <?php if ($productos_query->have_posts()) : ?>
            <div class="productos-grid">
                <?php while ($productos_query->have_posts()) : $productos_query->the_post();
                    $precio = get_post_meta(get_the_ID(), '_producto_precio', true);
                    $icono = get_post_meta(get_the_ID(), '_producto_icono', true);
                    $beneficios = get_post_meta(get_the_ID(), '_producto_beneficios', true);

                    // Convertir beneficios de string a array si es necesario
                    if ($beneficios && !is_array($beneficios)) {
                        $beneficios = explode("\n", $beneficios);
                    }
                ?>
                    <div class="producto-card">
                        <div class="producto-icon">
                            <?php if ($icono) : ?>
                                <i class="fa fa-<?php echo esc_attr($icono); ?>"></i>
                            <?php else : ?>
                                <i class="fa fa-star"></i>
                            <?php endif; ?>
                        </div>
                        <h3><?php the_title(); ?></h3>
                        <div class="producto-precio">
                            <?php if ($precio) : ?>
                                €<?php echo esc_html($precio); ?>
                            <?php endif; ?>
                        </div>
                        <p class="producto-descripcion"><?php echo wp_trim_words(get_the_content(), 15); ?></p>

                        <?php if ($beneficios && is_array($beneficios)) : ?>
                            <ul class="beneficios-list">
                                <?php foreach ($beneficios as $beneficio) :
                                    $beneficio = trim($beneficio);
                                    if (!empty($beneficio)) : ?>
                                        <li><i class="fa fa-check"></i> <?php echo esc_html($beneficio); ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <button class="btn-producto">Más información</button>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="no-productos">
                <p>No hay productos disponibles en este momento.</p>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>