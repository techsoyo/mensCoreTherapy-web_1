document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todas las flip cards
    const flipCards = document.querySelectorAll('.flip-card');
    
    // Solo aplicar en dispositivos táctiles
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        flipCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // Prevenir que el click active enlaces en la card frontal
                if (!this.classList.contains('active')) {
                    e.preventDefault();
                }
                
                // Toggle de la clase active
                this.classList.toggle('active');
                
                // Cerrar otras cards cuando se abre una nueva
                flipCards.forEach(otherCard => {
                    if (otherCard !== card) {
                        otherCard.classList.remove('active');
                    }
                });
            });
            
        });
        
        // Cerrar cards al hacer click fuera
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.flip-card')) {
                flipCards.forEach(card => {
                    card.classList.remove('active');
                });
            }
        });
    }
});