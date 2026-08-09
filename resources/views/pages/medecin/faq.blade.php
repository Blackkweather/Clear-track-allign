@extends('layouts.app')

@section('title', 'FAQ Médecin — Espace Médecin ClearTrack® align')
@section('meta_description', 'Les réponses aux questions des médecins dentistes sur les aligneurs Cleartrack® : dossiers, garanties, gouttières d’essai, délais.')

@section('content')
    <section class="bg-waves pb-12">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">FAQ Médecin</h1>
            <p class="mt-4 max-w-3xl text-white/90">Vous pouvez également demander à être contacté lors de l’ouverture de la prochaine inscription à la formation Cleartrack en remplissant le formulaire «&nbsp;Devenir certifié Cleartrack®&nbsp;». Si vous ne trouvez pas ce que vous cherchez, n’hésitez pas à nous contacter&nbsp;!</p>
        </div>
    </section>

    <x-medecin-nav />

    {{-- FAQ Médecin — fond blanc à vagues (section pleine largeur, conteneur centré à l'intérieur) --}}
    <section class="bg-waves-light">
        <div class="mx-auto max-w-4xl px-4 py-14 sm:px-6">
        @if ($faqs->isEmpty())
            <p class="py-16 text-center text-slate-500">Les réponses de la FAQ Médecin sont en cours de rédaction — contactez-nous à <a href="mailto:customer@cleartrack.ma" class="text-brand-600 underline">customer@cleartrack.ma</a> pour toute question.</p>
        @else
            <div class="space-y-3">
                @foreach ($faqs as $faq)
                    <x-accordion-item :question="$faq->question" :reponse="$faq->reponse" />
                @endforeach
            </div>
        @endif

        <div class="card mt-10 !p-6 text-center">
            <p class="text-sm text-slate-600">Une question spécifique sur un cas&nbsp;?</p>
            <div class="mt-4 flex flex-wrap justify-center gap-3">
                <a href="https://wa.me/212693133170" target="_blank" rel="noopener" class="btn-brand text-xs">Parler à un représentant</a>
                <a href="mailto:customer@cleartrack.ma" class="btn-outline-brand text-xs">customer@cleartrack.ma</a>
            </div>
        </div>
        </div>
    </section>
@endsection
