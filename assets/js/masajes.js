/**
 * Masajes JavaScript - Versión Optimizada
 * Maneja la interactividad de las cards de masajes y reservas
 */

document.addEventListener('DOMContentLoaded', function() {
  // Inicializar todas las funcionalidades
  initCardFlip();
  initReservaButtons();
  animateCardsOnScroll();
  initHoverEffects();
});

/**
 * Funcionalidad de flip para las cards
 */
function initCardFlip() {
  const cards = document.querySelectorAll('.card-flip');
  
  cards.forEach(card => {
    card.addEventListener('click', function(e) {
      // Evitar el flip si se hace clic en el botón de reservar
      if (e.target.classList.contains('btn-reservar')) {
        return;
      }
      
      this.classList.toggle('is-flipped');
    });
  });
}

/**
 * Funcionalidad de los botones de reserva
 */
function initReservaButtons() {
  const botonesReservar = document.querySelectorAll('.btn-reservar');
  
  botonesReservar.forEach(boton => {
    boton.addEventListener('click', function(e) {
      e.stopPropagation(); // Evitar que se active el flip
      
      const nombreMasaje = this.getAttribute('data-masaje');
      reservarMasaje(nombreMasaje);
    });
  });
}

/**
 * Función para reservar masajes
 * @param {string} nombreMasaje - Nombre del masaje a reservar
 */
function reservarMasaje(nombreMasaje) {
  if (!nombreMasaje) {
    console.error('No se pudo obtener el nombre del masaje');
    return;
  }
  
  // Usar la URL proporcionada por WordPress via wp_localize_script
  const reservasUrl = typeof masajesData !== 'undefined' && masajesData.reservasUrl 
    ? masajesData.reservasUrl 
    : '/reservas/'; // Fallback
  
  // Redirigir a la página de reservas con el masaje seleccionado
  window.location.href = reservasUrl + '?masaje=' + encodeURIComponent(nombreMasaje);
}

/**
 * Animación de entrada para las cards al hacer scroll
 */
function animateCardsOnScroll() {
  const cards = document.querySelectorAll('.card-flip');
  
  // Verificar si el navegador soporta IntersectionObserver
  if (!window.IntersectionObserver) {
    // Fallback para navegadores antiguos
    cards.forEach(card => {
      card.classList.add('animate-in');
    });
    return;
  }
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.classList.add('animate-in');
        }, index * 100);
        
        // Dejar de observar una vez que se ha animado
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  });

  cards.forEach(card => {
    observer.observe(card);
  });
}

/**
 * Efectos de hover suaves para las cards
 */
function initHoverEffects() {
  const cards = document.querySelectorAll('.card-flip');
  
  cards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-5px)';
      this.style.transition = 'transform 0.3s ease';
    });

    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });
}

/**
 * Función de utilidad para mostrar mensajes de error
 * @param {string} mensaje - Mensaje de error a mostrar
 */
function mostrarError(mensaje) {
  console.error('Error en masajes.js:', mensaje);
  
  // Opcional: mostrar un mensaje visual al usuario
  // Esto se puede personalizar según el diseño del sitio
  if (typeof console !== 'undefined') {
    console.warn('Si ves este mensaje, contacta al administrador del sitio.');
  }
}

/**
 * Función para limpiar event listeners si es necesario
 * Útil para SPA o cuando se recarga contenido dinámicamente
 */
function cleanup() {
  const cards = document.querySelectorAll('.card-flip');
  const botones = document.querySelectorAll('.btn-reservar');
  
  // Remover event listeners existentes si es necesario
  cards.forEach(card => {
    card.replaceWith(card.cloneNode(true));
  });
  
  botones.forEach(boton => {
    boton.replaceWith(boton.cloneNode(true));
  });
}

// Exportar funciones para uso externo si es necesario
window.MasajesJS = {
  reservarMasaje: reservarMasaje,
  cleanup: cleanup,
  reinit: function() {
    cleanup();
    initCardFlip();
    initReservaButtons();
    initHoverEffects();
  }
};