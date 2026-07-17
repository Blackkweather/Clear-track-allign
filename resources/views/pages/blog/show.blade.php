@extends('layouts.app')

@section('title', $post->titre . ' — Blog ClearTrack® align')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($post->extrait), 155))
@if ($post->image)
    @section('og_image', asset($post->image))
@endif

@push('head')
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $post->titre,
        'description' => strip_tags($post->extrait),
        'image' => $post->image ? asset($post->image) : null,
        'datePublished' => $post->publie_le->toAtomString(),
        'dateModified' => $post->updated_at->toAtomString(),
        'author' => ['@type' => 'Organization', 'name' => 'ClearTrack® align'],
        'publisher' => ['@type' => 'Organization', 'name' => 'ClearTrack® align', 'logo' => ['@type' => 'ImageObject', 'url' => asset('assets/brand/logo-on-white.png')]],
        'mainEntityOfPage' => url()->current(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <p class="text-sm font-medium uppercase tracking-wide text-white/80">
                <a href="{{ route('blog.index') }}" class="hover:underline">Blog</a> ·
                <time datetime="{{ $post->publie_le->toDateString() }}">{{ $post->publie_le->translatedFormat('j F Y') }}</time>
            </p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-white md:text-4xl">{{ $post->titre }}</h1>
        </div>
    </section>

    <article class="mx-auto max-w-3xl px-4 py-16 sm:px-6">
        @if ($post->image)
            <img src="{{ asset($post->image) }}" alt="" class="mb-10 w-full rounded-2xl shadow-lg" fetchpriority="high">
        @endif
        <div class="prose-cleartrack space-y-5 leading-relaxed">
            {!! $post->contenu !!}
        </div>

        <div class="mt-12 rounded-2xl bg-brand-50 p-8 text-center">
            <h2 class="text-xl font-bold text-brand-700">Prêt à transformer votre sourire&nbsp;?</h2>
            <p class="mt-2 text-sm text-slate-600">Réservez une consultation gratuite dans un cabinet certifié ClearTrack® partout au Maroc.</p>
            <a href="{{ route('rdv') }}" class="btn-brand mt-5">Prendre RDV</a>
        </div>
    </article>
@endsection
