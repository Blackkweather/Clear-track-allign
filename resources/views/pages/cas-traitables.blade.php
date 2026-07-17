@extends('layouts.app')

@section('title', 'Cas traitables — ClearTrack® align')
@section('meta_description', 'Espacements, encombrements, béance, supraclusion, infraclusion, articulé croisé, overjet : découvrez les malocclusions que Cleartrack® align peut corriger.')

@section('content')
    {{-- En-tête (PPT slide 46) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Cas traitables avec Cleartrack® align</h1>
            <p class="mt-4 max-w-2xl text-white/90">Cleartrack® align peut traiter la plupart des malocclusions courantes. Chaque cas est évalué par nos orthodontistes pour en confirmer la faisabilité.</p>
        </div>
    </section>

    {{-- Les 7 cas (PPT slides 46-50) --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        <div class="grid gap-8 md:grid-cols-2">
            @php
                $cas = [
                    ['img' => 'espacements', 'titre' => 'Espacements', 'texte' => 'Les diastèmes ou les espaces entre les dents sont un problème courant. Selon une étude, 1 personne sur 4 a ce problème. C’est le problème orthodontique le plus facile à résoudre avec Cleartrack® align et il peut être traité en un temps très court.'],
                    ['img' => 'encombrements', 'titre' => 'Encombrements ou chevauchements', 'texte' => 'L’encombrement dentaire se produit généralement chez les personnes dont le visage est plus petit. En raison d’un espace insuffisant, les dents ne peuvent pas faire une éruption droite, dans leur position correcte. Il en résulte que les dents sont retournées et se chevauchent brusquement. L’encombrement nécessite généralement un plan de traitement plus long, mais la plupart des cas peuvent être corrigés avec les aligneurs. Nous serons en mesure de vous dire si le cas peut être corrigé à l’aide des aligneurs une fois que nous aurons pris les empreintes.'],
                    ['img' => 'beance', 'titre' => 'Béance (Open bite)', 'texte' => 'Vous avez une béance lorsque vos dents supérieures et inférieures ne se touchent pas lorsque la bouche est fermée. Un tel problème existe généralement parce que les dents ne sont pas alignées correctement. Ce problème peut également être corrigé avec Cleartrack® align. La plupart des cas sont simples et ne nécessitent pas d’appareil dentaire. Ils peuvent être corrigés à l’aide d’aligneurs.'],
                    ['img' => 'supraclusion', 'titre' => 'Supraclusion (Deep bite)', 'texte' => 'La supraclusion est un problème orthodontique dans lequel les dents supérieures recouvrent excessivement les dents inférieures de devant lorsque la bouche est fermée. Il s’agit généralement d’un problème esthétique. Les aligneurs Cleartrack® align peuvent résoudre la plupart des cas de supraclusion, mais chaque cas doit être évalué pour en comprendre le niveau de complexité. Dans la plupart des cas cependant, le problème devrait être corrigé à l’aide des aligneurs.'],
                    ['img' => 'infraclusion', 'titre' => 'Infraclusion (Under bite)', 'texte' => 'Une infraclusion est un état dans lequel, lorsque vous fermez la bouche, vos dents inférieures avant restent devant vos dents supérieures. Dans la plupart des cas, ce problème se produit parce que la mâchoire inférieure est en position plus avancée que la mâchoire supérieure. Ces cas sont un peu difficiles avec les aligneurs mais les cas simples peuvent être corrigés. Notre équipe d’orthodontistes experts confirmera si un cas est possible avec les aligneurs une fois que nous aurons reçu les empreintes.'],
                    ['img' => 'articule-croise', 'titre' => 'Articulé croisé (Cross bite)', 'texte' => 'Cette situation est similaire à une infraclusion. Dans le cas d’une occlusion croisée, certaines des dents du haut sont placées juste derrière les dents du bas. Les aligneurs Cleartrack align peuvent résoudre la plupart des cas de cross bite de manière très efficace.'],
                    ['img' => 'overjet', 'titre' => 'Overjet et torque coronaire', 'texte' => 'Cette situation est similaire à une supraclusion. C’est un problème orthodontique dans lequel les dents supérieures sont projetées excessivement par rapport aux dents inférieures de devant. Il s’agit généralement d’un problème esthétique. Les aligneurs Cleartrack® align peuvent résoudre la plupart de ces cas, mais chaque cas doit être évalué pour en comprendre le niveau de complexité.'],
                ];
            @endphp
            @foreach ($cas as $c)
                <article class="card flex flex-col items-start gap-4 sm:flex-row">
                    <img src="{{ asset('assets/cas/' . $c['img'] . '.png') }}" alt="Illustration : {{ $c['titre'] }}" class="h-28 w-28 shrink-0 object-contain" loading="lazy">
                    <div>
                        <h2 class="text-lg font-bold text-brand-600">{{ $c['titre'] }}</h2>
                        <p class="mt-2 text-sm leading-relaxed">{{ $c['texte'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- CTA (PPT slide 49) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 text-center text-white sm:px-6">
            <p class="text-xl font-semibold">Qu’attendez-vous&nbsp;?</p>
            <h2 class="mx-auto mt-3 max-w-2xl text-2xl font-bold md:text-3xl">Nous sommes impatients de vous offrir le meilleur sourire que vous méritez. Planifiez une première consultation avec un orthodontiste entièrement gratuite&nbsp;!</h2>
            <a href="{{ route('rdv') }}" class="btn-white mt-8">Démarrer</a>
        </div>
    </section>
@endsection
