@extends('layouts.app')

{{--
    Page « Pourquoi » — reproduction des diapositives 18 à 25 du PowerPoint client.
    Ordre, textes, icônes et images repris tels quels de la maquette :
      diapo 18-19 : en-tête + 4 raisons (fond BLEU, image1.png)
      diapo 20-22 : « Aligneurs avec matériau de meilleure qualité » (fond BLANC)
      diapo 23    : CTA « Nous sommes impatients… » puis « Pourquoi les gens choisissent… »
      diapo 24    : 3 atouts + ligne de contact
      diapo 25    : pied de page
    Les textes sont recopiés mot pour mot du PPT (y compris ses coquilles) — voir
    CONTENT-DECISIONS.md D23.
--}}

@section('title', 'Pourquoi choisir Cleartrack®align ? — ClearTrack® align')
@section('meta_description', 'Conception par orthodontistes experts, contrôle complet de la production, prix abordables et assistance clinique complète : découvrez la différence Cleartrack®align.')

@section('content')
    {{-- ══ Diapo 18 — En-tête (BLEU) ══
         Titre et sous-titre centrés, comme sur la diapositive. --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 pb-6 pt-14 text-center sm:px-6">
            <h1 class="page-title mx-auto max-w-5xl text-white">Pourquoi choisir le traitement Cleartrack®align&nbsp;?</h1>
            <p class="mx-auto mt-4 max-w-4xl text-white/90">Les aligneurs Cleartrack® sont conçues et développées par des orthodontistes qualifiés et expérimentés</p>
        </div>
    </section>

    {{-- ══ Diapos 18-19 — Les 4 raisons (BLEU) ══
         Diapo 18 : les deux premières raisons à gauche, la main gantée à droite.
         Diapo 19 : l'aligneur 3D à gauche (débordant hors cadre), les deux autres à droite. --}}
    @php
        $raisons = [
            ['icone' => 'icone-science.png', 'titre' => 'Basé sur la science des données', 'texte' => 'Les gouttières cleartrack sont conçues et développées par des orthodontistes experts utilisant des systèmes de haute technologie basés sur l’intelligence artificielle et l’expérience de plus de 5 000 traitements dentaires réalisés dans des cliniques dentaires marocaines'],
            ['icone' => 'icone-controle.png', 'titre' => 'Un contrôle complet de la conception à la production', 'texte' => 'Cleartrack® dispose de son propre centre de conception high-tech équipé des derniers logiciels de 3Shape. Les modèles sont imprimés sur des imprimantes 3D 4K avec une précision de 100 microns. Chaque aligneur est ajusté et fini à la main par des techniciens experts.'],
            ['icone' => 'icone-assistance.png', 'titre' => 'Assistance clinique complète', 'texte' => 'Nous ne fournissons des traitements que dans des cliniques entièrement équipées, avec des dentistes experts, car les traitements par aligneurs nécessitent des traitements supplémentaires tels que les restaurations et le nettoyage des dents. Seul un dentiste peut garantir le suivi du traitement pour obtenir le résultat souhaité'],
            ['icone' => 'icone-prix.png', 'titre' => 'Prix abordables et paiement planifié', 'texte' => 'Nous fournissons la meilleure qualité de dentaire par gouttières aux prix les plus traitement abordables possibles. Nous proposons également des options de paiement planifié'],
        ];
    @endphp

    <section class="section-bleed bg-waves" aria-labelledby="raisons-titre">
        <h2 id="raisons-titre" class="sr-only">Les raisons de choisir Cleartrack®align</h2>

        {{-- Diapo 18 --}}
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 md:grid-cols-2">
            <div class="space-y-10">
                @foreach (array_slice($raisons, 0, 2) as $r)
                    <div class="flex gap-5">
                        {{-- Icône bleue posée sur un disque blanc, comme sur les diapos 18-19 (D25) --}}
                        <span class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-white p-4">
                            <img src="{{ asset('assets/pourquoi/' . $r['icone']) }}" alt="" aria-hidden="true"
                                 class="h-full w-full object-contain" loading="lazy">
                        </span>
                        <div class="text-white">
                            <h3 class="text-xl font-bold underline decoration-2 underline-offset-4">{{ $r['titre'] }}</h3>
                            <p class="mt-2 leading-relaxed text-white/90">{{ $r['texte'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('assets/pourquoi/main-gantee.png') }}"
                     alt="Aligneur Cleartrack® tenu par une main gantée" loading="lazy"
                     class="w-64 max-w-full drop-shadow-2xl md:w-80">
            </div>
        </div>

        {{-- Diapo 19 --}}
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 md:grid-cols-2">
            <div class="flex justify-center md:order-1">
                {{-- Débordement volontaire hors du cadre, comme sur la diapo (x = -0,29) --}}
                <img src="{{ asset('assets/pourquoi/aligneur-3d.png') }}"
                     alt="Rendu 3D d’un aligneur Cleartrack® align" loading="lazy"
                     {{-- Mobile : l'image est bridée à la largeur de sa colonne. Avec
                          « h-64 w-auto max-w-none », l'image, très large, imposait sa
                          largeur intrinsèque à la colonne de grille : la section devenait
                          plus large que l'écran et overflow-x: clip rognait le texte à
                          droite au lieu de le faire revenir à la ligne. Le débordement
                          voulu de la diapo 19 ne commence donc qu'à partir de md. --}}
                     class="img-bleed h-auto w-full max-w-xs drop-shadow-2xl md:h-[22rem] md:w-auto md:max-w-none md:-ml-32 lg:h-[30rem] lg:-ml-56">
            </div>
            <div class="space-y-10 md:order-2">
                @foreach (array_slice($raisons, 2, 2) as $r)
                    <div class="flex gap-5">
                        {{-- Icône bleue posée sur un disque blanc, comme sur les diapos 18-19 (D25) --}}
                        <span class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-white p-4">
                            <img src="{{ asset('assets/pourquoi/' . $r['icone']) }}" alt="" aria-hidden="true"
                                 class="h-full w-full object-contain" loading="lazy">
                        </span>
                        <div class="text-white">
                            <h3 class="text-xl font-bold underline decoration-2 underline-offset-4">{{ $r['titre'] }}</h3>
                            <p class="mt-2 leading-relaxed text-white/90">{{ $r['texte'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══ Diapos 20-22 — Aligneurs avec matériau de meilleure qualité (BLANC) ══ --}}
    @php
        // Comparatif « Autres aligneurs » / « Cleartrack®align » (diapos 20-22).
        // Les six photos sont celles du PPT, reprises avec EXACTEMENT le recadrage
        // que la maquette leur applique (a:srcRect) : ce recadrage supprime le
        // bandeau de titre publicitaire du fichier d'origine, si bien qu'aucune
        // marque tierce n'apparaît sur les visuels publiés — voir D24.
        $comparaisons = [
            ['cle' => 'plus-clairs', 'label' => 'Plus clairs', 'cote' => 'gauche',
             'autres' => null, 'ct' => null],
            ['cle' => 'plus-confortables', 'label' => 'Plus confortables', 'cote' => 'droite',
             'autres' => null, 'ct' => 'Polies à la main pour des bords plus lisses'],
            ['cle' => 'pas-de-decoloration', 'label' => 'Pas de décoloration', 'cote' => 'gauche',
             'autres' => 'Jaunissement apparent avec le temps', 'ct' => 'Gardent leur transparence s’ils restent à l’abri de produit colorants'],
        ];
    @endphp

    <section class="bg-waves-light overflow-hidden" aria-labelledby="materiau-titre">
        <div class="py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6">
                <h2 id="materiau-titre" class="section-title text-center">Aligneurs avec matériau de meilleure qualité</h2>
                <p class="mx-auto mt-3 max-w-3xl text-center text-slate-500">Un matériau biocompatible personnalisé de nos aligneurs, qui présente les avantages suivants</p>
            </div>

            {{-- Barre de bascule : les trois comparaisons (six photos) étaient empilées,
                 ce qui faisait défiler longuement. On n'en montre plus qu'une à la fois,
                 comme le PPT qui leur consacre une diapositive chacune (20, 21, 22).
                 Même mécanique que les onglets de la page Instructions.

                 Attention : [x-cloak] { display: none } est une règle CSS ordinaire,
                 elle s'applique donc même sans JavaScript (c'est Alpine qui retire
                 l'attribut au démarrage). Poser x-cloak sur les trois blocs les
                 rendrait tous invisibles si Alpine ne se charge pas. Le premier en
                 est donc dépourvu : sans JavaScript, on voit au moins la première
                 comparaison au lieu d'une section vide. --}}
            <div class="mt-12" x-data="{ onglet: '{{ $comparaisons[0]['cle'] }}' }">
                <div class="mx-auto flex max-w-2xl flex-wrap justify-center gap-2 px-4 sm:px-6"
                     role="tablist" aria-label="Comparaisons de matériau">
                    @foreach ($comparaisons as $c)
                        <button type="button" role="tab"
                                @click="onglet = '{{ $c['cle'] }}'"
                                :aria-selected="onglet === '{{ $c['cle'] }}' ? 'true' : 'false'"
                                :class="onglet === '{{ $c['cle'] }}'
                                    ? 'bg-brand-500 text-white shadow'
                                    : 'bg-white text-brand-600 hover:bg-brand-50'"
                                class="rounded-full border border-brand-300 px-6 py-2.5 text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 md:text-base">
                            {{ $c['label'] }}
                        </button>
                    @endforeach
                </div>

            <div class="mt-10 space-y-16">
                @foreach ($comparaisons as $c)
                    <div x-show="onglet === '{{ $c['cle'] }}'" @if (! $loop->first) x-cloak @endif>
                        {{-- Le libellé est une pastille bleue qui sort du cadre, alternativement
                             à gauche puis à droite de la diapositive (diapos 20-22). --}}
                        {{-- Sur mobile la pastille reste entière dans la marge : sortie du
                             cadre, elle se faisait rogner par le bord de l'écran et passait
                             pour un défaut. Le débordement de la diapo reprend à partir de md. --}}
                        <div @class(['flex px-4 md:px-0', 'justify-start' => $c['cote'] === 'gauche', 'justify-end' => $c['cote'] === 'droite'])>
                            <p @class([
                                'inline-block rounded-full bg-brand-500 px-8 py-3 text-xl font-bold text-white md:text-2xl',
                                'md:-ml-6 md:rounded-l-none md:pl-10' => $c['cote'] === 'gauche',
                                'md:-mr-6 md:rounded-r-none md:pr-10' => $c['cote'] === 'droite',
                            ])>{{ $c['label'] }}</p>
                        </div>

                        <div class="mx-auto mt-8 grid max-w-7xl gap-8 px-4 sm:grid-cols-2 sm:px-6">
                            @foreach ([['Autres aligneurs', $c['autres'], false], ['Cleartrack®align', $c['ct'], true]] as [$titre, $legende, $estCt])
                                <div class="text-center">
                                    <h3 class="text-2xl font-bold text-brand-500 md:text-3xl">{{ $titre }}</h3>
                                    {{-- La légende est placée sous le titre, au-dessus de la photo, comme sur les diapos 21-22 --}}
                                    <p class="mt-1 min-h-6 text-sm leading-relaxed text-slate-500">{{ $legende }}</p>
                                    <img src="{{ asset('assets/pourquoi/materiau/' . $c['cle'] . ($estCt ? '-cleartrack' : '-autres') . '.jpg') }}"
                                         alt="{{ $c['label'] }} — {{ $estCt ? 'aligneur Cleartrack®align' : 'autres aligneurs' }}"
                                         class="mt-4 w-full object-cover" loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('fabrication') }}" class="btn-outline-brand">Comment sont ils fabriqués&nbsp;?</a>
            </div>
        </div>
    </section>

    {{-- ══ Diapo 23 — Appel à la consultation gratuite (bandeau BLEU, bouton blanc) ══ --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-5xl px-4 py-14 text-center sm:px-6">
            <p class="text-2xl font-bold text-white md:text-3xl">Nous sommes impatients de vous offrir le meilleur sourire que vous méritez. Planifiez une première consultation avec un orthodontiste entièrement gratuite&nbsp;!</p>
            <a href="{{ route('rdv') }}" class="btn-white mt-8">Démarrer</a>
        </div>
    </section>

    {{-- ══ Diapos 23-24 — Pourquoi les gens choisissent les aligneurs (BLANC) ══ --}}
    @php
        $atouts = [
            ['icone' => 'icone-invisible.png', 'fond' => true, 'titre' => 'Clairs et discrets', 'texte' => 'Les aligneurs sont fabriqués en Polyuréthane biocompatible, un matériau transparent et invisible'],
            ['icone' => 'icone-confort.png', 'fond' => false, 'titre' => 'Amovibles et confortables', 'texte' => 'doivent être portées 22 heures par jour. Ils sont amovibles et très confortables. Une solution sans fil métallique'],
            ['icone' => 'icone-alimentation.png', 'fond' => true, 'titre' => 'Pas de restrictions alimentaires', 'texte' => 'Contrairement aux appareils métalliques. Continuez à vous régaler de pizzas, de hamburgers, et autres !'],
        ];
    @endphp

    <section class="bg-waves-light" aria-labelledby="choix-titre">
        <div class="mx-auto max-w-7xl px-4 pb-16 pt-4 sm:px-6">
            {{-- Diapo 23 : ce titre est gris, et non bleu comme les autres titres de section --}}
            <h2 id="choix-titre" class="section-title mx-auto max-w-4xl text-center !text-slate-400">Pourquoi les gens choisissent les aligneurs plutôt que les appareils dentaires conventionnels&nbsp;?</h2>
            <p class="mx-auto mt-6 max-w-4xl text-center leading-relaxed">La plupart des médecins et orthodontistes considèrent les aligneurs comme la solution idéale pour améliorer leur santé bucco-dentaire, leur confiance en eux et leur personnalité, car ils offrent les avantages d’un traitement orthodontique sans les compromis et les problèmes associés aux appareils conventionnels</p>

            <div class="mt-14 grid gap-10 md:grid-cols-3">
                @foreach ($atouts as $a)
                    <div class="text-center">
                        @if ($a['fond'])
                            <span class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-brand-500 p-5">
                                <img src="{{ asset('assets/pourquoi/' . $a['icone']) }}" alt="" aria-hidden="true" class="h-full w-full object-contain" loading="lazy">
                            </span>
                        @else
                            <img src="{{ asset('assets/pourquoi/' . $a['icone']) }}" alt="" aria-hidden="true" class="mx-auto h-24 w-24 object-contain" loading="lazy">
                        @endif
                        <h3 class="mt-5 text-2xl font-bold text-brand-600">{{ $a['titre'] }}</h3>
                        <p class="mt-3 leading-relaxed">{{ $a['texte'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Diapo 24 : cette ligne de contact est entièrement en bleu de marque --}}
            <p class="mx-auto mt-14 max-w-4xl text-center leading-relaxed text-brand-500">Pour découvrir et expérimenter ces avantages par vous-même, appelez nos dentistes experts au <a href="tel:+212693133170" class="font-semibold underline">+212 693 133 170</a> ou envoyez-nous un courriel à <a href="mailto:contact@cleartrack.ma" class="font-semibold underline">contact@cleartrack.ma</a> pour une consultation GRATUITE avec nos orthodontistes certifiés</p>
        </div>
    </section>
@endsection
