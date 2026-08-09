@extends('layouts.app')

@section('title', 'Démarrer un traitement — Espace Médecin ClearTrack® align')
@section('meta_description', 'Soumettez le dossier clinique de votre patient (photos, radios, prescription) pour une estimation de devis gratuite ou la fabrication des aligneurs.')

@section('content')
    <section class="bg-waves pb-12">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Démarrer un traitement</h1>
            <p class="mt-4 max-w-3xl text-white/90">Les médecins dentistes ayant déjà des prérequis en orthodontie par aligneurs ou ayant complété l’une des formations avec Cleartrack® peuvent démarrer un traitement directement et être référencés sur notre plateforme.</p>
        </div>
    </section>

    <x-medecin-nav />

    {{-- Soumission de cas — fond blanc à vagues (section pleine largeur, conteneur centré à l'intérieur) --}}
    <section class="bg-waves-light">
        <div class="mx-auto max-w-4xl px-4 py-14 sm:px-6">
        @if (session('succes'))
            <div class="mb-8 rounded-2xl border-2 border-green-500 bg-green-50 p-6 text-center" role="status">
                <p class="text-lg font-bold text-green-700">Votre cas a bien été soumis&nbsp;!</p>
                <p class="mt-1 text-sm text-green-700">Notre équipe clinique l’étudiera et vous recontactera rapidement (estimation du devis sous 48&nbsp;h après réception des empreintes).</p>
            </div>
        @endif

        <form method="POST" action="{{ route('medecin.demarrer.store') }}" enctype="multipart/form-data" class="space-y-10" novalidate>
            @csrf
            <div class="hidden" aria-hidden="true"><label>Ne pas remplir <input type="text" name="site_web" tabindex="-1" autocomplete="off"></label></div>

            {{-- Médecin traitant --}}
            <fieldset>
                <legend class="text-lg font-bold text-brand-600">Médecin traitant</legend>
                <div class="mt-5 grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="medecin_nom" class="text-sm font-medium text-slate-700">Nom complet du médecin traitant <span class="text-red-500">*</span></label>
                        <input type="text" id="medecin_nom" name="medecin_nom" value="{{ old('medecin_nom') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                        @error('medecin_nom')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="cabinet_adresse" class="text-sm font-medium text-slate-700">Adresse du cabinet/clinique <span class="text-red-500">*</span></label>
                        <input type="text" id="cabinet_adresse" name="cabinet_adresse" value="{{ old('cabinet_adresse') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                        @error('cabinet_adresse')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
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
                </div>
            </fieldset>

            {{-- Patient --}}
            <fieldset>
                <legend class="text-lg font-bold text-brand-600">Patient</legend>
                <div class="mt-5 grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="patient_nom" class="text-sm font-medium text-slate-700">Nom complet du patient <span class="text-red-500">*</span></label>
                        <input type="text" id="patient_nom" name="patient_nom" value="{{ old('patient_nom') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                        @error('patient_nom')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="patient_age" class="text-sm font-medium text-slate-700">Âge du patient <span class="text-red-500">*</span></label>
                        <input type="number" id="patient_age" name="patient_age" min="5" max="100" value="{{ old('patient_age') }}" required class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                        @error('patient_age')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </fieldset>

            {{-- Prescription --}}
            <fieldset>
                <legend class="text-lg font-bold text-brand-600">Prescription</legend>

                <div class="mt-5">
                    <p class="text-sm font-medium text-slate-700">Demande de <span class="text-red-500">*</span></p>
                    <div class="mt-2 flex flex-wrap gap-3">
                        @foreach (['estimation' => 'Estimation du devis (gratuit)', 'conception' => 'Conception', 'conception-fabrication' => 'Conception et fabrication'] as $val => $label)
                            <label class="flex cursor-pointer items-center gap-2 rounded-full border-2 border-brand-300 px-4 py-2 text-sm font-medium has-checked:border-brand-500 has-checked:bg-brand-50">
                                <input type="radio" name="type_demande" value="{{ $val }}" @checked(old('type_demande') === $val) class="accent-brand-500">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    @error('type_demande')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mt-5">
                    <p class="text-sm font-medium text-slate-700">Arcade à traiter <span class="text-red-500">*</span></p>
                    <div class="mt-2 flex flex-wrap gap-3">
                        @foreach (['bimaxillaire' => 'Bimaxillaire', 'haut' => 'Haut seulement', 'bas' => 'Bas seulement'] as $val => $label)
                            <label class="flex cursor-pointer items-center gap-2 rounded-full border-2 border-brand-300 px-4 py-2 text-sm font-medium has-checked:border-brand-500 has-checked:bg-brand-50">
                                <input type="radio" name="arcade" value="{{ $val }}" @checked(old('arcade') === $val) class="accent-brand-500">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    @error('arcade')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mt-5">
                    <p class="text-sm font-medium text-slate-700">Correction souhaitée <span class="text-red-500">*</span></p>
                    <div class="mt-2 grid gap-3">
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border-2 border-brand-300 p-4 text-sm has-checked:border-brand-500 has-checked:bg-brand-50">
                            <input type="radio" name="correction" value="esthetique" @checked(old('correction') === 'esthetique') class="mt-0.5 accent-brand-500">
                            <span><strong>Esthétique seulement</strong> — fermeture des espaces, encombrements et alignement du bloc antérieur seul. <em>NB&nbsp;: peut requérir plus de RIP.</em></span>
                        </label>
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border-2 border-brand-300 p-4 text-sm has-checked:border-brand-500 has-checked:bg-brand-50">
                            <input type="radio" name="correction" value="esthetique-fonctionnelle" @checked(old('correction') === 'esthetique-fonctionnelle') class="mt-0.5 accent-brand-500">
                            <span><strong>Esthétique et fonctionnelle</strong> — alignement, correction de la ligne médiane, overjet, overbite, des rapports occlusaux et extractions.</span>
                        </label>
                    </div>
                    @error('correction')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mt-5 grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="dents_ne_pas_deplacer" class="text-sm font-medium text-slate-700">Ne pas déplacer ces dents — n°</label>
                        <input type="text" id="dents_ne_pas_deplacer" name="dents_ne_pas_deplacer" value="{{ old('dents_ne_pas_deplacer') }}" placeholder="ex. 11, 24" class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                        <p class="mt-1 text-xs text-slate-500">Bridges, implants et dents ankylosées ne doivent pas bouger.</p>
                    </div>
                    <div>
                        <label for="dents_sans_attachements" class="text-sm font-medium text-slate-700">Ne pas placer d’attachements sur ces dents — n°</label>
                        <input type="text" id="dents_sans_attachements" name="dents_sans_attachements" value="{{ old('dents_sans_attachements') }}" placeholder="ex. 12, 22" class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                        <p class="mt-1 text-xs text-slate-500">Couronnes et restaurations vestibulaires.</p>
                    </div>
                </div>

                <div class="mt-5">
                    <label for="instructions" class="text-sm font-medium text-slate-700">Instructions supplémentaires</label>
                    <textarea id="instructions" name="instructions" rows="4" class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">{{ old('instructions') }}</textarea>
                    @error('instructions')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </fieldset>

            {{-- Dossier photos / radios --}}
            <fieldset>
                <legend class="text-lg font-bold text-brand-600">Photos et radios du patient</legend>
                <p class="mt-1 text-sm text-slate-500">Formats acceptés&nbsp;: JPG, PNG ou PDF — 15&nbsp;Mo max par fichier. Les champs marqués * sont requis.</p>
                <div class="mt-5 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($typesFichiers as $type => [$label, $requis])
                        <x-photo-drop :name="'fichier_' . $type" :label="$label . ($requis ? ' *' : '')"
                                      accept="image/jpeg,image/png,application/pdf" />
                    @endforeach
                </div>
            </fieldset>

            {{-- Options + consentement --}}
            <fieldset class="space-y-4">
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="gouttiere_essai" value="1" @checked(old('gouttiere_essai')) class="mt-0.5 accent-brand-500">
                    <span>Je souhaite m’assurer de la coopération de mon patient et lui offrir une <strong>gouttière d’essai (passive)</strong> avant de démarrer la fabrication du traitement.</span>
                </label>
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="contact_formation" value="1" @checked(old('contact_formation')) class="mt-0.5 accent-brand-500">
                    <span>Je souhaite être contacté pour une inscription à la prochaine <strong>formation Cleartrack® align</strong>.</span>
                </label>
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="consentement" value="1" required class="mt-0.5 accent-brand-500">
                    <span>En cochant cette case et remplissant le présent formulaire, je déclare avoir lu et approuvé les <a href="{{ route('cgu') }}" class="text-brand-600 underline">conditions générales</a> et la <a href="{{ route('confidentialite') }}" class="text-brand-600 underline">politique de confidentialité</a> du produit et service. <span class="text-red-500">*</span></span>
                </label>
                @error('consentement')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            </fieldset>

            <button type="submit" class="btn-brand px-10">Envoyer</button>
        </form>
        </div>
    </section>
@endsection
