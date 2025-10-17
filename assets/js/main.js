/**
 * MensCore Therapy - Main JavaScript
 * Funcionalidades interactivas del tema
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('MensCore Therapy theme loaded');
    
    // ===== NAVEGACIÓN MÓVIL =====
    initMobileNavigation();
    
    // ===== SMOOTH SCROLL =====
    initSmoothScroll();
    
    // ===== ANIMACIONES DE ENTRADA =====
    initScrollAnimations();
    
    // ===== EFECTOS HOVER MEJORADOS =====
    initHoverEffects();
    
    // ===== INTEGRACIÓN WHATSAPP =====
    initWhatsAppIntegration();
    
    // ===== HEADER STICKY MEJORADO =====
    initStickyHeader();
    
    // ===== FOOTER STICKY CON COMPORTAMIENTO OPUESTO =====
    initStickyFooter();
});

// ===== NAVEGACIÓN MÓVIL =====
function initMobileNavigation() {
    const mobileMenuButton = document.querySelector('.mobile-menu-toggle');
    const navigation = document.querySelector('.main-navigation');
    
    if (mobileMenuButton && navigation) {
        mobileMenuButton.addEventListener('click', function() {
            navigation.classList.toggle('is-open');
            mobileMenuButton.classList.toggle('is-active');
            document.body.classList.toggle('menu-open');
        });
        
        // Cerrar menú al hacer clic en un enlace
        const navLinks = navigation.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navigation.classList.remove('is-open');
                mobileMenuButton.classList.remove('is-active');
                document.body.classList.remove('menu-open');
            });
        });
    }
}

// ===== SMOOTH SCROLL =====
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// ===== ANIMACIONES AL SCROLL =====
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Elementos a animar
    const animateElements = document.querySelectorAll(
        '.mm-home-service-card, .mm-home-product-card, .footer__content, .mm-home-Nobanner__content'
    );
    
    animateElements.forEach(el => {
        el.classList.add('animate-ready');
        observer.observe(el);
    });
}

// ===== EFECTOS HOVER MEJORADOS =====
function initHoverEffects() {
    // Cards de servicios con efecto tilt suave
    const cards = document.querySelectorAll('.mm-home-service-card, .mm-home-product-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Botones con efecto ripple
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255,255,255,0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
}

// ===== INTEGRACIÓN WHATSAPP =====
function initWhatsAppIntegration() {
    const whatsappLinks = document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp.com"]');
    
    whatsappLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Agregar mensaje personalizado si no existe
            const href = this.getAttribute('href');
            if (!href.includes('text=')) {
                e.preventDefault();
                const message = encodeURIComponent('Hola, estoy interesado en sus servicios de masajes profesionales. ¿Podrían darme más información?');
                const newHref = href + (href.includes('?') ? '&' : '?') + 'text=' + message;
                window.open(newHref, '_blank');
            }
        });
    });
}

// ===== HEADER STICKY MEJORADO =====
function initStickyHeader() {
    const header = document.querySelector('.header, .site-header');
    if (!header) return;
    
    let lastScrollY = window.scrollY;
    let ticking = false;
    
    function updateHeader() {
        const scrollY = window.scrollY;
        
        if (scrollY > 100) {
            header.classList.add('header--scrolled');
        } else {
            header.classList.remove('header--scrolled');
        }
        
        // Ocultar header al scroll hacia abajo, mostrar al scroll hacia arriba
        if (scrollY > lastScrollY && scrollY > 200) {
            header.classList.add('header--hidden');
        } else if (scrollY < lastScrollY) {
            header.classList.remove('header--hidden');
        }
        
        lastScrollY = scrollY;
        ticking = false;
    }
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', requestTick);
}

// ===== FOOTER STICKY CON COMPORTAMIENTO OPUESTO =====
function initStickyFooter() {
    const footer = document.querySelector('.footer');
    if (!footer) return;
    
    let lastScrollY = window.scrollY;
    let ticking = false;
    
    function updateFooter() {
        const scrollY = window.scrollY;
        
        // Comportamiento opuesto al header:
        // Ocultar footer al scroll hacia arriba, mostrar al scroll hacia abajo
        if (scrollY < lastScrollY && scrollY > 200) {
            footer.classList.add('footer--hidden');
        } else if (scrollY > lastScrollY) {
            footer.classList.remove('footer--hidden');
        }
        
        lastScrollY = scrollY;
        ticking = false;
    }
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateFooter);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', requestTick);
}

// ===== CSS DINÁMICO PARA ANIMACIONES =====
const style = document.createElement('style');
style.textContent = `
    .animate-ready {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }
    
    .animate-in {
        opacity: 1;
        transform: translateY(0);
    }
    
    .header--scrolled {
        background-color: rgba(245, 230, 221, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .header--hidden {
        transform: translateY(-100%);
        transition: transform 0.3s ease-in-out;
    }
    
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .menu-open {
        overflow: hidden;
    }
`;
document.head.appendChild(style);
