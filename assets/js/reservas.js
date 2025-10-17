
    (function() {
        'use strict';

        const form = document.getElementById('reservasForm');
        if (!form) return;

        // Validación y feedback visual
        const requiredFields = form.querySelectorAll('[required]');

        requiredFields.forEach(field => {
            field.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    this.style.borderColor = '#e74c3c';
                } else {
                    this.style.borderColor = '';
                }
            });

            field.addEventListener('input', function() {
                this.style.borderColor = '';
            });
        });

        // Envío del formulario
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#e74c3c';
                }
            });

            if (isValid) {
                // Aquí puedes agregar AJAX o enviar el formulario
                alert('¡Solicitud de reserva enviada! Te contactaremos pronto para confirmar tu cita.');
                form.reset();
            } else {
                alert('Por favor, completa todos los campos obligatorios.');
            }
        });
    })();
