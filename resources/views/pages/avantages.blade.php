@extends('layouts.app')

@section('title', 'Avantages de Cleartrack® align — ClearTrack® align')
@section('meta_description', 'Résultat visible avant de commencer, aucune restriction alimentaire, quasi invisible, amovible et rapide : tous les avantages des aligneurs Cleartrack® align.')

@section('content')
    {{-- En-tête + chapô (PPT diapo 27 : fond blanc, titre bleu centré, chapô gris centré) --}}
    <section class="bg-waves-light">
        <div class="mx-auto max-w-7xl px-4 py-14 text-center sm:px-6">
            <h1 class="section-title">Avantages de Cleartrack® align</h1>
            <p class="mx-auto mt-3 max-w-4xl text-slate-500 md:text-xl">Nos médecins certifiés vous tiendront toujours informés de l’évolution de votre cas, vous assurant un confort tout au long du traitement</p>
        </div>
    </section>

    {{-- Les 7 avantages (PPT diapos 27-29) — icône à gauche, texte à droite, dans l'ordre des diapos --}}
    <section class="bg-waves-light">
        <div class="mx-auto max-w-7xl px-4 pb-16 sm:px-6">
        <div class="space-y-10">
            {{-- Textes recopiés mot pour mot des diapos 27-29, coquilles du PPT comprises
                 (« sont pratiquement invisible », « vous aide à se sentir mieux ») — D23. --}}
            @php
                $avantages = [
                    ['icone' => 'voir-resultat', 'titre' => 'Vous pouvez voir le résultat', 'texte' => 'Le plan de traitement virtuel, qui est une planification de traitement en 3D, vous permettra de visualiser le déroulement et la position finale de vos dents à la fin de votre traitement avant même de commencer'],
                    ['icone' => 'aucune-restriction', 'titre' => 'Aucune restriction sur ce que vous pouvez manger/boire', 'texte' => 'Vous pouvez généralement manger tout ce que vous désirez pendant le traitement car les aligneurs sont retirés lors du repas/de la boisson. Il n’est donc pas nécessaire de vous abstenir de consommer vos aliments et boissons préférés, sauf si votre médecin vous le demande'],
                    ['icone' => 'invisible', 'titre' => 'Virtuellement invisible', 'texte' => 'Cleartrack® align sont pratiquement invisible et discret, de sorte que la plupart des gens ne remarqueront même pas que vous le portez.'],
                    ['icone' => 'pas-de-dommages', 'titre' => 'Pas de dommages aux dents si l’aligneur est cassé ou tordu', 'texte' => 'Contactez votre médecin si vous avez perdu ou cassé un aligneur. Votre médecin peut vous recommander de revenir temporairement à l’aligneur précédent pendant la fabrication d’un remplacement, il est utile de conserver le dernier aligneur utilisé.'],
                    ['icone' => 'sur-amovible', 'titre' => 'Sûr et amovible', 'texte' => 'Ce qui vous permet de vous brosser les dents, d’utiliser du fil dentaire et de maintenir une bonne hygiène buccale. Les appareils dentaires traditionnels présentent des problèmes tels que les bouts de nourriture coincés dans les fils et les brackets, ce qui entraîne des caries et des maladies des gencives. Les aligneurs Cleartrack® sont amovibles, ce qui vous permet de continuer à manger et à boire ce que vous voulez, et de faire du sport ou d’autres activités similaires.'],
                    ['icone' => 'resultats-rapides', 'titre' => 'Des résultats rapides', 'texte' => 'Comparé à d’autres méthodes d’alignement des dents, Cleartrack® agit rapidement. En moyenne, la durée totale du traitement est entre 3 à 12 mois et de nombreuses personnes remarquent des résultats en quelques semaines.'],
                    ['icone' => 'mieux-dans-sa-peau', 'titre' => 'Se sentir mieux dans sa peau', 'texte' => 'Enfin, et c’est le plus important à nos yeux, les aligneurs Cleartrack® vous aide à se sentir mieux, car ils sont invisible et aident à corriger les sourires sans qu’on le remarque et sans compromis.'],
                ];
            @endphp
            @foreach ($avantages as $a)
                <article class="flex flex-col items-start gap-6 sm:flex-row sm:items-center">
                    <img src="{{ asset('assets/avantages/' . $a['icone'] . '.png') }}" alt="" aria-hidden="true"
                         class="h-24 w-24 shrink-0 object-contain sm:h-28 sm:w-28" loading="lazy">
                    <div>
                        {{-- Diapos 27-29 : les titres d'avantage sont soulignés --}}
                        <h2 class="text-xl font-bold text-brand-500 underline decoration-2 underline-offset-4 md:text-2xl">{{ $a['titre'] }}</h2>
                        <p class="mt-2 leading-relaxed">{{ $a['texte'] }}</p>
                    </div>
                </article>
            @endforeach
            </div>
        </div>
    </section>

    {{-- CTA (PPT diapo 29) : « Qu’attendez vous ? » est le grand titre, la phrase
         d'invitation vient en dessous en plus petit. Libellé sans trait d'union,
         comme dans le PPT (D23). --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 text-center text-white sm:px-6">
            <h2 class="section-title-invert">Qu’attendez vous&nbsp;?</h2>
            <p class="mx-auto mt-4 max-w-4xl text-white/90 md:text-lg">Nous sommes impatients de vous offrir le meilleur sourire que vous méritez. Planifiez une première consultation avec un orthodontiste entièrement gratuite&nbsp;!</p>
            <a href="{{ route('rdv') }}" class="btn-white mt-8">Démarrer</a>
        </div>
    </section>
@endsection
