<?php

/**
 * Template part for displaying products with flip cards
 * This template handles the products section with flip effect
 */
?>

<section class="productos-section">
    <div class="productos-overlay"></div>
    <div class="productos-container container">
        <header class="productos-header">
            <h2 class="section-title">Nuestros Productos</h2>
            <p class="section-subtitle">Descubre nuestra selección de productos para tu bienestar</p>
        </header>

        <div class="productos-grid">
            <?php
            // Query para productos
            $args = array(
                'post_type' => 'producto',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );

            $productos_query = new WP_Query($args);

            if ($productos_query->have_posts()) :
                while ($productos_query->have_posts()) : $productos_query->the_post();

                    // Obtener campos personalizados
                    $precio = get_post_meta(get_the_ID(), '_producto_precio', true);
                    $icono = get_post_meta(get_the_ID(), '_producto_icono', true);
                    $beneficios = get_post_meta(get_the_ID(), '_producto_beneficios', true);
            ?>
                    <article class="flip-card">
                        <div class="flip-card-inner">
                            <!-- CARA FRONTAL -->
                            <div class="flip-card-front">
                                <div class="producto-image-wrapper">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large', array('class' => 'producto-imagen')); ?>
                                    <?php else : ?>
                                        <div class="producto-imagen producto-sin-imagen" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">📦</div>
                                    <?php endif; ?>
                                </div>
                                <div class="producto-content">
                                    <h3 class="producto-nombre"><?php the_title(); ?></h3>
                                    <div class="producto-descripcion">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                    </div>
                                    <div class="flip-indicator">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span>Ver Beneficios y Precios</span>
                                    </div>
                                </div>
                            </div>

                            <!-- CARA TRASERA -->
                            <div class="flip-card-back">
                                <div class="precios-wrapper">

                                    <?php if ($icono) : ?>
                                        <div class="producto-icono">
                                            <i class="<?php echo esc_attr($icono); ?>"></i>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($beneficios) : ?>
                                        <div class="producto-beneficios">
                                            <h4 class="beneficios-titulo">Beneficios</h4>
                                            <div class="beneficios-lista">
                                                <?php
                                                $beneficios_array = explode("\n", $beneficios);
                                                foreach ($beneficios_array as $beneficio) :
                                                    $beneficio = trim($beneficio);
                                                    if (!empty($beneficio)) :
                                                ?>
                                                        <div class="beneficio-item">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            <span><?php echo esc_html($beneficio); ?></span>
                                                        </div>
                                                <?php
                                                    endif;
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($precio) : ?>
                                        <div class="producto-precio-wrapper">
                                            <div class="precio-badge">
                                                <span class="precio-valor"><?php echo esc_html($precio); ?>€</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                               </div>
                            </div>
                        </div>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <div class="no-productos-wrapper">
                    <p class="no-productos">No hay productos disponibles en este momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>