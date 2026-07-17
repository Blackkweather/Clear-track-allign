@extends('layouts.app')

@section('title', 'Espace Médecin — ClearTrack® align')
@section('meta_description', 'Soumettez vos cas, devenez certifié Cleartrack®, téléchargez vos formulaires : l’espace dédié aux médecins dentistes partenaires.')

@section('content')
    {{-- En-tête (PPT slide 77) --}}
    <section class="bg-waves pb-12">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Espace Médecin</h1>
            <p class="mt-4 max-w-3xl text-white/90">Cleartrack® offre aux dentistes une solution qui permet de meilleurs résultats, plus rapides, au prix des concurrents directs.</p>
        </div>
    </section>

    <x-medecin-nav />

    {{-- Présentation (PPT slide 78) --}}
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
        <div class="grid items-start gap-10 md:grid-cols-2">
            <div>
                <h2 class="section-title">Développez votre cabinet avec Cleartrack®</h2>
                <p class="mt-4 leading-relaxed">Cleartrack® aide les praticiens dentaires à élargir la gamme de services qu’ils offrent, à fidéliser les patients et à stimuler la productivité globale avec une nouvelle source de revenus substantielle.</p>
                <p class="mt-4 leading-relaxed">Cleartrack® fournit une gamme complète de services pour ce qui est nécessaire&nbsp;:</p>
            </div>
            <ul class="grid gap-3">
                @foreach ([
                    'Consultations approfondies avec nos représentants',
                    'Service client 24h/24 et 6j/7',
                    'Formation et mises à jour des produits',
                    'Plans personnalisés avec des objectifs fixés par le cabinet',
                    'Support marketing',
                    'Emballage personnalisé',
                    'Matériel éducatif pour les médecins et les patients',
                ] as $service)
                    <li class="card flex items-center gap-3 !p-4 text-sm">
                        <svg class="h-5 w-5 shrink-0 text-brand-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                        {{ $service }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- CTA (PPT slide 78) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 text-center text-white sm:px-6">
            <h2 class="text-2xl font-bold md:text-3xl">Prêt à soumettre votre premier cas&nbsp;?</h2>
            <div class="mt-6 flex flex-wrap justify-center gap-4">
                <a href="{{ route('medecin.demarrer') }}" class="btn-white">Démarrer un traitement</a>
                <a href="{{ route('medecin.certifie') }}" class="btn-outline-white">Devenir certifié Cleartrack®</a>
            </div>
        </div>
    </section>
@endsection
