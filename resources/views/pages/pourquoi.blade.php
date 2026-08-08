@extends('layouts.app')

@section('title', 'Pourquoi choisir Cleartrack®align ? — ClearTrack® align')
@section('meta_description', 'Conception par orthodontistes experts, contrôle complet de la production, prix abordables et assistance clinique complète : découvrez la différence Cleartrack®align.')

@section('content')
    {{-- En-tête (PPT slide 18) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="page-title max-w-3xl text-white">Pourquoi choisir le traitement Cleartrack®align&nbsp;?</h1>
            <p class="texte-ppt mt-4 max-w-2xl text-white/90">Les aligneurs Cleartrack® sont conçus et développés par des orthodontistes qualifiés et expérimentés.</p>
        </div>
    </section>

    {{-- 4 raisons (PPT slides 18-19) — BLANC --}}
    <section class="mx-auto max-w-7xl bg-white px-4 py-16 sm:px-6">
        <div class="grid gap-8 md:grid-cols-2">
            @php
                $raisons = [
                    ['titre' => 'Basé sur la science des données', 'texte' => 'Les gouttières Cleartrack sont conçues et développées par des orthodontistes experts utilisant des systèmes de haute technologie basés sur l’intelligence artificielle et l’expérience de plus de 5 000 traitements dentaires réalisés dans des cliniques dentaires marocaines.'],
                    ['titre' => 'Un contrôle complet de la conception à la production', 'texte' => 'Cleartrack® dispose de son propre centre de conception high-tech équipé des derniers logiciels de 3Shape. Les modèles sont imprimés sur des imprimantes 3D 4K avec une précision de 100 microns. Chaque aligneur est ajusté et fini à la main par des techniciens experts.'],
                    ['titre' => 'Prix abordables et paiement planifié', 'texte' => 'Nous fournissons la meilleure qualité de traitement dentaire par gouttières aux prix les plus abordables possibles. Nous proposons également des options de paiement planifié.'],
                    ['titre' => 'Assistance clinique complète', 'texte' => 'Nous ne fournissons des traitements que dans des cliniques entièrement équipées, avec des dentistes experts, car les traitements par aligneurs nécessitent des traitements supplémentaires tels que les restaurations et le nettoyage des dents. Seul un dentiste peut garantir le suivi du traitement pour obtenir le résultat souhaité.'],
                ];
            @endphp
            @foreach ($raisons as $raison)
                <article class="card">
                    <h2 class="text-xl font-bold text-brand-600">{{ $raison['titre'] }}</h2>
                    <p class="mt-3 leading-relaxed">{{ $raison['texte'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ── LES 3 ATOUTS MATÉRIAU (PPT slides 20-22, priorités confirmées en réunion) ──
         Clarté / Confort / Durabilité, en fonds alternés, avec des images qui débordent
         volontairement de leur section (« casser la grille »). --}}

    {{-- 1. CLARTÉ — BLEU --}}
    <section class="section-bleed bg-waves" aria-labelledby="clarte-titre">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="text-white" data-typing-group>
                <p class="text-sm font-bold uppercase tracking-widest text-white/70">01 — Clarté</p>
                <h2 id="clarte-titre" class="section-title-invert mt-2">Transparents, sans stries</h2>
                <div class="mt-4 h-1 w-16 rounded bg-white/70"></div>
                <ul class="mt-6 space-y-3 text-white/90">
                    <li class="flex gap-3"><span class="font-bold" aria-hidden="true">✓</span><span data-typing>Un matériau réellement translucide, sans stries ni marques de découpe visibles.</span></li>
                    <li class="flex gap-3"><span class="font-bold" aria-hidden="true">✓</span><span data-typing>Une fois en bouche, l’effet est invisible&nbsp;: personne ne remarque que vous portez un aligneur.</span></li>
                    <li class="flex gap-3"><span class="font-bold" aria-hidden="true">✓</span><span data-typing>Les autres aligneurs présentent souvent une opacité et des striures plus marquées.</span></li>
                </ul>
            </div>
            <div class="flex justify-center">
                {{-- Débordement volontaire : l'aligneur dépasse en haut et en bas de la section --}}
                <img src="{{ asset('assets/aligneur-serre.png') }}"
                     alt="Aligneur Cleartrack® align transparent, sans stries visibles"
                     class="img-bleed no-reveal h-72 w-auto max-w-none drop-shadow-2xl md:h-[22rem] lg:h-[36rem]" loading="lazy">
            </div>
        </div>
    </section>

    {{-- 2. CONFORT — BLANC --}}
    <section class="section-bleed relative bg-white" aria-labelledby="confort-titre">
        {{-- Photo statique qui sort par le côté de la page (demande client) --}}
        <img src="{{ asset('assets/aligneur-doigts.png') }}" alt="" aria-hidden="true"
             class="pointer-events-none absolute -left-28 top-1/2 hidden w-72 -translate-y-1/2 opacity-90 lg:block xl:-left-20"
             loading="lazy">

        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="flex justify-center md:order-2">
                <img src="{{ asset('assets/aligneur-doigts.png') }}"
                     alt="Bord d’un aligneur Cleartrack® poli à la main, découpe lisse"
                     class="img-bleed h-64 w-auto max-w-none drop-shadow-xl md:h-[19rem] lg:h-[30rem]" loading="lazy">
            </div>
            <div class="md:order-1 lg:pl-24" data-typing-group>
                <p class="text-sm font-bold uppercase tracking-widest text-brand-400">02 — Confort</p>
                <h2 id="confort-titre" class="section-title mt-2">Des bords polis à la main</h2>
                <div class="mt-4 h-1 w-16 rounded bg-brand-400"></div>
                <ul class="mt-6 space-y-3">
                    <li class="flex gap-3"><span class="font-bold text-brand-500" aria-hidden="true">✓</span><span data-typing>Chaque aligneur est découpé puis poli à la main par nos techniciens.</span></li>
                    <li class="flex gap-3"><span class="font-bold text-brand-500" aria-hidden="true">✓</span><span data-typing>Des bords lisses, sans arête vive&nbsp;: aucun risque de blessure de la gencive ni de la joue.</span></li>
                    <li class="flex gap-3"><span class="font-bold text-brand-500" aria-hidden="true">✓</span><span data-typing>Les bords bruts des aligneurs industriels irritent fréquemment les tissus mous.</span></li>
                </ul>
            </div>
        </div>
    </section>

    {{-- 3. DURABILITÉ — BLEU --}}
    <section class="section-bleed bg-waves" aria-labelledby="durabilite-titre">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="text-white" data-typing-group>
                <p class="text-sm font-bold uppercase tracking-widest text-white/70">03 — Durabilité</p>
                <h2 id="durabilite-titre" class="section-title-invert mt-2">Ils ne jaunissent pas</h2>
                <div class="mt-4 h-1 w-16 rounded bg-white/70"></div>
                <ul class="mt-6 space-y-3 text-white/90">
                    <li class="flex gap-3"><span class="font-bold" aria-hidden="true">✓</span><span data-typing>Le matériau résiste à la coloration des boissons pigmentées (café, thé, sodas).</span></li>
                    <li class="flex gap-3"><span class="font-bold" aria-hidden="true">✓</span><span data-typing>Un simple nettoyage leur rend toute leur clarté d’origine.</span></li>
                    <li class="flex gap-3"><span class="font-bold" aria-hidden="true">✓</span><span data-typing>Là où d’autres aligneurs prennent une teinte jaune définitive au fil des semaines.</span></li>
                </ul>
                <a href="{{ route('fabrication') }}" class="btn-white mt-8">Comment sont-ils fabriqués&nbsp;?</a>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('assets/photo-aligneur-main.png') }}"
                     alt="Patiente tenant un aligneur Cleartrack® resté parfaitement transparent"
                     class="img-bleed h-80 w-auto max-w-none rounded-2xl bg-white shadow-2xl md:h-[22rem] lg:h-[34rem]" loading="lazy">
            </div>
        </div>
    </section>

    {{-- Pourquoi les aligneurs plutôt que les appareils (PPT slide 23) — BLANC --}}
    <section class="mx-auto grid max-w-7xl items-center gap-10 bg-white px-4 py-16 sm:px-6 md:grid-cols-2">
        <div>
            <h2 class="section-title">Pourquoi les gens choisissent les aligneurs plutôt que les appareils dentaires conventionnels&nbsp;?</h2>
            <p class="mt-4 leading-relaxed">La plupart des médecins et orthodontistes considèrent les aligneurs comme la solution idéale pour améliorer la santé bucco-dentaire, la confiance en soi et la personnalité, car ils offrent les avantages d’un traitement orthodontique sans les compromis et les problèmes associés aux appareils conventionnels.</p>
        </div>
        <div class="grid gap-6">
            @php
                $atouts = [
                    ['titre' => 'Clairs et discrets', 'texte' => 'Les aligneurs sont fabriqués en polyuréthane biocompatible, un matériau transparent et invisible.'],
                    ['titre' => 'Amovibles et confortables', 'texte' => 'Ils doivent être portés 22 heures par jour. Ils sont amovibles et très confortables. Une solution sans fil métallique.'],
                    ['titre' => 'Pas de restrictions alimentaires', 'texte' => 'Contrairement aux appareils métalliques. Continuez à vous régaler de pizzas, de hamburgers, et autres !'],
                ];
            @endphp
            @foreach ($atouts as $a)
                <div class="card">
                    <h3 class="font-bold text-brand-600">{{ $a['titre'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed">{{ $a['texte'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA consultation gratuite (PPT slides 23-24) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 text-center text-white sm:px-6">
            <h2 class="text-2xl font-bold md:text-3xl">Nous sommes impatients de vous offrir le meilleur sourire que vous méritez.</h2>
            <p class="mx-auto mt-4 max-w-2xl text-white/90">Planifiez une première consultation avec un orthodontiste entièrement gratuite&nbsp;! Pour découvrir et expérimenter ces avantages par vous-même, appelez nos dentistes experts au <a href="tel:+212693133170" class="font-semibold underline">+212 693 133 170</a> ou envoyez-nous un courriel à <a href="mailto:contact@cleartrack.ma" class="font-semibold underline">contact@cleartrack.ma</a> pour une consultation GRATUITE avec nos orthodontistes certifiés.</p>
            <a href="{{ route('rdv') }}" class="btn-white mt-8">Démarrer</a>
        </div>
    </section>
@endsection
