<!DOCTYPE html>
@php
    // Version animée vs version statique « copie du PowerPoint » — voir config/cleartrack.php.
    $animations = config('cleartrack.animations');
    // Écran d'ouverture : uniquement sur l'accueil, et une fois par session.
    $splash = $animations && request()->routeIs('home') && ! session()->get('splash_vu');
    if ($splash) {
        session()->put('splash_vu', true);
    }
@endphp
<html lang="fr" @class(['splash-actif' => $splash]) data-animations="{{ $animations ? 'on' : 'off' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $metaTitle = trim($__env->yieldContent('title', 'ClearTrack® align — Aligneurs dentaires invisibles au Maroc'));
        $metaDescription = trim($__env->yieldContent('meta_description', 'ClearTrack® align : aligneurs dentaires transparents fabriqués au Maroc. Traitement orthodontique invisible, confortable et abordable via des dentistes certifiés.'));
        $ogImage = trim($__env->yieldContent('og_image', asset('assets/brand/favicon.png')));
    @endphp
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / réseaux sociaux --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ClearTrack® align">
    <meta property="og:locale" content="fr_MA">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/png" href="{{ asset('assets/brand/favicon.png') }}">
    {{-- Poppins est désormais servie depuis notre propre domaine (voir les
         @font-face en tête de app.css, D66). Les deux <link> vers
         fonts.bunny.net sont supprimés : la feuille de style tierce bloquait
         le premier affichage le temps d'un DNS, d'un TLS et d'un aller-retour.

         La graisse 400 est préchargée : c'est celle du corps de texte, donc
         la seule dont le navigateur a besoin immédiatement. Sans ce preload,
         il ne la découvrirait qu'après avoir analysé le CSS. `crossorigin`
         est obligatoire sur un preload de police, même en même origine —
         sans lui le fichier serait téléchargé deux fois. --}}
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('assets/fonts/poppins-latin-400-normal.woff2') }}">
    @vite(array_merge(
        ['resources/css/app.css', 'resources/js/app.js'],
        $animations ? ['resources/css/animations.css', 'resources/js/animations.js'] : []
    ))

    {{-- Organisation (JSON-LD, sur toutes les pages) --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Dentist',
        'name' => 'ClearTrack® align — Go dental SARL',
        'url' => url('/'),
        'logo' => asset('assets/brand/logo-on-white.png'),
        'telephone' => '+212693133170',
        'email' => 'contact@cleartrack.ma',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => '16, Résidence Ifrane, Avenue Hassan II, Agdal',
            'addressLocality' => 'Rabat',
            'postalCode' => '10090',
            'addressCountry' => 'MA',
        ],
        'sameAs' => [],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @stack('head')
</head>
<body class="min-h-screen bg-white">
    @if ($splash)
        {{-- Écran d'ouverture au logo (≤ 1,4 s), retiré du DOM par animations.js --}}
        <div class="splash" data-splash aria-hidden="true">
            <img src="{{ asset('assets/brand/logo-on-blue.png') }}" alt="">
        </div>
    @endif

    <a href="#contenu" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded focus:bg-white focus:px-4 focus:py-2 focus:text-ppt-blue">Aller au contenu</a>

    <x-nav />

    <main id="contenu">
        @yield('content')
    </main>

    <x-footer />

    <x-whatsapp-button />
</body>
</html>
