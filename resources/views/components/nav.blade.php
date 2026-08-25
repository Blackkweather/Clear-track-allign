{{-- Navigation principale (référence : PPT slides 2, 18, 27…)
     Fond : bleu exact du PPT (#2A9EFC via .bg-waves), demandé explicitement par le client
     en réunion. Voir CONTENT-DECISIONS.md D19 pour l'arbitrage avec le contraste WCAG. --}}
<header class="bg-waves sticky top-0 z-40 shadow-md" x-data="{ open: false }">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center" aria-label="ClearTrack align — Accueil">
            <img src="{{ asset('assets/brand/logo-on-blue.png') }}" alt="ClearTrack® align" class="h-12 w-auto">
        </a>

        <nav class="hidden items-center gap-6 lg:flex" aria-label="Navigation principale">
            {{-- « Accueil » en premier : le client juge le clic sur le logo trop peu évident --}}
            <a href="{{ route('home') }}" class="flex items-center gap-1.5 text-sm font-medium text-white hover:text-brand-100 {{ request()->routeIs('home') ? 'underline underline-offset-4' : '' }}"
               @if (request()->routeIs('home')) aria-current="page" @endif>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 11l9-8 9 8M5 10v10h5v-6h4v6h5V10"/>
                </svg>
                Accueil
            </a>
            <a href="{{ route('pourquoi') }}" class="text-sm font-medium text-white hover:text-brand-100 {{ request()->routeIs('pourquoi') ? 'underline underline-offset-4' : '' }}">Pourquoi&nbsp;?</a>
            <a href="{{ route('avantages') }}" class="text-sm font-medium text-white hover:text-brand-100 {{ request()->routeIs('avantages') ? 'underline underline-offset-4' : '' }}">Avantages</a>
            @if (config('cleartrack.blog'))
                <a href="{{ route('blog.index') }}" class="text-sm font-medium text-white hover:text-brand-100 {{ request()->routeIs('blog.*') ? 'underline underline-offset-4' : '' }}">Blog</a>
            @endif
            <a href="{{ route('faq') }}" class="text-sm font-medium text-white hover:text-brand-100 {{ request()->routeIs('faq') ? 'underline underline-offset-4' : '' }}">FAQ</a>
            <a href="{{ route('a-propos') }}" class="text-sm font-medium text-white hover:text-brand-100 {{ request()->routeIs('a-propos') ? 'underline underline-offset-4' : '' }}">À propos</a>
            <a href="{{ route('rdv') }}" class="text-sm font-medium text-white hover:text-brand-100 {{ request()->routeIs('rdv') ? 'underline underline-offset-4' : '' }}">Prendre RDV</a>
            <a href="{{ route('medecin.index') }}" class="btn-white !py-2 text-xs">Espace Médecin</a>
        </nav>

        <button type="button" class="rounded p-2 text-white lg:hidden" @click="open = !open" :aria-expanded="open" aria-controls="menu-mobile" aria-label="Ouvrir le menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav id="menu-mobile" x-show="open" x-cloak class="border-t border-white/20 px-4 pb-4 lg:hidden" aria-label="Navigation mobile">
        <div class="flex flex-col gap-1 pt-2">
            <a href="{{ route('home') }}" class="flex items-center gap-2 rounded px-3 py-2 text-sm font-medium text-white hover:bg-white/10"
               @if (request()->routeIs('home')) aria-current="page" @endif>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 11l9-8 9 8M5 10v10h5v-6h4v6h5V10"/>
                </svg>
                Accueil
            </a>
            <a href="{{ route('pourquoi') }}" class="rounded px-3 py-2 text-sm font-medium text-white hover:bg-white/10">Pourquoi&nbsp;?</a>
            <a href="{{ route('avantages') }}" class="rounded px-3 py-2 text-sm font-medium text-white hover:bg-white/10">Avantages</a>
            @if (config('cleartrack.blog'))
                <a href="{{ route('blog.index') }}" class="rounded px-3 py-2 text-sm font-medium text-white hover:bg-white/10">Blog</a>
            @endif
            <a href="{{ route('faq') }}" class="rounded px-3 py-2 text-sm font-medium text-white hover:bg-white/10">FAQ</a>
            <a href="{{ route('a-propos') }}" class="rounded px-3 py-2 text-sm font-medium text-white hover:bg-white/10">À propos</a>
            <a href="{{ route('rdv') }}" class="rounded px-3 py-2 text-sm font-medium text-white hover:bg-white/10">Prendre RDV</a>
            <a href="{{ route('medecin.index') }}" class="btn-white mt-2 self-start text-xs">Espace Médecin</a>
        </div>
    </nav>
</header>
