@extends('layouts.app')

@section('title', 'ClearTrack® align — Aligneurs dentaires invisibles au Maroc')

@section('content')
    {{-- HÉRO (PPT slide 2) --}}
    <section class="bg-waves relative overflow-hidden">
        <div class="mx-auto grid max-w-7xl items-center gap-8 px-4 py-16 sm:px-6 md:grid-cols-2 md:py-24">
            <div class="text-white">
                {{-- Échelle PPT slide 2 : sur-titre 28 pt (~42 px), « SANS FIL » 36 pt en gras --}}
                <p class="hero-in-1 text-2xl font-medium md:text-[2.5rem] md:leading-tight">Optez pour la solution</p>
                <h1 class="hero-in-2 mt-2 text-5xl font-extrabold leading-none tracking-tight md:text-[3.5rem]">SANS FIL</h1>
                <p class="hero-in-3 mt-4 text-xl font-semibold md:text-[1.75rem]">Choisissez ClearTrack Align&nbsp;!</p>
                <div class="hero-in-4 mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('pourquoi') }}" class="btn-white">Découvrir</a>
                    <a href="{{ route('rdv') }}" class="btn-outline-white">Prendre RDV</a>
                </div>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('assets/hero-aligner.png') }}"
                     alt="Aligneur dentaire transparent ClearTrack align"
                     class="animate-float no-reveal w-72 max-w-full drop-shadow-2xl md:w-96" fetchpriority="high">
            </div>
        </div>
    </section>

    {{-- LES 5 QUALITÉS (PPT slide 3) : photo annotée avec lignes de rappel — section 2/10 : BLANC --}}
    <section class="bg-white" aria-labelledby="qualites-titre">
        <h2 id="qualites-titre" class="sr-only">Les qualités des aligneurs ClearTrack</h2>

        {{-- Desktop / tablette : diagramme annoté fidèle au PPT — bord à bord (les doigts touchent le bord gauche de l'écran, comme sur la diapo 16:9) --}}
        <div class="relative hidden aspect-[16/9] w-full md:block">
            <img src="{{ asset('assets/ppt/slide04_0.png') }}" alt="" aria-hidden="true"
                 class="absolute inset-0 h-full w-full object-contain object-left" loading="lazy">

            <svg viewBox="0 0 1000 563" class="pointer-events-none absolute inset-0 h-full w-full stroke-brand-500" aria-hidden="true">
                <line x1="160" y1="115" x2="270" y2="140" stroke="currentColor" stroke-width="1.5"/>
                <line x1="510" y1="112" x2="655" y2="112" stroke="currentColor" stroke-width="1.5"/>
                <line x1="520" y1="212" x2="655" y2="212" stroke="currentColor" stroke-width="1.5"/>
                <line x1="475" y1="285" x2="655" y2="285" stroke="currentColor" stroke-width="1.5"/>
                <line x1="470" y1="365" x2="655" y2="365" stroke="currentColor" stroke-width="1.5"/>
            </svg>

            <span class="absolute font-bold text-brand-600" style="left: 3%; top: 17%;">Amovible</span>
            <span class="absolute font-bold text-brand-600" style="left: 66%; top: 15%;">Hygiénique</span>
            <span class="absolute font-bold text-brand-600" style="left: 66%; top: 33%;">Confortable</span>
            <span class="absolute font-bold text-brand-600" style="left: 66%; top: 47%;">Discret</span>
            <span class="absolute font-bold text-brand-600" style="left: 66%; top: 61%;">Efficace</span>

            <div class="absolute inset-x-0 bottom-6 text-center">
                <a href="{{ route('pourquoi') }}" class="btn-outline-brand">En savoir plus</a>
            </div>
        </div>

        {{-- Mobile : liste simple (le diagramme annoté ne tient pas sur petit écran) --}}
        <div class="px-4 py-12 sm:px-6 md:hidden">
            <div class="flex justify-center">
                <img src="{{ asset('assets/ppt/slide04_0.png') }}" alt="Aligneur ClearTrack tenu entre deux doigts"
                     class="h-40 w-auto object-contain" loading="lazy">
            </div>
            <ul class="mt-6 grid grid-cols-2 gap-4 text-center">
                @foreach (['Hygiénique', 'Confortable', 'Discret', 'Amovible', 'Efficace'] as $qualite)
                    <li class="rounded-xl border border-brand-300 py-3 font-bold text-brand-600">{{ $qualite }}</li>
                @endforeach
            </ul>
            <div class="mt-6 text-center">
                <a href="{{ route('pourquoi') }}" class="btn-brand">En savoir plus</a>
            </div>
        </div>
    </section>

    {{-- DENTISTES EXPERTS (PPT slide 4) --}}
    <section class="bg-waves" aria-labelledby="experts-titre">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="text-white">
                <h2 id="experts-titre" class="section-title-invert">Traitement fourni par des dentistes experts dans des cabinets et cliniques dentaires</h2>
                <div class="mt-4 h-1 w-16 rounded bg-white/70"></div>
                <p class="texte-ppt mt-6 text-white/90">Votre traitement sera mené, géré et suivi par nos dentistes certifiés dans des cliniques dentaires entièrement équipées afin de garantir un traitement facile et sans douleurs.</p>
                <a href="{{ route('rdv') }}" class="btn-white mt-8">En savoir plus</a>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('assets/ppt/slide04_experts.png') }}" alt="Une assistante dentaire et un dentiste examinant une radiographie dentaire"
                     class="w-full max-w-md" loading="lazy">
            </div>
        </div>
    </section>

    {{-- CLEARTRACK EN 4 ÉTAPES (PPT slides 5-8) — section 4/10 : BLANC --}}
    <section class="mx-auto max-w-7xl bg-white px-4 py-16 sm:px-6" aria-labelledby="etapes-titre">
        <h2 id="etapes-titre" class="section-title text-center">Cleartrack® align en 4 étapes</h2>
        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @php
                $etapes = [
                    ['n' => 1, 'titre' => 'Consultation gratuite', 'texte' => 'Une de nos cliniques partenaires ou cabinets proches de chez vous effectueront un examen et vous feront savoir si votre sourire peut être amélioré grâce aux aligneurs Cleartrack®.', 'img' => 'assets/ppt/slide05_0.jpg'],
                    ['n' => 2, 'titre' => 'Nous prenons vos empreintes', 'texte' => 'Nous avons besoin d’une empreinte de vos dents que nous numériserons et utiliserons pour créer un fichier de conception assistée par ordinateur (CAO). Nous utilisons les dernières technologies en matière de dentisterie numérique pour concevoir le plan de traitement le plus approprié pour vous.', 'img' => 'assets/ppt/slide06_0.jpg'],
                    ['n' => 3, 'titre' => 'Vérification de votre plan de traitement', 'texte' => 'Une simulation de votre plan de traitement en 3D et vidéos sont envoyés à vous et à votre médecin pour approbation. Une fois votre approbation obtenue, nous procédons à la fabrication de vos aligneurs sur mesure.', 'img' => 'assets/ppt/slide07_0.jpg'],
                    ['n' => 4, 'titre' => 'Préparez-vous à avoir un sourire hollywoodien !', 'texte' => 'Nous vous enverrons une série de gouttières que vous devrez porter successivement en changeant vos gouttières tous les 15 jours. Vos dents se déplaceront lentement vers les positions souhaitées.', 'img' => 'assets/ppt/slide08_0.jpg'],
                ];
            @endphp
            @foreach ($etapes as $etape)
                <article class="card flex flex-col overflow-hidden !p-0">
                    <img src="{{ asset($etape['img']) }}" alt="Étape {{ $etape['n'] }} : {{ $etape['titre'] }}" class="h-44 w-full object-cover" loading="lazy">
                    <div class="flex flex-1 flex-col p-6">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-brand-500 text-lg font-bold text-white">{{ $etape['n'] }}</span>
                        <h3 class="mt-3 text-lg font-bold text-brand-600">{{ $etape['titre'] }}</h3>
                        <p class="mt-2 text-base leading-relaxed">{{ $etape['texte'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('rdv') }}" class="btn-brand">Démarrer maintenant</a>
        </div>
    </section>

    {{-- VIDÉO « Comment ça marche » (kit média officiel du client) — section 5/10 : BLEU --}}
    <section class="bg-waves" aria-labelledby="video-titre">
        <div class="mx-auto max-w-5xl px-4 py-16 sm:px-6">
            <h2 id="video-titre" class="section-title-invert text-center">Regardez comment ça marche</h2>
            <div class="mt-8">
                <x-video-facade src="assets/videos/comment-ca-marche.mp4" poster="assets/videos/comment-ca-marche-poster.jpg" label="Lancer la vidéo Comment ça marche" />
            </div>

            {{-- Présentation audio (voix off) : emplacement prêt, fichier à fournir par le client.
                 Lecture manuelle et jamais automatique — une lecture automatique est bloquée par
                 les navigateurs et pénalise l'accessibilité. Voir CONTENT-DECISIONS.md D21. --}}
            @php $voixOff = file_exists(public_path('assets/audio/presentation.mp3')); @endphp
            @if ($voixOff)
                <div class="mx-auto mt-10 max-w-2xl rounded-2xl bg-white/10 p-6 text-center backdrop-blur">
                    <h3 class="text-lg font-bold text-white">Écouter la présentation</h3>
                    <p class="mt-1 text-sm text-white/80">Une minute pour comprendre le traitement Cleartrack®&nbsp;align.</p>
                    <audio controls preload="none" class="mt-4 w-full">
                        <source src="{{ asset('assets/audio/presentation.mp3') }}" type="audio/mpeg">
                        Votre navigateur ne prend pas en charge la lecture audio.
                    </audio>
                </div>
            @endif
        </div>
    </section>

    {{-- RÉSULTATS (PPT slides 9-10) — carrousel — section 6/10 : BLANC --}}
    <section class="bg-white" aria-labelledby="resultats-titre">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <div class="text-center">
                <h2 id="resultats-titre" class="section-title">Résultats garantis.<br>Sourires transformés.</h2>
                <p class="section-subtitle">Les résultats sont visibles en 6 mois en moyenne</p>
            </div>
            <div class="mt-10 px-6 sm:px-10">
                <x-carousel label="Résultats de patients" :per-view-md="3">
                    @php
                        $resultats = [
                            ['prenom' => 'Yassine', 'mois' => 7, 'cas' => 'Encombrement', 'img' => 'yassine'],
                            ['prenom' => 'Wafae', 'mois' => 6, 'cas' => 'Encombrement', 'img' => 'wafae'],
                            ['prenom' => 'Noureddine', 'mois' => 8, 'cas' => 'Encombrement', 'img' => 'noureddine'],
                            ['prenom' => 'Rania', 'mois' => 5, 'cas' => 'Encombrement', 'img' => 'rania'],
                            ['prenom' => 'Marwa', 'mois' => 2, 'cas' => 'Espacement', 'img' => 'marwa'],
                            ['prenom' => 'Ayman', 'mois' => 10, 'cas' => 'Espacement', 'img' => 'ayman'],
                        ];
                    @endphp
                    @foreach ($resultats as $r)
                        <div class="shrink-0 px-3" data-carousel-slide :style="`width: ${100 / perView}%`">
                            <div class="card h-full overflow-hidden border border-brand-100 text-left !p-0">
                                <img src="{{ asset('assets/resultats/' . $r['img'] . '.jpg') }}"
                                     alt="Avant/après du traitement de {{ $r['prenom'] }} — {{ $r['cas'] }} en {{ $r['mois'] }} mois"
                                     class="aspect-square w-full object-cover" loading="lazy">
                                <div class="p-5">
                                    <p class="font-bold text-brand-600">{{ $r['prenom'] }} — {{ $r['mois'] }} mois</p>
                                    <p class="text-sm text-slate-500">{{ $r['cas'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </x-carousel>
            </div>
        </div>
    </section>

    {{-- AVANTAGES 3 COLONNES (PPT slide 11) — section 7/10 : BLEU --}}
    <section class="bg-waves" aria-labelledby="avantages-titre">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        <h2 id="avantages-titre" class="section-title-invert text-center">Obtenez des dents parfaitement alignées</h2>
        <p class="mt-2 text-center text-base text-white/90">Cleartrack® présente des avantages de premier choix</p>
        <div class="mt-10 grid gap-8 md:grid-cols-3">
            @php
                $blocs = [
                    ['icon' => 'icons/dentiste.png', 'titre' => 'Traitement par des experts', 'texte' => 'Planifié et conçu par des orthodontistes exclusifs. Pour les autres marques d’aligneurs, la planification du traitement est assurée par des techniciens et non pas par des médecins qualifiés.'],
                    ['icon' => 'icons/livraison.png', 'titre' => 'Livraison et traitement rapides', 'texte' => 'Les aligneurs de Cleartrack® sont livrés en 7 jours*. D’autres entreprises prennent au moins 30 à 45 jours.'],
                    ['icon' => 'icons/badge.png', 'titre' => 'Fiabilité et responsabilité', 'texte' => 'Le traitement est directement suivi par un dentiste dans une clinique dentaire, ce qui garantit la responsabilité et la fiabilité du plan de traitement.'],
                ];
            @endphp
            @foreach ($blocs as $bloc)
                <div class="text-center text-white">
                    <span class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-white p-4 shadow-lg">
                        <img src="{{ asset('assets/' . $bloc['icon']) }}" alt="" class="h-10 w-10 object-contain" loading="lazy">
                    </span>
                    <h3 class="mt-4 text-lg font-bold">{{ $bloc['titre'] }}</h3>
                    <p class="mt-2 text-base leading-relaxed text-white/90">{{ $bloc['texte'] }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('avantages') }}" class="btn-white">En savoir plus</a>
        </div>
        </div>
    </section>

    {{-- NOUS AIMONS VOTRE SOURIRE (PPT slide 12) — section 8/10 : BLANC --}}
    <section class="bg-white" aria-labelledby="sourire-titre">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="flex justify-center md:order-2">
                <img src="{{ asset('assets/photo-sourire-2.jpg') }}" alt="Sourire parfaitement aligné" class="w-full max-w-md rounded-2xl shadow-xl" loading="lazy">
            </div>
            <div class="md:order-1" data-typing-group>
                <h2 id="sourire-titre" class="section-title">Nous aimons votre sourire&nbsp;!</h2>
                <p class="mt-4 text-xl font-semibold text-brand-600">Rendons-le plus beau…</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex gap-3"><span class="font-bold text-brand-500" aria-hidden="true">✓</span><span data-typing>Nous éliminons les espaces entre les dents</span></li>
                    <li class="flex gap-3"><span class="font-bold text-brand-500" aria-hidden="true">✓</span><span data-typing>Nous redressons les dents inclinées et retournées</span></li>
                    <li class="flex gap-3"><span class="font-bold text-brand-500" aria-hidden="true">✓</span><span data-typing>Obtenir un alignement parfait des dents</span></li>
                </ul>
                <p class="mt-6 text-lg font-bold text-brand-600">Votre Sourire est Magnifique&nbsp;!</p>
                <a href="{{ route('cas-traitables') }}" class="btn-brand mt-6">Voir les cas que nous pouvons traiter</a>
            </div>
        </div>
    </section>

    {{-- TRAITEMENT INVISIBLE (PPT slide 13) — section 9/10 : BLEU --}}
    <section class="bg-waves" aria-labelledby="invisible-titre">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
        <div class="text-white">
            <h2 id="invisible-titre" class="section-title-invert">Un traitement orthodontique invisible…</h2>
            <p class="texte-ppt mt-4 text-white/90">Les aligneurs Cleartrack® sont fréquemment prescrits pour corriger divers cas de dents mal alignées, d’espaces entre les dents et de rotation des dents.</p>
            <div class="mt-8 flex flex-col items-start gap-3">
                <a href="{{ route('faq') }}" class="btn-outline-white">Questions fréquemment posées</a>
                <a href="{{ route('fabrication') }}" class="btn-outline-white">Comment sont-ils fabriqués&nbsp;?</a>
                <a href="https://wa.me/212693133170" target="_blank" rel="noopener" class="btn-white">
                    Parler à un représentant
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
            </div>
        </div>
        <div class="flex justify-center">
            {{-- photo-sourire-1.jpg écartée : le rendu 3D d'origine porte un filigrane de banque
                 d'images en mosaïque sur toute sa surface (voir CONTENT-DECISIONS.md D20). --}}
            <img src="{{ asset('assets/photo-aligneur-main.png') }}" alt="Patiente tenant un aligneur Cleartrack® transparent" class="w-full max-w-sm rounded-2xl bg-white shadow-xl" loading="lazy">
        </div>
        </div>
    </section>

    {{-- TÉMOIGNAGES (PPT slides 14-15) — carrousel — section 10/10 : BLANC (contraste avant le footer bleu) --}}
    <section class="bg-white" aria-labelledby="temoignages-titre">
        <div class="mx-auto max-w-5xl px-4 py-16 sm:px-6">
            <h2 id="temoignages-titre" class="sr-only">Témoignages de patients</h2>
            <div class="px-6 sm:px-10">
                <x-carousel label="Témoignages de patients" :per-view-md="2">
                    @php
                        $temoignages = [
                            ['texte' => 'Mon expérience avec mon dentiste a été excellente jusqu’à présent. J’ai opté pour un traitement par aligneurs à Casablanca et il a été très facile de les utiliser. La meilleure chose pour moi est qu’il n’y a aucune restriction sur ce que je dois manger. La livraison des aligneurs a toujours été à l’heure : vous pouvez les faire livrer à votre domicile, ce qui m’a vraiment aidé.', 'auteur' => 'Tarik, J'],
                            ['texte' => 'Les aligneurs ont l’air si naturels qu’une fois posés il est impossible pour quiconque de savoir si vous portez un appareil dentaire. Facile à utiliser et à enlever. Je les utilise depuis quelques mois et les résultats sont très satisfaisants. Je recommande sans hésiter ce produit.', 'auteur' => 'Nouha, S'],
                        ];
                    @endphp
                    @foreach ($temoignages as $t)
                        <div class="shrink-0 px-3" data-carousel-slide :style="`width: ${100 / perView}%`">
                            <blockquote class="h-full rounded-2xl border-2 border-brand-200 bg-brand-50 p-8 text-slate-700">
                                <p class="leading-relaxed">« {{ $t['texte'] }} »</p>
                                <footer class="mt-4 font-bold text-brand-600">{{ $t['auteur'] }}</footer>
                            </blockquote>
                        </div>
                    @endforeach
                </x-carousel>
            </div>
        </div>
    </section>
@endsection
