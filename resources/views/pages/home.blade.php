@extends('layouts.app')

@section('title', 'ClearTrack® align — Aligneurs dentaires invisibles au Maroc')

@section('content')
    {{-- HÉRO (PPT slide 2) --}}
    <section class="bg-waves relative overflow-hidden">
        <div class="mx-auto grid max-w-7xl items-center gap-8 px-4 py-16 sm:px-6 md:grid-cols-2 md:py-24">
            <div class="text-white">
                {{-- Échelle PPT slide 2 : sur-titre 28 pt (~42 px), « SANS FIL » 36 pt en gras --}}
                <p class="hero-in-1 text-2xl font-medium md:text-[2.5rem] md:leading-tight">Optez pour la solution</p>

                {{-- Retour client : « choisissez next to sans fil, and logo instead of
                     text of ClearTrack Align ». La diapo 2 empilait trois lignes de
                     texte ; « Choisissez » remonte donc sur la ligne de SANS FIL, et
                     le nom de marque cède la place au logo, qui prend la ligne
                     suivante — trop large pour tenir en ligne avec le mot. Le « ! »
                     ferme la phrase après le logo. D36.
                     La phrase reste lisible en synthèse vocale : l'alternative du
                     logo est exactement le texte qu'il remplace. --}}
                {{-- Retour client : « the logo in the hero needs to be centralized
                     with the text ». Le logo était aligné sur le bord gauche, sous
                     un bloc de texte plus large : il paraissait décroché. Les deux
                     lignes sont donc réunies dans un conteneur `inline-block`, dont
                     la largeur est celle de la ligne la plus longue (« SANS FIL
                     Choisissez ») ; le logo se centre là-dedans, et non dans toute
                     la colonne de grille. D56. --}}
                <div class="inline-block">
                    <div class="hero-in-2 mt-2 flex flex-wrap items-baseline gap-x-6 gap-y-1">
                        <h1 class="text-5xl font-extrabold leading-none tracking-tight md:text-[3.5rem]">SANS FIL</h1>
                        <span class="text-xl font-semibold md:text-[1.75rem]">Choisissez</span>
                    </div>
                    <div class="hero-in-3 mt-4 flex items-center justify-center gap-3">
                        <img src="{{ asset('assets/brand/logo-on-blue.png') }}" alt="ClearTrack Align"
                             class="h-16 w-auto md:h-24" fetchpriority="high">
                        <span class="text-xl font-semibold md:text-[1.75rem]" aria-hidden="true">!</span>
                    </div>
                </div>

                {{-- Diapo 2 : les deux boutons sont des pilules blanches à texte bleu.
                     Retour client : « making button a bit bigger so it follows the
                     website » — ils passent au gabarit .btn-grand déjà utilisé plus
                     bas dans la page. --}}
                <div class="hero-in-4 mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('pourquoi') }}" class="btn-white btn-grand">Découvrir</a>
                    <a href="{{ route('rdv') }}" class="btn-white btn-grand">Prendre RDV</a>
                </div>
            </div>
            {{-- Diapo 2 : l'arcade occupe toute la moitié droite et sort du cadre à droite --}}
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('assets/hero-aligner.webp') }}"
                     alt="Aligneur dentaire transparent ClearTrack align"
                     class="animate-float no-reveal w-72 max-w-full drop-shadow-2xl md:-mr-24 md:w-[34rem] md:max-w-none lg:-mr-40 lg:w-[44rem]" fetchpriority="high">
            </div>
        </div>
    </section>

    {{-- LES CINQ QUALITÉS (PPT slide 3) — BLEU (diapo 3)
         Retour client : « get back the amovible and the rest of the five that we
         had » — les cinq mots de la diapo 3 sont RÉTABLIS. Ils avaient été réduits
         à deux (« Amovible » et « Efficace ») lors d'un retour précédent ; le
         client revient sur cette suppression. D37.

         Chaque mot garde la position exacte relevée dans le PPT (a:off en EMU) et
         déploie une explication au clic.

         AUCUN de ces textes n'est inventé : la diapo 3 ne porte que les cinq mots,
         mais les cinq explications existent ailleurs dans les sources du client.
         La provenance de chacune est indiquée en commentaire — c'est le seul
         travail fait ici : rattacher à chaque mot le passage du client qui le
         décrit, sans en réécrire une ligne. D54. --}}
    @php
        $qualites = [
            [
                'cle' => 'amovible',
                'mot' => 'Amovible',
                // Page Avantages / diapo 28, « Sûr et amovible » — seconde moitié.
                // La première moitié parle de brossage et d'hygiène : elle est
                // allée à « Hygiénique », à qui elle revient, plutôt que d'ouvrir
                // les deux explications sur la même phrase.
                'texte' => 'Les aligneurs Cleartrack® sont amovibles, ce qui vous permet de continuer à manger et à boire ce que vous voulez, et de faire du sport ou d’autres activités similaires.',
                // Position exacte relevée dans le PPT (diapo 3, a:off/a:ext en EMU)
                'pos' => 'left: 8.14%; top: 20.33%;',
            ],
            [
                'cle' => 'hygienique',
                'mot' => 'Hygiénique',
                // Page Avantages / diapo 28, « Sûr et amovible » — première moitié,
                // qui traite précisément de l'hygiène bucco-dentaire.
                'texte' => 'Ce qui vous permet de vous brosser les dents, d’utiliser du fil dentaire et de maintenir une bonne hygiène buccale. Les appareils dentaires traditionnels présentent des problèmes tels que les bouts de nourriture coincés dans les fils et les brackets, ce qui entraîne des caries et des maladies des gencives.',
                'pos' => 'left: 66.46%; top: 19.56%;',
            ],
            [
                'cle' => 'confortable',
                'mot' => 'Confortable',
                // CLEARTRACK - Part 2.docx, « Principaux avantages du traitement
                // Cleartrack® », entrée « Confortable », recopiée mot pour mot.
                'texte' => 'Les aligneurs Cleartrack® sont confortables à porter. Il n’y a pas de coupures ou d’irritations dues aux fils ou aux brackets comme avec les appareils dentaires traditionnels.',
                'pos' => 'left: 66.46%; top: 37.80%;',
            ],
            [
                'cle' => 'discret',
                'mot' => 'Discret',
                // CLEARTRACK - Part 2.docx, même section, entrée « Transparent,
                // sans fils, pas de brackets », recopiée mot pour mot.
                'texte' => 'Pas besoin de cacher votre sourire. Les aligneurs sont si transparents que beaucoup de gens ne remarqueront même pas que vous les portez. Souriez autant que vous le souhaitez.',
                'pos' => 'left: 66.46%; top: 50.32%;',
            ],
            [
                'cle' => 'efficace',
                'mot' => 'Efficace',
                // Page Avantages / diapo 28, « Des résultats rapides ».
                'texte' => 'Comparé à d’autres méthodes d’alignement des dents, Cleartrack® agit rapidement. En moyenne, la durée totale du traitement est entre 3 à 12 mois et de nombreuses personnes remarquent des résultats en quelques semaines.',
                // Position exacte relevée dans le PPT (diapo 3, a:off/a:ext en EMU)
                'pos' => 'left: 66.46%; top: 63.40%;',
            ],
        ];
    @endphp

    <section class="bg-waves" aria-labelledby="qualites-titre" x-data="{ ouvert: null }">
        <h2 id="qualites-titre" class="sr-only">Les qualités des aligneurs ClearTrack</h2>

        {{-- Desktop / tablette : diagramme annoté fidèle au PPT — bord à bord --}}
        <div class="relative hidden aspect-[16/9] w-full md:block">
            <img src="{{ asset('assets/ppt/slide04_0.webp') }}" alt="" aria-hidden="true"
                 class="absolute inset-0 h-full w-full object-contain object-left" loading="lazy">

            {{-- Traits de rappel — géométrie RELEVÉE dans le PPT, plus estimée.
                 Retour client : « les traits d'Hygiénique et Amovible ne sont pas
                 bien placés, ils doivent partir du modèle, être diagonaux et ne
                 pas toucher la lettre ».

                 La diapo 3 contient effectivement 7 connecteurs (<p:cxnSp>) que le
                 site n'avait pas repris : il en dessinait 5, tous droits et posés
                 à vue. Les voici tels quels — coordonnées converties depuis les
                 EMU, x = % × 10 et y = % × 5,63 dans ce viewBox 1000 × 563 :

                   Amovible    trait droit puis DIAGONAL qui plonge vers le modèle
                   Hygiénique  DIAGONAL depuis le modèle puis trait droit
                   Confortable, Discret, Efficace : un seul trait droit

                 Tous s'arrêtent à x = 659,2 (soit 65,92 %) alors que les mots
                 commencent à 66,46 % : le PPT ménage lui-même l'espace, les traits
                 ne touchent donc aucune lettre. --}}
            <svg viewBox="0 0 1000 563" class="pointer-events-none absolute inset-0 h-full w-full" aria-hidden="true">
                {{-- Amovible (mot à gauche) : depuis le mot vers le modèle --}}
                <line x1="175.1" y1="114.5" x2="237.8" y2="114.5" stroke="white" stroke-width="1.5"/>
                <line x1="237.8" y1="114.5" x2="274.2" y2="135.2" stroke="white" stroke-width="1.5"/>
                {{-- Hygiénique : diagonale depuis le modèle, puis palier vers le mot --}}
                <line x1="507.3" y1="143.8" x2="553.4" y2="109.4" stroke="white" stroke-width="1.5"/>
                <line x1="553.4" y1="110.1" x2="659.2" y2="110.1" stroke="white" stroke-width="1.5"/>
                {{-- Confortable, Discret, Efficace --}}
                <line x1="521.7" y1="212.8" x2="659.2" y2="212.8" stroke="white" stroke-width="1.5"/>
                <line x1="507.3" y1="283.3" x2="659.2" y2="283.3" stroke="white" stroke-width="1.5"/>
                <line x1="476.2" y1="356.9" x2="659.2" y2="356.9" stroke="white" stroke-width="1.5"/>
            </svg>

            @foreach ($qualites as $q)
                <button type="button" class="qualite-mot absolute -translate-y-1/2" style="{{ $q['pos'] }}"
                        @click="ouvert = (ouvert === '{{ $q['cle'] }}' ? null : '{{ $q['cle'] }}')"
                        :class="ouvert === '{{ $q['cle'] }}' ? 'qualite-mot-actif' : ''"
                        :aria-expanded="ouvert === '{{ $q['cle'] }}' ? 'true' : 'false'"
                        aria-controls="qualite-{{ $q['cle'] }}">{{ $q['mot'] }}</button>
            @endforeach

        {{-- Explication : DANS le cadre, pas en dessous.
             Retour client : « the text showing needs to be on the frame where we
             are, cause they need to be readable in the place of it ». Elle était
             passée sous la diapositive pour ne pas recouvrir les mots rétablis
             (D37) ; elle remonte donc dans le cadre.

             Bande basse, sur toute la largeur : c'est la seule zone qui ne
             chevauche ni les mots ni les traits. Le trait le plus bas est celui
             d'« Efficace » à 63,40 % — la bande commence à 67 %. Le bouton
             « En savoir plus » occupe les derniers pour-cent : elle s'arrête à
             90 %. Un voile bleu foncé assure la lisibilité par-dessus la photo,
             et overflow-y-auto protège des écrans courts. --}}
        <div class="pointer-events-none absolute inset-x-[3%] top-[67%] bottom-[10%] flex items-center">
            @foreach ($qualites as $q)
                <p id="qualite-{{ $q['cle'] }}" x-show="ouvert === '{{ $q['cle'] }}'" x-cloak
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 translate-y-2"
                   x-transition:enter-end="opacity-100 translate-y-0"
                   class="max-h-full overflow-y-auto rounded-2xl bg-ppt-blue/85 px-6 py-4 text-center text-sm leading-relaxed text-white shadow-lg backdrop-blur-sm lg:text-base">{{ $q['texte'] }}</p>
            @endforeach
        </div>

            {{-- Le bouton reste en bas, centré : il ne dépend pas du rappel ouvert.
                 Retour client : « en savoir plus needs to be taking to comment sont
                 ils fabriqués » — il pointe désormais vers la page Fabrication et
                 non plus vers Pourquoi. D38. --}}
            <div class="absolute inset-x-0 bottom-6 px-6 text-center">
                <a href="{{ route('fabrication') }}" class="btn-outline-white inline-block">En savoir plus</a>
            </div>
        </div>

        {{-- Mobile : liste simple (le diagramme annoté ne tient pas sur petit écran) --}}
        <div class="px-4 py-12 sm:px-6 md:hidden">
            <div class="flex justify-center">
                <img src="{{ asset('assets/ppt/slide04_0.webp') }}" alt="Aligneur ClearTrack tenu entre deux doigts"
                     class="h-40 w-auto object-contain" loading="lazy">
            </div>
            {{-- Grille à 2 colonnes : les cinq pavés sont le MÊME élément avec les
                 MÊMES classes, et tous réagissent au clic. Les explications
                 s'affichent sous la grille, en pleine largeur, pour ne pas
                 déformer une cellule.
                 L'ordre suit celui de la diapo 3, de haut en bas puis de gauche à
                 droite : Amovible (à gauche), puis les quatre de la colonne droite. --}}
            <ul class="mt-6 grid grid-cols-2 gap-4">
                @foreach ($qualites as $q)
                    <li>
                        <button type="button"
                                class="w-full rounded-xl border border-white/40 py-3 text-center font-bold text-white"
                                @click="ouvert = (ouvert === '{{ $q['cle'] }}' ? null : '{{ $q['cle'] }}')"
                                :aria-expanded="ouvert === '{{ $q['cle'] }}' ? 'true' : 'false'"
                                :class="ouvert === '{{ $q['cle'] }}' ? 'bg-white/20' : ''">{{ $q['mot'] }}</button>
                    </li>
                @endforeach
            </ul>

            @foreach ($qualites as $q)
                <p x-show="ouvert === '{{ $q['cle'] }}'" x-cloak x-collapse
                   class="mt-4 rounded-xl bg-white/10 p-4 text-sm leading-relaxed text-white/90">{{ $q['texte'] }}</p>
            @endforeach
            <div class="mt-6 text-center">
                <a href="{{ route('fabrication') }}" class="btn-white">En savoir plus</a>
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

            {{-- Le lecteur « Écouter la présentation » est retiré à la demande du
                 client : la voix off est désormais montée dans la vidéo elle-même,
                 le lecteur séparé faisait donc doublon. Le fichier
                 assets/audio/presentation.mp3 reste disponible si besoin. --}}
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
                        <h3 class="mt-4 text-xl font-bold text-ppt-blue">{{ $etape['titre'] }}</h3>
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
                {{-- Retour client : « les résultats sont visibles à partir de trois
                     mois, pas six mois ». La mention « en 6 mois en moyenne » de la
                     diapo 9 est donc remplacée, et non complétée. --}}
                <h2 id="resultats-titre" class="section-title text-4xl md:text-5xl">Résultats garantis.<br>Sourires transformés.</h2>
                <p class="section-subtitle text-lg md:text-xl">Les résultats sont visibles à partir de 3 mois</p>
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
                                    <p class="font-bold text-ppt-blue">{{ $r['prenom'] }} — {{ $r['mois'] }} mois</p>
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
                    // Retour client (13/08/2026) : la comparaison avec les autres
                    // marques est RÉTABLIE sur ce premier bloc, à la demande du
                    // client. Elle reste retirée du deuxième bloc. D29.
                    ['icon' => 'icons/dentiste.png', 'titre' => 'Traitement par des experts', 'texte' => 'Planifié et conçu par des orthodontistes exclusifs. Pour les autres marques d’aligneurs, la planification du traitement est assurée par des médecins qualifiés et non pas par des techniciens.'],
                    ['icon' => 'icons/livraison.png', 'titre' => 'Livraison et traitement rapides', 'texte' => 'Les aligneurs de Cleartrack® sont livrés en 7 jours'],
                    ['icon' => 'icons/badge.png', 'titre' => 'Fiabilité et responsabilité', 'texte' => 'Le traitement est directement suivi par un dentiste dans une clinique dentaire, ce qui garantit la responsabilité et la fiabilité du plan de traitement.'],
                ];
            @endphp
            @foreach ($blocs as $bloc)
                {{-- Retour client : « Corriger les logos invisibles ».
                     Ces trois icônes sont des illustrations en couleurs (noir, crème,
                     orange) : posées sur le disque bleu de marque elles se noyaient.
                     Elles passent sur un disque BLANC, comme le PPT le fait déjà pour
                     les icônes de la page Pourquoi (D25). --}}
                {{-- Retour client : « agrandir un tout petit peu » les trois blocs --}}
                <div class="text-center">
                    <span class="mx-auto flex h-32 w-32 items-center justify-center rounded-full bg-white p-6 shadow-md ring-1 ring-brand-100">
                        <img src="{{ asset('assets/' . $bloc['icon']) }}" alt="" class="h-full w-full object-contain" loading="lazy">
                    </span>
                    <h3 class="mt-6 text-2xl font-bold text-ppt-blue">{{ $bloc['titre'] }}</h3>
                    <p class="mt-3 text-lg leading-relaxed">{{ $bloc['texte'] }}</p>
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
            {{-- Retour client : « agrandir un tout petit peu le slide » et garder la
                 photo de la patiente, main levée tenant l'aligneur, détourée. --}}
            {{-- Retour client : « la photo de "sourire est magnifique" — need to
                 enhance the quality ». La photo était affichée jusqu'à 576 px de
                 large (max-w-xl) alors que le fichier détouré n'en fait que 473 :
                 le navigateur l'agrandissait de 22 %, d'où le flou constaté.
                 Elle est désormais bornée à sa résolution native (max-w-[473px]),
                 donc affichée nette au pixel près, et centrée dans sa colonne.
                 La source du PPT (diapo 12, ppt/media/image25.png, 705 × 591 avec
                 le bandeau de titre) ne contient pas mieux : un tirage haute
                 définition de cette photo reste à fournir par le client pour
                 pouvoir l'afficher plus grand. D39. --}}
            <div class="flex justify-center md:order-1">
                <img src="{{ asset('assets/photo-aligneur-main-detoure.webp') }}"
                     alt="Patiente tenant un aligneur Cleartrack® transparent"
                     width="1150" height="1305"
                     class="h-auto w-full max-w-xl" loading="lazy">
            </div>
            {{-- Diapo 12 : titre souligné, puis cinq lignes centrées, sans puces.
                 « dents inclinés » est la graphie du PPT, conservée telle quelle (D23). --}}
            {{-- Ordre rétabli d'après la diapo 12, qui va dans cet ordre précis :
                 « Nous aimons votre sourire ! » (titre), « Rendons-le plus beau … »,
                 les trois lignes, puis « Votre Sourire est Magnifique ! » et le
                 bouton. Le site avait interverti le premier et l'avant-dernier, ce
                 qui faisait lire deux titres concurrents pour une même section —
                 les « paragraphes en double » signalés par le client. --}}
            {{-- Retour client (13/08/2026) : « Votre Sourire est Magnifique ! »
                 devient le GRAND TITRE de ce bloc — il remonte donc ici, en tête,
                 et le bandeau bleu qui le portait plus bas est supprimé (il aurait
                 répété la même phrase à deux sections d'intervalle). « Nous aimons
                 votre sourire ! » passe juste en dessous, en SOUS-TITRE. Tout le
                 reste du bloc (accroche, trois lignes, bouton) est inchangé. D31. --}}
            <div class="text-center md:order-2" data-typing-group>
                {{-- Retour client : « remove the line under "votre sourire est
                     magnifique" » — le soulignement du titre est retiré. D39. --}}
                <h2 id="sourire-titre" class="section-title text-4xl md:text-5xl">Votre Sourire est Magnifique&nbsp;!</h2>
                <p class="section-subtitle font-semibold text-ppt-blue md:text-2xl">Nous aimons votre sourire&nbsp;!</p>
                <div class="mt-10 space-y-6 text-lg md:text-xl">
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

    {{-- Le bandeau bleu « Votre Sourire est Magnifique ! » (fin de la diapo 12)
         a été supprimé le 13/08/2026 : la phrase est devenue le grand titre du
         bloc « sourire » juste au-dessus, la répéter ici n'aurait plus de sens.
         Conséquence assumée : il n'y a plus de respiration bleue entre ce bloc
         et « Un traitement orthodontique invisible… ». D31. --}}

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
            {{-- Visuel de la diapo 13 : rendu 3D d'une arcade avec gouttière
                 (Shutterstock 1660764217). Le fichier du PPT — comme la copie
                 récupérée depuis Google Images — porte le filigrane en mosaïque
                 de la banque d'images : impubliable (D20). Le client a acquis la
                 licence ; il reste à déposer le fichier PROPRE téléchargé depuis
                 son compte Shutterstock sous ce nom exact :

                     public/assets/traitement-invisible.jpg

                 Dès qu'il est là, la photo remplace d'elle-même le cadre
                 « Photo à fournir » — aucune modification de code n'est
                 nécessaire, ni ici ni au déploiement. --}}
            @php $visuelInvisible = public_path('assets/traitement-invisible.jpg'); @endphp
            @if (file_exists($visuelInvisible))
                <img src="{{ asset('assets/traitement-invisible.jpg') }}?v={{ filemtime($visuelInvisible) }}"
                     alt="Rendu 3D d'une arcade dentaire portant une gouttière Cleartrack® transparente"
                     class="w-full max-w-2xl rounded-2xl object-contain" loading="lazy">
            @else
                <div class="flex aspect-[4/3] w-full max-w-2xl items-center justify-center rounded-2xl border-2 border-dashed border-brand-200 bg-brand-50 px-6 text-center">
                    <span class="text-base text-slate-400">Photo à fournir<br>(rendu 3D de la diapo 13, version sous licence)</span>
                </div>
            @endif
        </div>
        </div>
    </section>

    {{-- TÉMOIGNAGES (PPT diapos 14-15) — SUPPRIMÉ à la demande du client
         (« Supprimer ce slide »). Les deux témoignages (Tarik, J et Nouha, S)
         restent dans le PPT si la section devait être rétablie. --}}
@endsection
