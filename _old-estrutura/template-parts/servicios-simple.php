<?php if (!defined('ABSPATH')) exit; ?>

<section class="hero">
  <div class="container">
    <h1>Servicios</h1>
    
    <?php
    // Obtener servicios de la base de datos
    $servicios = get_servicios_data();
    
    if (!empty($servicios)) :
    ?>
      <div class="grid grid--3">
        <?php foreach ($servicios as $servicio) : ?>
          <div class="card">
            <h3><?php echo $servicio['nombre']; ?></h3>
            <p><?php echo $servicio['descripcion']; ?></p>
            <?php if ($servicio['precio']) : ?>
              <p><strong>Precio: €<?php echo $servicio['precio']; ?></strong></p>
            <?php endif; ?>
            <?php if ($servicio['duracion']) : ?>
              <p><strong>Duración: <?php echo $servicio['duracion']; ?></strong></p>
            <?php endif; ?>
            <a href="/reservas/" class="btn">Reservar</a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else : ?>
      <p>No hay servicios disponibles actualmente.</p>
    <?php endif; ?>
  </div>
</section>