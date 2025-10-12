<?php if (!defined('ABSPATH')) exit; ?>

<section class="contactos-section" role="region" aria-label="<?php esc_attr_e('Formulario de contactos', 'menscoretherapy'); ?>">
  <div class="container">

    <!-- Título principal -->
    <div class="text-center mb-xl">
      <h1 class="section-title text-primary">
        <?php _e('contactos', 'menscoretherapy'); ?>
      </h1>
    </div>

    <?php
    // Procesamiento del formulario
    $errors = [];
    $sent = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mm_contactos_submit'])) {
      if (!mm_verify_nonce('mm_contactos')) {
        $errors[] = __('Verificación de seguridad fallida. Recarga la página.', 'menscoretherapy');
      } else {
        $name  = sanitize_text_field($_POST['name'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $msg   = wp_kses_post($_POST['message'] ?? '');

        // Validaciones
        if ($name === '')  $errors[] = __('El nombre es obligatorio.', 'menscoretherapy');
        if (!is_email($email)) $errors[] = __('Email no válido.', 'menscoretherapy');
        if ($msg === '')   $errors[] = __('El mensaje es obligatorio.', 'menscoretherapy');

        if (!$errors) {
          $to = get_option('admin_email');
          $subject = sprintf(__('Nuevo mensaje de %s', 'menscoretherapy'), $name);
          $body = "Nombre: {$name}\nEmail: {$email}\n\nMensaje:\n{$msg}";
          $headers = ['Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>"];

          if (wp_mail($to, $subject, $body, $headers)) {
            $sent = true;
          } else {
            $errors[] = __('No se pudo enviar el mensaje. Inténtalo más tarde.', 'menscoretherapy');
          }
        }
      }
    }

    // Mostrar mensajes de estado
    if ($sent) {
      echo '<div class="alert alert--success mb-lg" role="status" aria-live="polite">';
      echo '<i class="fa fa-check-circle mr-sm"></i>';
      echo esc_html__('Mensaje enviado correctamente. Gracias.', 'menscoretherapy');
      echo '</div>';
    } elseif ($errors) {
      echo '<div class="alert alert--error mb-lg" role="alert" aria-live="assertive">';
      echo '<i class="fa fa-exclamation-triangle mr-sm"></i>';
      echo '<ul class="alert__list">';
      foreach ($errors as $e) echo '<li>' . esc_html($e) . '</li>';
      echo '</ul></div>';
    }
    ?>

    <!-- Formulario de contactos -->
    <div class="contactos__form-wrapper max-w-2xl mx-auto">
      <div class="form-container neo-surface p-xl rounded-lg">

        <?php
        // Mostrar mensajes de error y éxito
        mm_display_form_errors('contact');
        mm_display_form_success('contact');
        ?>

        <form class="form space-y-md" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" novalidate>
          <input type="hidden" name="action" value="contactos_form">
          <?php wp_nonce_field('contactos_form_nonce', 'contactos_nonce_field'); ?>
          <?php mm_render_honeypot_fields(); ?>

          <!-- Campo nombre -->
          <div class="form-group">
            <label for="name" class="form-label">
              <?php _e('Nombre completo', 'menscoretherapy'); ?>
              <span class="text-error">*</span>
            </label>
            <input type="text"
              id="name"
              name="name"
              class="form-input neo-input"
              placeholder="<?php esc_attr_e('Tu nombre completo', 'menscoretherapy'); ?>"
              required
              maxlength="80"
              value="<?php echo esc_attr(mm_get_form_data('name', 'contact')); ?>">
          </div>

          <!-- Campo email -->
          <div class="form-group">
            <label for="email" class="form-label">
              <?php _e('Email', 'menscoretherapy'); ?>
              <span class="text-error">*</span>
            </label>
            <input type="email"
              id="email"
              name="email"
              class="form-input neo-input"
              placeholder="<?php esc_attr_e('tu@email.com', 'menscoretherapy'); ?>"
              required
              maxlength="120"
              value="<?php echo esc_attr(mm_get_form_data('email', 'contact')); ?>">
          </div>

          <!-- Campo mensaje -->
          <div class="form-group">
            <label for="message" class="form-label">
              <?php _e('Mensaje', 'menscoretherapy'); ?>
              <span class="text-error">*</span>
            </label>
            <textarea id="message"
              name="message"
              class="form-textarea neo-input"
              placeholder="<?php esc_attr_e('Cuéntanos cómo podemos ayudarte...', 'menscoretherapy'); ?>"
              rows="6"
              required
              maxlength="2000"><?php echo esc_textarea(mm_get_form_data('message', 'contact')); ?></textarea>
          </div>

          <!-- Información adicional -->
          <div class="form-info bg-light p-md rounded text-sm">
            <div class="flex flex--start gap-sm">
              <i class="fa fa-info-circle text-primary"></i>
              <div>
                <p class="mb-xs font-medium">
                  <?php _e('Te responderemos lo antes posible', 'menscoretherapy'); ?>
                </p>
                <p class="text-muted mb-0">
                  <?php _e('Tiempo de respuesta habitual: 24-48 horas', 'menscoretherapy'); ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Botón de envío -->
          <div class="form-actions">
            <button type="submit"
              name="mm_contactos_submit"
              class="btn btn--primary btn--lg btn--block">
              <i class="fa fa-paper-plane mr-sm"></i>
              <?php _e('Enviar mensaje', 'menscoretherapy'); ?>
            </button>
          </div>

        </form>
      </div>
    </div>

    <!-- Información de contactos adicional -->
    <div class="contactos__info mt-xl">
      <div class="grid grid--3-cols gap-lg">

        <!-- Teléfono -->
        <div class="contact-method text-center">
          <div class="contact-method__icon neo-surface p-lg rounded-full mb-md mx-auto w-fit">
            <i class="fa fa-phone text-primary text-xl"></i>
          </div>
          <h3 class="contact-method__title text-primary mb-sm">
            <?php _e('Teléfono', 'menscoretherapy'); ?>
          </h3>
          <p class="contact-method__info text-body">
            <a href="tel:+34666777888" class="text-inherit hover:text-primary">
              +34 666 777 888
            </a>
          </p>
        </div>

        <!-- Email -->
        <div class="contact-method text-center">
          <div class="contact-method__icon neo-surface p-lg rounded-full mb-md mx-auto w-fit">
            <i class="fa fa-envelope text-primary text-xl"></i>
          </div>
          <h3 class="contact-method__title text-primary mb-sm">
            <?php _e('Email', 'menscoretherapy'); ?>
          </h3>
          <p class="contact-method__info text-body">
            <a href="mailto:info@masajes.com" class="text-inherit hover:text-primary">
              info@masajes.com
            </a>
          </p>
        </div>

        <!-- Ubicación -->
        <div class="contact-method text-center">
          <div class="contact-method__icon neo-surface p-lg rounded-full mb-md mx-auto w-fit">
            <i class="fa fa-map-marker text-primary text-xl"></i>
          </div>
          <h3 class="contact-method__title text-primary mb-sm">
            <?php _e('Ubicación', 'menscoretherapy'); ?>
          </h3>
          <p class="contact-method__info text-body">
            Barcelona, España
          </p>
        </div>

      </div>
    </div>

  </div>
</section>