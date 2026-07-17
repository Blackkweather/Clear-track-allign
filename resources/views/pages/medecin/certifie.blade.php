@extends('layouts.app')

@section('title', 'Devenir certifié Cleartrack® — Espace Médecin ClearTrack® align')
@section('meta_description', 'Rejoignez le réseau des médecins dentistes certifiés Cleartrack® et soyez référencé sur notre plateforme.')

@section('content')
    <section class="bg-waves pb-12">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Devenir certifié Cleartrack®</h1>
            <p class="mt-4 max-w-3xl text-white/90">Les médecins dentistes ayant déjà des prérequis en orthodontie par aligneurs ou ayant complété l’une des formations avec Cleartrack® peuvent démarrer un traitement directement et être référencés sur notre plateforme sans devoir remplir le formulaire suivant.</p>
        </div>
    </section>

    <x-medecin-nav />

    <section class="mx-auto max-w-3xl px-4 py-14 sm:px-6">
        @if (session('succes'))
            <div class="mb-8 rounded-2xl border-2 border-green-500 bg-green-50 p-6 text-center" role="status">
                <p class="text-lg font-bold text-green-700">Votre demande de certification a bien été envoyée&nbsp;!</p>
                <p class="mt-1 text-sm text-green-700">Notre équipe vous recontactera pour la suite du processus.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('medecin.certifie.store') }}" class="space-y-6" novalidate>
            @csrf
            <div class="hidden" aria-hidden="true"><label>Ne pas remplir <input type="text" name="site_web" tabindex="-1" autocomplete="off"></label></div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="medecin_nom" class="text-sm font-medium text-slate-700">Nom complet du médecin <span class="text-red-500">*</span></label>
                    <input type="text" id="medecin_nom" name="medecin_nom" value="{{ old('medecin_nom') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('medecin_nom')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="structure" class="text-sm font-medium text-slate-700">Nom de la structure</label>
                    <input type="text" id="structure" name="structure" value="{{ old('structure') }}" class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                </div>
                <div class="md:col-span-2">
                    <label for="adresse" class="text-sm font-medium text-slate-700">Adresse du lieu d’exercice <span class="text-red-500">*</span></label>
                    <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('adresse')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="ville" class="text-sm font-medium text-slate-700">Ville <span class="text-red-500">*</span></label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('ville')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="telephone" class="text-sm font-medium text-slate-700">Numéro de téléphone <span class="text-red-500">*</span></label>
                    <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('telephone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="email" class="text-sm font-medium text-slate-700">E-mail <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="message" class="text-sm font-medium text-slate-700">Message supplémentaire</label>
                    <textarea id="message" name="message" rows="4" class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">{{ old('message') }}</textarea>
                </div>
            </div>

            <label class="flex items-start gap-3 text-sm">
                <input type="checkbox" name="contact_formation" value="1" @checked(old('contact_formation')) class="mt-0.5 accent-brand-500">
                <span>Je souhaite être contacté lors de l’ouverture de la prochaine inscription aux <strong>formations Cleartrack® align</strong>.</span>
            </label>

            <button type="submit" class="btn-brand px-10">Envoyer ma demande de certification</button>
        </form>
    </section>
@endsection
