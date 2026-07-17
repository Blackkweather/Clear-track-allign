@extends('layouts.app')

@section('title', 'Centre de téléchargement — Espace Médecin ClearTrack® align')
@section('meta_description', 'Téléchargez la fiche de prescription simplifiée et les formulaires de consentement Cleartrack®, ou demandez du matériel marketing pour votre cabinet.')

@section('content')
    <section class="bg-waves pb-12">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Centre de téléchargement</h1>
            <p class="mt-4 max-w-3xl text-white/90">Vous pouvez ici télécharger ou demander des formulaires, demander du matériel de marketing pour votre cabinet et trouver de l’aide avec notre logiciel. Si vous découvrez Cleartrack®, vous pouvez également demander un dossier d’information gratuit pour votre cabinet.</p>
        </div>
    </section>

    <x-medecin-nav />

    <section class="mx-auto max-w-3xl px-4 py-14 sm:px-6">
        <h2 class="section-title">Formulaires</h2>
        <div class="mt-6 space-y-4">
            @foreach ($documents as $doc)
                <div class="card flex items-center justify-between gap-4 !p-5">
                    <div class="flex items-center gap-4">
                        <svg class="h-8 w-8 shrink-0 text-brand-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z"/><path d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z"/></svg>
                        <span class="font-semibold text-brand-700">{{ $doc->titre }}</span>
                    </div>
                    @if ($doc->fichier)
                        <a href="{{ asset($doc->fichier) }}" download class="btn-brand text-xs">Télécharger</a>
                    @else
                        <span class="rounded-full bg-slate-100 px-4 py-2 text-xs font-medium text-slate-500">Bientôt disponible</span>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="card mt-10 !p-6 text-center">
            <h2 class="text-lg font-bold text-brand-600">Matériel marketing &amp; dossier d’information</h2>
            <p class="mt-2 text-sm text-slate-600">Veuillez nous contacter si vous ne parvenez pas à trouver ce que vous cherchez.</p>
            <a href="mailto:contact@cleartrack.ma" class="btn-outline-brand mt-4 text-xs">contact@cleartrack.ma</a>
        </div>
    </section>
@endsection
