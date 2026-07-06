import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    window.initRevealAnimations();
    initNavbarScroll();
    initCounters();
    initHeroParticles('.hero-particles');
});

window.initRevealAnimations = function() {
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
};

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

function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.dataset.counter);
                const duration = 2000;
                const steps = 60;
                const stepValue = target / steps;
                let current = 0;

                const timer = setInterval(() => {
                    current += stepValue;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, duration / steps);

                observer.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(el => observer.observe(el));
}

function initHeroParticles(containerSelector) {
    const container = document.querySelector(containerSelector);
    if (!container) return;

    for (let i = 0; i < 8; i++) {
        const particle = document.createElement('div');
        particle.className = 'hero-particle';
        const size = 2 + Math.random() * 4;
        Object.assign(particle.style, {
            width: size + 'px',
            height: size + 'px',
            background: `rgba(201, 168, 76, ${0.15 + Math.random() * 0.2})`,
            left: Math.random() * 100 + '%',
            top: Math.random() * 100 + '%',
            animation: `float ${5 + Math.random() * 4}s ease-in-out ${Math.random() * 3}s infinite`,
        });
        container.appendChild(particle);
    }
}

document.addEventListener('click', (e) => {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;

    const target = document.querySelector(link.getAttribute('href'));
    if (!target) return;

    e.preventDefault();
    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
});
