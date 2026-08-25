@extends('layouts.app')

@section('title', 'Blog — ClearTrack® align')
@section('meta_description', 'Conseils, actualités et guides sur les aligneurs dentaires invisibles par ClearTrack® align.')

@section('content')
    {{-- En-tête (PPT slide 32) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Blog</h1>
        </div>
    </section>

    {{-- Liste des articles — fond blanc à vagues (section pleine largeur, conteneur centré à l'intérieur) --}}
    <section class="bg-waves-light">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        @if ($posts->isEmpty())
            <p class="py-20 text-center text-slate-500">Aucun article publié pour le moment — revenez bientôt&nbsp;!</p>
        @else
            {{-- Cartes d'articles (PPT slide 33) --}}
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <article class="card flex flex-col overflow-hidden !p-0">
                        @if ($post->image)
                            <a href="{{ route('blog.show', $post) }}" tabindex="-1" aria-hidden="true">
                                <img src="{{ asset($post->image) }}" alt="" class="h-44 w-full object-cover" loading="lazy">
                            </a>
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                            <time datetime="{{ $post->publie_le->toDateString() }}" class="text-xs font-medium uppercase tracking-wide text-ppt-blue">
                                {{ $post->publie_le->translatedFormat('j F Y') }}
                            </time>
                            <h2 class="mt-2 text-lg font-bold text-ppt-blue">
                                <a href="{{ route('blog.show', $post) }}" class="hover:underline">{{ $post->titre }}</a>
                            </h2>
                            <p class="mt-3 flex-1 text-sm leading-relaxed text-slate-600">{{ \Illuminate\Support\Str::limit($post->extrait, 160) }}</p>
                            <a href="{{ route('blog.show', $post) }}" class="btn-outline-brand mt-5 self-start text-xs">Lire plus</a>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination (PPT slide 34 : Précédent 1 2 3 … Suivant) --}}
            <nav class="mt-12" aria-label="Pagination">
                {{ $posts->links() }}
            </nav>
        @endif
        </div>
    </section>
@endsection
