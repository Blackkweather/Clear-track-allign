@extends('layouts.app')

@section('title', ($titre ?? 'Page') . ' — ClearTrack® align')

@section('content')
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">{{ $titre ?? 'Page' }}</h1>
        </div>
    </section>
    <section class="bg-waves-light">
        <div class="mx-auto max-w-7xl px-4 py-20 text-center sm:px-6">
            <p class="text-lg text-slate-500">Contenu en cours d’intégration (Étape {{ $etape ?? '2' }}).</p>
        </div>
    </section>
@endsection
