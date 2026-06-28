import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

// Scroll-triggered reveal animations
document.addEventListener('DOMContentLoaded', () => {
    initRevealAnimations();
    initNavbarScroll();
});

function initRevealAnimations() {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                }
            });
        },
        {
            threshold: 0.08,
            rootMargin: '0px 0px -40px 0px'
        }
    );

    document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
        observer.observe(el);
    });
}

function initNavbarScroll() {
    const navbar = document.querySelector('[data-navbar]');
    if (!navbar) return;

    const onScroll = () => {
        if (window.scrollY > 80) {
            navbar.classList.add('glass-nav', 'shadow-warm');
            navbar.classList.remove('bg-transparent');
        } else {
            navbar.classList.remove('glass-nav', 'shadow-warm');
            navbar.classList.add('bg-transparent');
        }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

// Smooth scroll for anchor links
document.addEventListener('click', (e) => {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;

    const target = document.querySelector(link.getAttribute('href'));
    if (!target) return;

    e.preventDefault();
    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
});
