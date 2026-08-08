@extends('layouts.app')

@section('title', 'Comment sont fabriqués les aligneurs — ClearTrack® align')
@section('meta_description', 'Imagerie 3D, planification du traitement, impression de modèles 3D, thermoformage à haute pression et contrôle qualité : la fabrication des aligneurs Cleartrack® align.')

@section('content')
    {{-- En-tête (PPT slide 52) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="page-title max-w-3xl text-white">Comment les aligneurs Cleartrack® align sont fabriqués</h1>
            <a href="{{ route('rdv') }}" class="btn-white mt-6">Démarrer mon traitement</a>
        </div>
    </section>

    {{-- Introduction (PPT slide 53) --}}
    <section class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
        <div>
            <h2 class="section-title">Voyons d’abord ce que sont les aligneurs Cleartrack® align</h2>
            <p class="mt-4 leading-relaxed">Prescrits par votre dentiste, les aligneurs Cleartrack® align sont des gouttières transparentes qui ont été développées spécifiquement pour aligner vos dents de manière prévisible, douce, claire et confortable. Au lieu d’attaches métalliques, de fils ou de vis, vous porterez un matériau thermoplastique qui vous permettra d’obtenir les résultats souhaités, tout en passant inaperçu aux yeux de votre entourage.</p>
            <p class="mt-4 leading-relaxed">Les gouttières transparentes fonctionnent selon les principes orthodontiques de base. Elles sont utilisées pour corriger des dents de travers, des espaces ou des rotations, tout en obtenant les résultats souhaités de manière organisée et planifiée. Ces gouttières sur mesure sont «&nbsp;invisibles&nbsp;» et déplacent la dent dans la direction souhaitée. Pour ce faire, on porte une série de gouttières, chacune pendant 22 heures par jour, 1 à 2 semaines à la fois (une étape), qui déplacent les dents par étape jusqu’à ce que leur alignement optimal soit atteint.</p>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('assets/ppt/slide53.jpg') }}" alt="Aligneur transparent Cleartrack align" class="w-full max-w-md rounded-2xl shadow-xl" loading="lazy">
        </div>
    </section>

    {{-- Étapes cliniques + laboratoire (PPT slide 54) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <h2 class="text-center text-3xl font-bold text-white md:text-4xl">La fabrication des aligneurs comporte quelques étapes pour obtenir ce sourire magique&nbsp;!</h2>
            <div class="mt-10 grid gap-6 md:grid-cols-2">
                <div class="card">
                    <h3 class="text-lg font-bold text-brand-600">Étapes cliniques</h3>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Contrôle de la santé bucco-dentaire par le dentiste</li>
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Empreintes — numériques ou physiques</li>
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Images de contrôle de la qualité</li>
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Rayons X</li>
                    </ul>
                </div>
                <div class="card">
                    <h3 class="text-lg font-bold text-brand-600">Étapes de laboratoire</h3>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Scans ou imagerie 3D</li>
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Planification du traitement en 3D</li>
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Impression de modèles 3D</li>
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Thermoformage à pression positive</li>
                        <li class="flex gap-3"><span class="text-brand-500" aria-hidden="true">✓</span>Contrôle de qualité</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Procédure de laboratoire (PPT slides 55-57) --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        <h2 class="section-title text-center">Procédure de laboratoire Cleartrack®</h2>
        <div class="mt-10 space-y-10">
            <div class="grid items-center gap-8 md:grid-cols-2">
                <div>
                    <h3 class="text-xl font-bold text-brand-600">Imagerie 3D et planification du traitement</h3>
                    <p class="mt-3 leading-relaxed">Un scanner ou une empreinte en 3D est réalisé pour obtenir une réplique de vos dents. Une fois l’imagerie prête, des modèles 3D sont fabriqués pour chaque étape du traitement Cleartrack®. Une configuration virtuelle est alors préparée pour montrer au médecin le traitement prévu à chaque étape ainsi que le résultat final. Cela donne un avantage au traitement Cleartrack® par rapport au traitement orthodontique traditionnel, car le médecin voit le résultat final avant même que vous ne commenciez le traitement.</p>
                    <h3 class="mt-8 text-xl font-bold text-brand-600">Modèles 3D</h3>
                    <p class="mt-3 leading-relaxed">Des modèles 3D sont imprimés pour chaque étape du traitement Cleartrack dans nos laboratoires à l’aide d’imprimantes 3D dotées de la technologie MSLA. Nous garantissons la rapidité d’exécution de votre traitement.</p>
                    <h3 class="mt-8 text-xl font-bold text-brand-600">Toutes les imprimantes 3D ne sont pas égales</h3>
                    <p class="mt-3 leading-relaxed">Après plus de trois ans d’impression, nos laboratoires ont mis au point une méthode unique d’impression 3D précise. La technologie révolutionnaire MSLA permet à nos imprimantes d’atteindre des vitesses d’impression record, bien plus rapides que celles des imprimantes SLA ou DLP existantes.</p>
                </div>
                <div class="flex justify-center">
                    <img src="{{ asset('assets/ppt/slide55.png') }}" alt="Impression 3D des modèles dentaires au laboratoire Cleartrack" class="w-full max-w-md rounded-2xl shadow-xl" loading="lazy">
                </div>
            </div>
            <div class="grid items-center gap-8 md:grid-cols-2">
                <div class="flex justify-center md:order-2">
                    <img src="{{ asset('assets/ppt/slide56.jpg') }}" alt="Thermoformage des aligneurs sur les modèles imprimés en 3D" class="w-full max-w-md rounded-2xl shadow-xl" loading="lazy">
                </div>
                <div class="md:order-1">
                    <h3 class="text-xl font-bold text-brand-600">Thermoformage</h3>
                    <p class="mt-3 leading-relaxed">L’étape du thermoformage est celle où les modèles imprimés en 3D rencontrent le matériau thermoplastique utilisé pour créer les aligneurs Cleartrack®. Le thermoformage à haute pression est nécessaire pour former les aligneurs sur les modèles imprimés en 3D. Cette étape est importante car, pour créer des aligneurs clairs avec un mouvement dentaire prévisible, une précision est nécessaire sur les dents, la définition de la ligne gingivale et les textures gingivales.</p>
                    <h3 class="mt-8 text-xl font-bold text-brand-600">Contrôle de qualité</h3>
                    <p class="mt-3 leading-relaxed">Avant d’autoriser la livraison des aligneurs à votre prestataire, un contrôle de qualité complet est effectué pour vérifier toutes les marges, les bordures, les épaisseurs, la numérotation et la forme de l’arcade de vos aligneurs. La différence Cleartrack® est claire.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Instructions de base (PPT slide 56) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <h2 class="text-3xl font-bold text-white md:text-4xl">Instructions de base</h2>
            <ul class="mt-6 max-w-3xl space-y-3 text-white/90">
                <li class="flex gap-3"><span aria-hidden="true">✓</span>Les aligneurs doivent être portés 20 à 22 heures par jour.</li>
                <li class="flex gap-3"><span aria-hidden="true">✓</span>Passez au jeu suivant après 1 à 2 semaines (ou selon les instructions de votre dentiste).</li>
                <li class="flex gap-3"><span aria-hidden="true">✓</span>Il est important de l’insérer et de le retirer correctement.</li>
                <li class="flex gap-3"><span aria-hidden="true">✓</span>Le nettoyage des gouttières est important pour maintenir une bonne hygiène buccale.</li>
                <li class="flex gap-3"><span aria-hidden="true">✓</span>Tous nos traitements sont livrés à votre dentiste avec un manuel d’instructions complet pour vous.</li>
            </ul>
            <a href="{{ route('rdv') }}" class="btn-white mt-8">Démarrer mon traitement</a>
        </div>
    </section>
@endsection
