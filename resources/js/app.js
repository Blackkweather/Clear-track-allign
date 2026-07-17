import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

/**
 * Animations premium — discrètes, GPU-only (transform/opacity), respectent
 * prefers-reduced-motion. Amélioration progressive : sans JS, tout reste
 * visible normalement (rien n'est masqué par défaut en CSS).
 */
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!reduceMotion) {
    // Révélation douce au défilement (cartes, titres de section, images) — une seule fois.
    // Exclus : contenu à l'intérieur des carrousels (diapositives hors champ via
    // overflow-hidden horizontal — elles ne croiseraient jamais le viewport au
    // défilement vertical et resteraient invisibles tant que l'utilisateur ne
    // clique pas sur "suivant").
    const revealSelector = '.card, .section-title, main img:not(.no-reveal)';
    const revealTargets = [...document.querySelectorAll(revealSelector)]
        .filter((el) => !el.closest('[data-carousel-slide]'));

    if ('IntersectionObserver' in window && revealTargets.length) {
        revealTargets.forEach((el) => el.classList.add('will-reveal'));

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        // Léger décalage entre éléments proches pour un effet naturel
                        el.style.transitionDelay = `${Math.min(i * 40, 200)}ms`;
                        el.classList.add('is-visible');
                        observer.unobserve(el);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
        );

        revealTargets.forEach((el) => observer.observe(el));
    }

    // Ombre de la nav qui s'accentue légèrement au défilement (sticky déjà en place)
    const header = document.querySelector('header.bg-waves-dark');
    if (header) {
        header.style.transition = 'box-shadow 250ms ease';
        const onScroll = () => {
            header.style.boxShadow = window.scrollY > 12
                ? '0 8px 24px -8px rgba(0,0,0,.35)'
                : '';
        };
        window.addEventListener('scroll', onScroll, { passive: true });
    }
}
