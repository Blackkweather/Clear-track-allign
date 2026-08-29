@extends('layouts.app')

@section('title', 'Questions fréquemment posées — ClearTrack® align')
@section('meta_description', 'Toutes les réponses à vos questions sur les aligneurs ClearTrack : traitement, durée, port, entretien, contentions.')

@push('head')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $general->concat($traitement)->map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq->question,
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq->reponse],
        ])->values(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    {{-- En-tête (PPT slide 36) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-9 sm:py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Questions fréquemment posées</h1>
        </div>
    </section>

    {{-- Les deux groupes de questions — fond blanc à vagues (section pleine largeur, conteneur centré à l'intérieur) --}}
    <section class="bg-waves-light">
        <div class="mx-auto max-w-4xl px-4 py-10 sm:py-16 sm:px-6">
        <h2 class="section-title">Questions générales</h2>
        <div class="mt-6 space-y-3">
            @foreach ($general as $faq)
                <x-accordion-item :question="$faq->question" :reponse="$faq->reponse" />
            @endforeach
        </div>

        <h2 class="section-title mt-14">Comment le traitement fonctionne&nbsp;?</h2>
        <div class="mt-6 space-y-3">
            @foreach ($traitement as $faq)
                <x-accordion-item :question="$faq->question" :reponse="$faq->reponse" />
            @endforeach
        </div>
        </div>
    </section>

    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-9 sm:py-14 text-center text-white sm:px-6">
            <h2 class="text-2xl font-bold md:text-3xl">Vous avez une autre question&nbsp;?</h2>
            <p class="mx-auto mt-3 max-w-xl text-white/90">Contactez-nous sur WhatsApp ou réservez une consultation gratuite dans un cabinet certifié ClearTrack®.</p>
            <div class="mt-6 flex flex-wrap justify-center gap-4">
                <a href="https://wa.me/212693133170" target="_blank" rel="noopener" class="btn-white">Parler à un représentant</a>
                <a href="{{ route('rdv') }}" class="btn-outline-white">Prendre RDV</a>
            </div>
        </div>
    </section>
@endsection
