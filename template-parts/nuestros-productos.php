<?php
// Obtener productos desde la base de datos
$productos_query = new WP_Query(array(
    'post_type' => 'producto',
    'posts_per_page' => -1,
    'post_status' => 'publish'
));
?>

<section class="productos-section">
    <div class="productos-container">
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

<style>
    .productos-section {
        padding: 4rem 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .productos-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header h2 {
        font-size: 2.5rem;
        color: white;
        margin-bottom: 1rem;
    }

    .section-header p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        margin: 0 auto;
    }

    .productos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .producto-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .producto-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .producto-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .producto-icon i {
        font-size: 2rem;
        color: white;
    }

    .producto-card h3 {
        font-size: 1.5rem;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .producto-precio {
        font-size: 1.8rem;
        font-weight: bold;
        color: #e74c3c;
        margin-bottom: 1rem;
    }

    .producto-descripcion {
        color: #7f8c8d;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .beneficios-list {
        list-style: none;
        padding: 0;
        margin-bottom: 2rem;
        text-align: left;
    }

    .beneficios-list li {
        padding: 0.5rem 0;
        color: #555;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .beneficios-list i {
        color: #27ae60;
        font-size: 0.9rem;
    }

    .btn-producto {
        background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 25px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-producto:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
    }

    .no-productos {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .productos-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .section-header h2 {
            font-size: 2rem;
        }

        .producto-card {
            padding: 1.5rem;
        }
    }
</style>