document.addEventListener('DOMContentLoaded', function() {
  // Manejar flip de tarjetas con nueva estructura
  const flipCards = document.querySelectorAll('.mm-servicio-card');

  flipCards.forEach(card => {
    card.addEventListener('click', function(e) {
      // No hacer flip si se hace clic en un botón
      if (!e.target.closest('.btn')) {
        this.classList.toggle('is-flipped');
      }
    });

    // Accesibilidad con teclado
    card.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        this.classList.toggle('is-flipped');
      }
    });

    // Hacer las tarjetas focusables
    if (!card.hasAttribute('tabindex')) {
      card.setAttribute('tabindex', '0');
    }

    // Añadir role para accesibilidad
    if (!card.hasAttribute('role')) {
      card.setAttribute('role', 'button');
    }

    // Añadir aria-label
    const titleElement = card.querySelector('.mm-servicio-card__title');
    if (titleElement && !card.hasAttribute('aria-label')) {
      card.setAttribute('aria-label', `Ver detalles de ${titleElement.textContent}`);
    }
  });

  // Compatibilidad con tarjetas antiguas
  const oldFlipCards = document.querySelectorAll('.card--flip');
  oldFlipCards.forEach(card => {
    card.addEventListener('click', function(e) {
      if (!e.target.closest('.btn')) {
        this.classList.toggle('is-flipped');
      }
    });

    card.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        this.classList.toggle('is-flipped');
      }
    });

    if (!card.hasAttribute('tabindex')) {
      card.setAttribute('tabindex', '0');
    }
  });

  // Smooth scrolling para enlaces internos
  const internalLinks = document.querySelectorAll('a[href^="#"]');
  internalLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);
      
      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
});