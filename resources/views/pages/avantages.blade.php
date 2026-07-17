@extends('layouts.app')

@section('title', 'Avantages de Cleartrack® align — ClearTrack® align')
@section('meta_description', 'Résultat visible avant de commencer, aucune restriction alimentaire, quasi invisible, amovible et rapide : tous les avantages des aligneurs Cleartrack® align.')

@section('content')
    {{-- En-tête (PPT slide 27) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Avantages de Cleartrack® align</h1>
        </div>
    </section>

    {{-- 8 avantages (PPT slides 27-29) --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        <div class="grid gap-8 md:grid-cols-2">
            @php
                $avantages = [
                    ['titre' => 'Des médecins qui vous informent', 'texte' => 'Nos médecins certifiés vous tiendront toujours informés de l’évolution de votre cas, vous assurant un confort tout au long du traitement.'],
                    ['titre' => 'Vous pouvez voir le résultat', 'texte' => 'Le plan de traitement virtuel, qui est une planification de traitement en 3D, vous permettra de visualiser le déroulement et la position finale de vos dents à la fin de votre traitement avant même de commencer.'],
                    ['titre' => 'Aucune restriction sur ce que vous pouvez manger/boire', 'texte' => 'Vous pouvez généralement manger tout ce que vous désirez pendant le traitement car les aligneurs sont retirés lors du repas/de la boisson. Il n’est donc pas nécessaire de vous abstenir de consommer vos aliments et boissons préférés, sauf si votre médecin vous le demande.'],
                    ['titre' => 'Virtuellement invisible', 'texte' => 'Cleartrack® align est pratiquement invisible et discret, de sorte que la plupart des gens ne remarqueront même pas que vous le portez.'],
                    ['titre' => 'Pas de dommages aux dents si l’aligneur est cassé ou tordu', 'texte' => 'Contactez votre médecin si vous avez perdu ou cassé un aligneur. Votre médecin peut vous recommander de revenir temporairement à l’aligneur précédent pendant la fabrication d’un remplacement&nbsp;: il est utile de conserver le dernier aligneur utilisé.'],
                    ['titre' => 'Sûr et amovible', 'texte' => 'Ce qui vous permet de vous brosser les dents, d’utiliser du fil dentaire et de maintenir une bonne hygiène buccale. Les appareils dentaires traditionnels présentent des problèmes tels que les bouts de nourriture coincés dans les fils et les brackets, ce qui entraîne des caries et des maladies des gencives. Les aligneurs Cleartrack® sont amovibles, ce qui vous permet de continuer à manger et à boire ce que vous voulez, et de faire du sport ou d’autres activités similaires.'],
                    ['titre' => 'Se sentir mieux dans sa peau', 'texte' => 'Enfin, et c’est le plus important à nos yeux, les aligneurs Cleartrack® vous aident à vous sentir mieux, car ils sont invisibles et aident à corriger les sourires sans qu’on le remarque et sans compromis.'],
                    ['titre' => 'Des résultats rapides', 'texte' => 'Comparé à d’autres méthodes d’alignement des dents, Cleartrack® agit rapidement. En moyenne, la durée totale du traitement est entre 3 à 12 mois et de nombreuses personnes remarquent des résultats en quelques semaines.'],
                ];
            @endphp
            @foreach ($avantages as $a)
                <article class="card">
                    <h2 class="text-lg font-bold text-brand-600">{{ $a['titre'] }}</h2>
                    <p class="mt-3 text-sm leading-relaxed">{{ $a['texte'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- CTA (PPT slide 29) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 text-center text-white sm:px-6">
            <p class="text-xl font-semibold">Qu’attendez-vous&nbsp;?</p>
            <h2 class="mx-auto mt-3 max-w-2xl text-2xl font-bold md:text-3xl">Nous sommes impatients de vous offrir le meilleur sourire que vous méritez. Planifiez une première consultation avec un orthodontiste entièrement gratuite&nbsp;!</h2>
            <a href="{{ route('rdv') }}" class="btn-white mt-8">Démarrer</a>
        </div>
    </section>
@endsection
