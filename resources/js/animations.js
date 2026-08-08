/*
 | Couche « version animée » — chargée uniquement si config('cleartrack.animations').
 | Amélioration progressive : sans ce fichier, rien n'est masqué ni déplacé.
 */

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
// Sous 768 px on simplifie : l'écran d'ouverture est conservé (il est court et peu coûteux)
// mais l'effet machine à écrire est désactivé — sur petit écran le texte occupe
// plusieurs lignes et le rideau se lit mal.
const petitEcran = window.matchMedia('(max-width: 767px)').matches;

/* ── 1. Écran d'ouverture au logo ─────────────────────────────────────── */
function ecranOuverture() {
    const splash = document.querySelector('[data-splash]');
    if (!splash) return;

    if (reduceMotion) {
        splash.remove();
        document.documentElement.classList.remove('splash-actif');
        return;
    }

    // Retire le voile dès la fin de l'animation de sortie (≈ 1,3 s), avec une
    // sécurité au cas où l'événement ne se déclenche pas (onglet en arrière-plan).
    const nettoyer = () => {
        splash.remove();
        document.documentElement.classList.remove('splash-actif');
    };
    splash.addEventListener('animationend', (e) => {
        if (e.animationName === 'splash-out') nettoyer();
    });
    setTimeout(nettoyer, 1800);
}

/* ── 2. Apparition « machine à écrire » au défilement ─────────────────── */
function machineAEcrire() {
    const cibles = [...document.querySelectorAll('[data-typing]')];
    if (!cibles.length || reduceMotion || petitEcran || !('IntersectionObserver' in window)) return;

    const PAS_MS = 55; // délai entre deux mots

    cibles.forEach((el) => {
        // On n'enveloppe que du texte brut : si la cible contient déjà du balisage,
        // on la laisse telle quelle plutôt que d'écraser son contenu.
        if (el.children.length > 0) return;
        const mots = el.textContent.split(/(\s+)/);
        el.textContent = '';
        let i = 0;
        mots.forEach((mot) => {
            if (/^\s+$/.test(mot)) {
                el.appendChild(document.createTextNode(mot)); // espaces conservés
                return;
            }
            const span = document.createElement('span');
            span.className = 'typing-mot';
            span.style.setProperty('--i', String(i++));
            span.textContent = mot;
            el.appendChild(span);
        });
        el.dataset.typingDuree = String(i * PAS_MS);
        el.style.setProperty('--typing-pas', `${PAS_MS}ms`);
        el.classList.add('typing-pret');
    });

    // On observe un CONTENEUR, jamais la cible elle-même : `typing-pret` applique
    // clip-path: inset(0 100% 0 0), et une zone découpée à zéro n'est jamais
    // « intersecting » pour IntersectionObserver — la cible ne pourrait donc
    // jamais déclencher sa propre animation.
    const conteneurs = new Map();
    cibles.forEach((el) => {
        const conteneur = el.closest('[data-typing-group]') ?? el.parentElement;
        if (!conteneur) return;
        if (!conteneurs.has(conteneur)) conteneurs.set(conteneur, []);
        conteneurs.get(conteneur).push(el);
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const groupe = conteneurs.get(entry.target) ?? [];
                // Cascade : les lignes d'un même bloc s'écrivent l'une après l'autre.
                let depart = 0;
                groupe.forEach((el) => {
                    const duree = Number(el.dataset.typingDuree ?? 400);
                    setTimeout(() => {
                        el.classList.add('typing-lance');
                        // Curseur retiré une fois le dernier mot affiché
                        setTimeout(() => el.classList.add('typing-fini'), duree + 120);
                    }, depart);
                    depart += duree + 120;
                });
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.25, rootMargin: '0px 0px -10% 0px' }
    );

    conteneurs.forEach((_, conteneur) => observer.observe(conteneur));
}

ecranOuverture();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', machineAEcrire);
} else {
    machineAEcrire();
}
