
    (function() {
        'use strict';

        const form = document.getElementById('contactForm');
        if (!form) return;

        // Función para mostrar mensajes
        function showMessage(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert--' + type;
            alertDiv.innerHTML = '<p>' + message + '</p><button class="alert-close">×</button>';

            form.insertAdjacentElement('beforebegin', alertDiv);

            // Auto-cerrar después de 5 segundos
            setTimeout(function() {
                alertDiv.remove();
            }, 5000);

            // Botón de cerrar
            alertDiv.querySelector('.alert-close').addEventListener('click', function() {
                alertDiv.remove();
            });
        }

        // Validación del formulario
        function validateForm() {
            const inputs = form.querySelectorAll('[required]');
            let isValid = true;

            inputs.forEach(function(input) {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });

            return isValid;
        }

        // Validación en tiempo real
        form.querySelectorAll('input, select, textarea').forEach(function(input) {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });

        // Envío del formulario
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateForm()) {
                showMessage('Por favor, completa todos los campos requeridos.', 'error');
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('.btn-text');

            // Deshabilitar botón
            submitBtn.disabled = true;
            btnText.textContent = 'Enviando...';

            // Simular envío (reemplazar con AJAX real)
            setTimeout(function() {
                showMessage('¡Gracias por tu mensaje! Te contactaremos pronto.', 'success');
                form.reset();
                submitBtn.disabled = false;
                btnText.textContent = 'Enviar Mensaje';
            }, 1000);
        });
    })();