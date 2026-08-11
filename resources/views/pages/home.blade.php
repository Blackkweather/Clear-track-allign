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
                {{-- Diapo 2 : les deux boutons sont des pilules blanches à texte bleu --}}
                <div class="hero-in-4 mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('pourquoi') }}" class="btn-white">Découvrir</a>
                    <a href="{{ route('rdv') }}" class="btn-white">Prendre RDV</a>
                </div>
            </div>
            {{-- Diapo 2 : l'arcade occupe toute la moitié droite et sort du cadre à droite --}}
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('assets/hero-aligner.png') }}"
                     alt="Aligneur dentaire transparent ClearTrack align"
                     class="animate-float no-reveal w-72 max-w-full drop-shadow-2xl md:-mr-24 md:w-[34rem] md:max-w-none lg:-mr-40 lg:w-[44rem]" fetchpriority="high">
            </div>
        </div>
    </section>

    {{-- LES QUALITÉS (PPT slide 3) — BLEU (diapo 3)
         Retours client : les rappels « Hygiénique », « Confortable » et « Discret »
         sont retirés (marqués d'une croix rouge) ; seuls « Amovible » et « Efficace »
         restent. Chaque mot devient cliquable et déploie une explication courte.

         Les explications ne sont pas inventées : ce sont les textes du client pour
         les avantages correspondants (« Sûr et amovible » et « Des résultats
         rapides », diapo 28 / page Avantages), la diapo 3 ne portant que les mots. --}}
    @php
        $qualites = [
            [
                'cle' => 'amovible',
                'mot' => 'Amovible',
                'texte' => 'Ce qui vous permet de vous brosser les dents, d’utiliser du fil dentaire et de maintenir une bonne hygiène buccale. Les aligneurs Cleartrack® sont amovibles, ce qui vous permet de continuer à manger et à boire ce que vous voulez, et de faire du sport ou d’autres activités similaires.',
                'pos' => 'left: 3%; top: 17%;',
            ],
            [
                'cle' => 'efficace',
                'mot' => 'Efficace',
                'texte' => 'Comparé à d’autres méthodes d’alignement des dents, Cleartrack® agit rapidement. En moyenne, la durée totale du traitement est entre 3 à 12 mois et de nombreuses personnes remarquent des résultats en quelques semaines.',
                'pos' => 'left: 66%; top: 61%;',
            ],
        ];
    @endphp

    <section class="bg-waves" aria-labelledby="qualites-titre" x-data="{ ouvert: null }">
        <h2 id="qualites-titre" class="sr-only">Les qualités des aligneurs ClearTrack</h2>

        {{-- Desktop / tablette : diagramme annoté fidèle au PPT — bord à bord --}}
        <div class="relative hidden aspect-[16/9] w-full md:block">
            <img src="{{ asset('assets/ppt/slide04_0.png') }}" alt="" aria-hidden="true"
                 class="absolute inset-0 h-full w-full object-contain object-left" loading="lazy">

            {{-- Ne restent que les deux traits de rappel conservés --}}
            <svg viewBox="0 0 1000 563" class="pointer-events-none absolute inset-0 h-full w-full" aria-hidden="true">
                <line x1="160" y1="115" x2="270" y2="140" stroke="white" stroke-width="1.5"/>
                <line x1="470" y1="365" x2="655" y2="365" stroke="white" stroke-width="1.5"/>
            </svg>

            @foreach ($qualites as $q)
                <button type="button" class="qualite-mot absolute" style="{{ $q['pos'] }}"
                        @click="ouvert = (ouvert === '{{ $q['cle'] }}' ? null : '{{ $q['cle'] }}')"
                        :class="ouvert === '{{ $q['cle'] }}' ? 'qualite-mot-actif' : ''"
                        :aria-expanded="ouvert === '{{ $q['cle'] }}' ? 'true' : 'false'"
                        aria-controls="qualite-{{ $q['cle'] }}">{{ $q['mot'] }}</button>
            @endforeach

            {{-- L'explication s'ouvre en bas de la diapositive, à la place du bouton --}}
            <div class="absolute inset-x-0 bottom-6 px-6 text-center">
                @foreach ($qualites as $q)
                    <p id="qualite-{{ $q['cle'] }}" x-show="ouvert === '{{ $q['cle'] }}'" x-cloak
                       x-transition:enter="transition ease-out duration-300"
                       x-transition:enter-start="opacity-0 translate-y-2"
                       x-transition:enter-end="opacity-100 translate-y-0"
                       class="mx-auto max-w-3xl text-base leading-relaxed text-white md:text-lg">{{ $q['texte'] }}</p>
                @endforeach
                <a href="{{ route('pourquoi') }}" class="btn-outline-white mt-4 inline-block"
                   x-show="ouvert === null">En savoir plus</a>
            </div>
        </div>

        {{-- Mobile : liste simple (le diagramme annoté ne tient pas sur petit écran) --}}
        <div class="px-4 py-12 sm:px-6 md:hidden">
            <div class="flex justify-center">
                <img src="{{ asset('assets/ppt/slide04_0.png') }}" alt="Aligneur ClearTrack tenu entre deux doigts"
                     class="h-40 w-auto object-contain" loading="lazy">
            </div>
            <ul class="mt-6 space-y-3">
                @foreach ($qualites as $q)
                    <li>
                        <button type="button"
                                @click="ouvert = (ouvert === '{{ $q['cle'] }}' ? null : '{{ $q['cle'] }}')"
                                :aria-expanded="ouvert === '{{ $q['cle'] }}' ? 'true' : 'false'"
                                class="w-full rounded-xl border border-white/40 py-3 text-lg font-bold text-white">
                            {{ $q['mot'] }}
                        </button>
                        <p x-show="ouvert === '{{ $q['cle'] }}'" x-cloak x-collapse
                           class="px-2 pt-3 text-sm leading-relaxed text-white/90">{{ $q['texte'] }}</p>
                    </li>
                @endforeach
            </ul>
            <div class="mt-6 text-center">
                <a href="{{ route('pourquoi') }}" class="btn-white">En savoir plus</a>
            </div>
        </div>
    </section>

    {{-- DENTISTES EXPERTS (PPT slide 4) --}}
    <section class="bg-waves" aria-labelledby="experts-titre">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="text-white">
                <h2 id="experts-titre" class="section-title-invert">Traitement fourni par des dentistes experts dans des cabinets et cliniques dentaires</h2>
                <div class="mt-4 h-1 w-16 rounded bg-white/70"></div>
                {{-- Retour client : « Animation Typing + justifier » --}}
                <p class="texte-ppt mt-6 text-justify text-white/90" data-typing>Votre traitement sera mené, géré et suivi par nos dentistes certifiés dans des cliniques dentaires entièrement équipées afin de garantir un traitement facile et sans douleurs.</p>
                {{-- Retour client : « Agrandir taille + animation » --}}
                <a href="{{ route('rdv') }}" class="btn-white btn-grand btn-anime mt-8">En savoir plus</a>
            </div>
            <div class="flex justify-center">
                {{-- Retour client : « Rendre l'image homogène sans coupure ».
                     object-contain au lieu d'un cadrage : l'image n'est plus rognée. --}}
                <img src="{{ asset('assets/ppt/slide04_experts.png') }}" alt="Une assistante dentaire et un dentiste examinant une radiographie dentaire"
                     class="w-full max-w-lg object-contain" loading="lazy">
            </div>
        </div>
    </section>

    {{-- VIDÉO « Comment ça marche » (kit média officiel du client) — BLANC
         Retour client : « mettre ce slide avant le slide 1.4 » — la vidéo passe
         donc devant la section « en 4 étapes ». Le fond blanc à courbes est
         conservé (« Garder ce fond lorsque le fond est blanc »). --}}
    <section class="bg-waves-light" aria-labelledby="video-titre">
        <div class="mx-auto max-w-5xl px-4 py-16 sm:px-6">
            <h2 id="video-titre" class="section-title text-center">Regardez comment ça marche</h2>
            <div class="mt-8">
                <x-video-facade src="assets/videos/comment-ca-marche.mp4" poster="assets/videos/comment-ca-marche-poster.jpg" label="Lancer la vidéo Comment ça marche" />
            </div>

            {{-- Présentation audio (voix off) : emplacement prêt, fichier à fournir par le client.
                 Le retour « Ajouter le script à cette video avec voix d'une femme » attend
                 ce fichier — rien à publier tant qu'il n'est pas fourni (voir D21).
                 Lecture manuelle et jamais automatique — une lecture automatique est bloquée par
                 les navigateurs et pénalise l'accessibilité. --}}
            @php $voixOff = file_exists(public_path('assets/audio/presentation.mp3')); @endphp
            @if ($voixOff)
                <div class="card mx-auto mt-10 max-w-2xl border border-brand-100 text-center">
                    <h3 class="text-lg font-bold text-brand-600">Écouter la présentation</h3>
                    <p class="mt-1 text-sm text-slate-500">Une minute pour comprendre le traitement Cleartrack®&nbsp;align.</p>
                    <audio controls preload="none" class="mt-4 w-full">
                        <source src="{{ asset('assets/audio/presentation.mp3') }}" type="audio/mpeg">
                        Votre navigateur ne prend pas en charge la lecture audio.
                    </audio>
                </div>
            @endif
        </div>
    </section>

    {{-- CLEARTRACK EN 4 ÉTAPES (PPT slides 5-8) — section 4/10 : BLANC --}}
    {{-- Le fond était porté par le conteneur centré (max-w-7xl) : les courbes se
         seraient arrêtées à 1280 px. La section porte désormais le fond sur toute
         la largeur, le conteneur centré passe à l'intérieur — contenu inchangé. --}}
    {{-- Retour client : « Mettre le fond blanc avec la meme identité graphique »
         (déjà .bg-waves-light : blanc + courbes du PPT) et « Agrandir + animation
         lors du scroll vers ce slide ». --}}
    <section class="bg-waves-light" aria-labelledby="etapes-titre" data-etapes>
        <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6">
        <h2 id="etapes-titre" class="section-title text-center text-4xl md:text-5xl">Cleartrack® align en 4 étapes</h2>
        <div class="mt-12 grid gap-8 md:grid-cols-2 xl:grid-cols-4">
            @php
                $etapes = [
                    ['n' => 1, 'titre' => 'Consultation gratuite', 'texte' => 'Une de nos cliniques partenaires ou cabinets proches de chez vous effectueront un examen et vous feront savoir si votre sourire peut être amélioré grâce aux aligneurs Cleartrack®.', 'img' => 'assets/ppt/slide05_0.jpg'],
                    ['n' => 2, 'titre' => 'Nous prenons vos empreintes', 'texte' => 'Nous avons besoin d’une empreinte de vos dents que nous numériserons et utiliserons pour créer un fichier de conception assistée par ordinateur (CAO). Nous utilisons les dernières technologies en matière de dentisterie numérique pour concevoir le plan de traitement le plus approprié pour vous.', 'img' => 'assets/ppt/slide06_0.jpg'],
                    ['n' => 3, 'titre' => 'Vérification de votre plan de traitement', 'texte' => 'Une simulation de votre plan de traitement en 3D et vidéos sont envoyés à vous et à votre médecin pour approbation. Une fois votre approbation obtenue, nous procédons à la fabrication de vos aligneurs sur mesure.', 'img' => 'assets/ppt/slide07_0.jpg'],
                    ['n' => 4, 'titre' => 'Préparez-vous à avoir un sourire hollywoodien !', 'texte' => 'Nous vous enverrons une série de gouttières que vous devrez porter successivement en changeant vos gouttières tous les 15 jours. Vos dents se déplaceront lentement vers les positions souhaitées.', 'img' => 'assets/ppt/slide08_0.jpg'],
                ];
            @endphp
            @foreach ($etapes as $etape)
                <article class="card etape-reveal flex flex-col overflow-hidden !p-0" style="--i: {{ $loop->index }}">
                    <img src="{{ asset($etape['img']) }}" alt="Étape {{ $etape['n'] }} : {{ $etape['titre'] }}" class="h-52 w-full object-cover" loading="lazy">
                    <div class="flex flex-1 flex-col p-7">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-lg bg-brand-500 text-xl font-bold text-white">{{ $etape['n'] }}</span>
                        <h3 class="mt-4 text-xl font-bold text-brand-600">{{ $etape['titre'] }}</h3>
                        <p class="mt-2 text-base leading-relaxed">{{ $etape['texte'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        {{-- Bouton conservé, comme demandé --}}
        <div class="mt-10 text-center">
            <a href="{{ route('rdv') }}" class="btn-brand btn-grand">Démarrer maintenant</a>
        </div>
        </div>
    </section>

    {{-- RÉSULTATS (PPT slides 9-10) — carrousel — section 6/10 : BLANC --}}
    <section class="bg-waves-light" aria-labelledby="resultats-titre">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <div class="text-center">
                {{-- Retour client : « Agrandir » + ajouter « à partir de 3 mois » --}}
                <h2 id="resultats-titre" class="section-title text-4xl md:text-5xl">Résultats garantis.<br>Sourires transformés.</h2>
                <p class="section-subtitle text-lg md:text-xl">Les résultats sont visibles en 6 mois en moyenne</p>
                <p class="mt-2 text-lg font-bold text-brand-600 md:text-xl">à partir de 3 mois</p>
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
                            // Retour client : Ayman est un cas d'encombrement, pas d'espacement
                            ['prenom' => 'Ayman', 'mois' => 10, 'cas' => 'Encombrement', 'img' => 'ayman'],
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

    {{-- AVANTAGES 3 COLONNES (PPT slide 11) — BLANC --}}
    <section class="bg-waves-light" aria-labelledby="avantages-titre">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        {{-- Retour client : « Agrandir » toute la section, fond blanc conservé --}}
        <h2 id="avantages-titre" class="section-title text-center text-4xl md:text-5xl">Obtenez des dents parfaitement alignées</h2>
        <p class="section-subtitle text-center text-lg md:text-xl">Cleartrack® présente des avantages de premier choix</p>
        <div class="mt-12 grid gap-10 md:grid-cols-3">
            @php
                $blocs = [
                    ['icon' => 'icons/dentiste.png', 'titre' => 'Traitement par des experts', 'texte' => 'Planifié et conçu par des orthodontistes exclusifs. Pour les autres marques d’aligneurs, la planification du traitement est assurée par des techniciens et non pas par des médecins qualifiés.'],
                    ['icon' => 'icons/livraison.png', 'titre' => 'Livraison et traitement rapides', 'texte' => 'Les aligneurs de Cleartrack® sont livrés en 7 jours*. D’autres entreprises prennent au moins 30 à 45 jours.'],
                    ['icon' => 'icons/badge.png', 'titre' => 'Fiabilité et responsabilité', 'texte' => 'Le traitement est directement suivi par un dentiste dans une clinique dentaire, ce qui garantit la responsabilité et la fiabilité du plan de traitement.'],
                ];
            @endphp
            @foreach ($blocs as $bloc)
                {{-- Retour client : « Corriger les logos invisibles ».
                     Ces trois icônes sont des illustrations en couleurs (noir, crème,
                     orange) : posées sur le disque bleu de marque elles se noyaient.
                     Elles passent sur un disque BLANC, comme le PPT le fait déjà pour
                     les icônes de la page Pourquoi (D25). --}}
                <div class="text-center">
                    <span class="mx-auto flex h-28 w-28 items-center justify-center rounded-full bg-white p-5 shadow-md ring-1 ring-brand-100">
                        <img src="{{ asset('assets/' . $bloc['icon']) }}" alt="" class="h-full w-full object-contain" loading="lazy">
                    </span>
                    <h3 class="mt-5 text-xl font-bold text-brand-500">{{ $bloc['titre'] }}</h3>
                    <p class="mt-2 text-base leading-relaxed">{{ $bloc['texte'] }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('avantages') }}" class="btn-brand">En savoir plus</a>
        </div>
        </div>
    </section>

    {{-- NOUS AIMONS VOTRE SOURIRE (PPT slide 12) — section 8/10 : BLANC
         Retours client : « Agrandir slide », « Suivre le modele sur PPT : fond blanc »
         et « Découper contour » (photo détourée, sans fond). --}}
    <section class="bg-waves-light" aria-labelledby="sourire-titre">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 py-24 sm:px-6 md:grid-cols-2">
            {{-- Diapo 12 : la photo occupe la moitié gauche, le bloc de texte la moitié droite. --}}
            <div class="flex justify-center md:order-1">
                <img src="{{ asset('assets/photo-aligneur-main-detoure.png') }}" alt="Patiente tenant un aligneur Cleartrack® transparent" class="w-full max-w-lg" loading="lazy">
            </div>
            {{-- Diapo 12 : titre souligné, puis cinq lignes centrées, sans puces.
                 « dents inclinés » est la graphie du PPT, conservée telle quelle (D23). --}}
            <div class="text-center md:order-2" data-typing-group>
                <h2 id="sourire-titre" class="section-title text-4xl underline decoration-2 underline-offset-8 md:text-5xl">Votre Sourire est Magnifique&nbsp;!</h2>
                <div class="mt-10 space-y-6 text-lg md:text-xl">
                    <p>Nous aimons votre sourire&nbsp;!</p>
                    <p>Rendons-le plus beau …</p>
                    <p data-typing>Nous éliminons les espaces entre les dents</p>
                    <p data-typing>Nous redressons les dents inclinés et retournées</p>
                    {{-- Retour client sur cette ligne : « obtenez » --}}
                    <p data-typing>Obtenez un alignement parfait des dents</p>
                </div>
                {{-- Retour client : « agrandir » ce bouton --}}
                <a href="{{ route('cas-traitables') }}" class="btn-brand btn-grand mt-10">Voir les cas que nous pouvons traiter</a>
            </div>
        </div>
    </section>

    {{-- TRAITEMENT INVISIBLE (PPT slide 13) — BLANC
         Retours client : « Elargir slide », « Agrandir photo avec elargissement
         slide » et « Fond blanc avec rainures » — ce dernier est déjà le cas
         (.bg-waves-light = blanc + courbes du PPT). --}}
    <section class="bg-waves-light" aria-labelledby="invisible-titre">
        <div class="mx-auto grid max-w-[90rem] items-center gap-14 px-4 py-24 sm:px-6 md:grid-cols-2">
        <div>
            <h2 id="invisible-titre" class="section-title text-4xl md:text-5xl">Un traitement orthodontique invisible…</h2>
            <p class="texte-ppt mt-6">Les aligneurs Cleartrack® sont fréquemment prescrits pour corriger divers cas de dents mal alignées, d’espaces entre les dents et de rotation des dents.</p>
            <div class="mt-8 flex flex-col items-start gap-3">
                <a href="{{ route('faq') }}" class="btn-outline-brand">Questions fréquemment posées</a>
                <a href="{{ route('fabrication') }}" class="btn-outline-brand">Comment sont-ils fabriqués&nbsp;?</a>
                {{-- Diapo 13 : ce bouton est vert WhatsApp, pas bleu --}}
                <a href="https://wa.me/212693133170" target="_blank" rel="noopener" class="btn bg-whatsapp text-white shadow hover:brightness-95 focus-visible:ring-whatsapp">
                    Parler à un représentant
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
            </div>
        </div>
        <div class="flex justify-center">
            {{-- Le visuel de la diapo 13 (ppt/media/image26.jpeg, rendu 3D d'une arcade avec
                 gouttière) porte un filigrane de banque d'images en mosaïque sur toute sa
                 surface, et le PPT ne le recadre pas : il reste impubliable — voir D20.
                 Emplacement réservé en attendant la version sous licence. --}}
            <div class="flex aspect-[4/3] w-full max-w-2xl items-center justify-center rounded-2xl border-2 border-dashed border-brand-200 bg-brand-50 px-6 text-center">
                <span class="text-base text-slate-400">Photo à fournir<br>(rendu 3D de la diapo 13, version sous licence)</span>
            </div>
        </div>
        </div>
    </section>

    {{-- TÉMOIGNAGES (PPT diapos 14-15) — SUPPRIMÉ à la demande du client
         (« Supprimer ce slide »). Les deux témoignages (Tarik, J et Nouha, S)
         restent dans le PPT si la section devait être rétablie. --}}
@endsection
