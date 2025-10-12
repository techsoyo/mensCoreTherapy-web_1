<?php
/**
 * Template Name: Servicios
 * Página de servicios con estructura original
 */

if (!defined('ABSPATH')) exit;

get_header();
?>

<main id="primary" class="page-servicios" role="main">
  <!-- Hero: usar template-part para servicios EXACTAMENTE como la estructura original -->
  <?php get_template_part('template-parts/servicios'); ?>
</main>

<?php get_footer(); ?>