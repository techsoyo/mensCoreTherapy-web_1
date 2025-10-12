/**
 * Sistema de navegación dinámica para Menscore Therapy
 * Maneja el cambio entre secciones de la home page
 */

document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.content-section');

    // Función para mostrar sección
    function showSection(sectionId) {
        // Ocultar todas las secciones
        sections.forEach(section => {
            section.classList.remove('active');
        });
        
        // Remover clase active de todos los links
        navLinks.forEach(link => {
            link.classList.remove('active');
        });

        // Mostrar la sección seleccionada
        const targetSection = document.getElementById(sectionId + '-section');
        if (targetSection) {
            targetSection.classList.add('active');
        }

        // Activar el link correspondiente en el header
        const headerLinks = document.querySelectorAll('#nav-menu .nav-link');
        headerLinks.forEach(link => {
            if (link.getAttribute('data-section') === sectionId) {
                link.classList.add('active');
            }
        });
    }

    // Agregar eventos a todos los links de navegación (header y contenido)
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const sectionId = this.getAttribute('data-section');
            if (sectionId) {
                showSection(sectionId);
                
                // Scroll suave al inicio de la página
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Mostrar home por defecto
    showSection('home');
    
    // Activar el primer link del header por defecto
    const firstHeaderLink = document.querySelector('#nav-menu .nav-link[data-section="home"]');
    if (firstHeaderLink) {
        firstHeaderLink.classList.add('active');
    }
});