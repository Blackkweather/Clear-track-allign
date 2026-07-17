{{-- Sous-navigation Espace Médecin (PPT slides 77-88) --}}
<nav class="mx-auto max-w-7xl px-4 sm:px-6" aria-label="Espace Médecin">
    <div class="-mt-7 flex flex-wrap gap-3 rounded-2xl bg-white p-4 shadow-lg">
        <a href="{{ route('medecin.demarrer') }}" class="{{ request()->routeIs('medecin.demarrer') ? 'btn-brand' : 'btn-outline-brand' }} text-xs">Démarrer un traitement</a>
        <a href="{{ route('medecin.certifie') }}" class="{{ request()->routeIs('medecin.certifie') ? 'btn-brand' : 'btn-outline-brand' }} text-xs">Devenir certifié Cleartrack®</a>
        <a href="{{ route('medecin.telechargements') }}" class="{{ request()->routeIs('medecin.telechargements') ? 'btn-brand' : 'btn-outline-brand' }} text-xs">Centre de téléchargement</a>
        <a href="{{ route('medecin.faq') }}" class="{{ request()->routeIs('medecin.faq') ? 'btn-brand' : 'btn-outline-brand' }} text-xs">FAQ Médecin</a>
    </div>
</nav>
