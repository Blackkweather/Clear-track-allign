@extends('layouts.app')

@section('title', 'Pourquoi choisir Cleartrack®align ? — ClearTrack® align')
@section('meta_description', 'Conception par orthodontistes experts, contrôle complet de la production, prix abordables et assistance clinique complète : découvrez la différence Cleartrack®align.')

@section('content')
    {{-- En-tête (PPT slide 18) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="max-w-3xl text-3xl font-bold text-white md:text-4xl">Pourquoi choisir le traitement Cleartrack®align&nbsp;?</h1>
            <p class="mt-4 max-w-2xl text-white/90">Les aligneurs Cleartrack® sont conçus et développés par des orthodontistes qualifiés et expérimentés.</p>
        </div>
    </section>

    {{-- 4 raisons (PPT slides 18-19) --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
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

    {{-- Comparaison matériau (PPT slides 20-22) --}}
    <section class="bg-waves" aria-labelledby="materiau-titre">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <h2 id="materiau-titre" class="text-3xl font-bold text-white md:text-4xl">Aligneurs avec matériau de meilleure qualité</h2>
            <p class="mt-3 max-w-2xl text-white/90">Un matériau biocompatible personnalisé de nos aligneurs, qui présente les avantages suivants&nbsp;:</p>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @php
                    $comparaisons = [
                        ['titre' => 'Plus clairs', 'ct' => 'Transparence supérieure, quasi invisibles au quotidien.', 'autres' => 'Opacité et visibilité plus marquées.'],
                        ['titre' => 'Plus confortables', 'ct' => 'Polis à la main pour des bords plus lisses.', 'autres' => 'Bords bruts pouvant irriter gencives et joues.'],
                        ['titre' => 'Pas de décoloration', 'ct' => 'Gardent leur transparence s’ils restent à l’abri de produits colorants.', 'autres' => 'Jaunissement apparent avec le temps.'],
                    ];
                @endphp
                @foreach ($comparaisons as $c)
                    <div class="card">
                        <h3 class="text-lg font-bold text-brand-600">{{ $c['titre'] }}</h3>
                        <dl class="mt-4 space-y-4 text-sm">
                            <div>
                                <dt class="font-semibold text-brand-500">Cleartrack®align</dt>
                                <dd class="mt-1">{{ $c['ct'] }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-slate-400">Autres aligneurs</dt>
                                <dd class="mt-1 text-slate-500">{{ $c['autres'] }}</dd>
                            </div>
                        </dl>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                <a href="{{ route('fabrication') }}" class="btn-white">Comment sont-ils fabriqués&nbsp;?</a>
            </div>
        </div>
    </section>

    {{-- Pourquoi les aligneurs plutôt que les appareils (PPT slide 23) --}}
    <section class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
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
