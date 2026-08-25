@extends('layouts.app')

@section('title', 'Prendre RDV — ClearTrack® align')
@section('meta_description', 'Réservez une consultation dentaire gratuite dans un des cabinets certifiés ClearTrack® partout au Maroc.')

@section('content')
    {{-- En-tête (PPT slides 70-71)
         Retour client : « in prendre rendez-vous i need the same gif as in the ppt ».
         Les diapos 70 et 71 posent une animation à droite du titre
         (ppt/media/image99.gif, 750 × 509) : une arcade dentaire dont les dents
         se replacent progressivement. C'est le seul fichier animé de tout le
         PowerPoint ; il est repris tel quel.

         Un GIF s'anime en boucle et ne peut être ni mis en pause ni ralenti par
         CSS. Deux garde-fous, donc, tous deux servant une image FIXE de mêmes
         dimensions (première vignette du GIF), la mise en page restant identique
         au pixel près :
           — version statique du site (CLEARTRACK_ANIMATIONS=false) : test Blade ;
           — `prefers-reduced-motion: reduce` : <source media> dans <picture>,
             évalué par le navigateur, seul moyen de substituer un fichier.
         L'animation est décorative : alt vide et aria-hidden, elle n'ajoute rien
         à ce que dit déjà le titre. D49. --}}
    <section class="bg-waves">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-14 sm:px-6 md:grid-cols-2">
            <div>
                <h1 class="page-title text-white">Réservez une consultation dans un des cabinets certifiés Cleartrack® partout au Maroc</h1>
                <p class="mt-4 text-white/90">Comment deviendra mon sourire après l’alignement des dents&nbsp;? Combien de temps faut-il pour aligner mes dents&nbsp;? Les aligneurs conviennent-ils à mon cas&nbsp;? Remplissez le formulaire ci-dessous afin que nous puissions réserver une consultation dentaire gratuite pour répondre à toutes vos questions.</p>
            </div>
            <div class="flex justify-center md:justify-end">
                @if (config('cleartrack.animations'))
                    <picture>
                        <source srcset="{{ asset('assets/rdv/alignement-fixe.png') }}" media="(prefers-reduced-motion: reduce)">
                        <img src="{{ asset('assets/rdv/alignement.gif') }}" alt="" aria-hidden="true"
                             width="750" height="509" class="h-auto w-full max-w-md rounded-2xl">
                    </picture>
                @else
                    <img src="{{ asset('assets/rdv/alignement-fixe.png') }}" alt="" aria-hidden="true"
                         width="750" height="509" class="h-auto w-full max-w-md rounded-2xl">
                @endif
            </div>
        </div>
    </section>

    {{-- Bloc blanc à vagues : les « 2 visites » et le formulaire sont visuellement
         continus (pt-14 puis py-14, sans césure). Un seul fond les couvre donc tous
         les deux — deux .bg-waves-light accolés cadreraient chacun une portion
         différente du motif et la cassure se verrait à la jointure. --}}
    <div class="bg-waves-light">
    {{-- 2 visites (PPT slide 70) --}}
    <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6">
        <div class="card">
            <h2 class="text-xl font-bold text-ppt-blue">L’obtention de vos aligneurs Cleartrack® ne nécessite que deux visites chez l’un de nos médecins dentistes certifiés&nbsp;:</h2>
            <div class="mt-5 grid gap-6 md:grid-cols-2">
                <div class="flex gap-4">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-brand-500 font-bold text-white">1</span>
                    <p class="text-sm leading-relaxed"><strong>Rendez-vous 1&nbsp;:</strong> votre médecin dentiste prendra une copie de vos dents (scan ou empreintes) et des photos de votre occlusion.</p>
                </div>
                <div class="flex gap-4">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-brand-500 font-bold text-white">2</span>
                    <p class="text-sm leading-relaxed"><strong>Rendez-vous 2&nbsp;:</strong> vos aligneurs Cleartrack® seront placés par votre dentiste en une seule visite.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Formulaire (PPT slides 71-72) --}}
    <section class="mx-auto max-w-4xl px-4 py-14 sm:px-6">
        <x-avis-apercu />
        @if (session('succes'))
            <div class="mb-8 rounded-2xl border-2 border-green-500 bg-green-50 p-6 text-center" role="status">
                <p class="text-lg font-bold text-green-700">Votre demande a bien été envoyée&nbsp;!</p>
                <p class="mt-1 text-sm text-green-700">Notre équipe vous contactera très prochainement pour réserver votre consultation gratuite.</p>
            </div>
        @endif

        <h2 class="section-title">Envoyez-nous vos informations et vos photos</h2>
        <p class="section-subtitle">Afin de vérifier si vous êtes éligible pour les aligneurs Cleartrack®.</p>

        <form method="POST" action="{{ route('rdv.store') }}" enctype="multipart/form-data" class="mt-8 space-y-6" novalidate>
            @csrf
            {{-- Pot de miel anti-spam (invisible) --}}
            <div class="hidden" aria-hidden="true">
                <label>Ne pas remplir <input type="text" name="site_web" tabindex="-1" autocomplete="off"></label>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="nom_complet" class="text-sm font-medium text-slate-700">Nom complet <span class="text-red-500">*</span></label>
                    <input type="text" id="nom_complet" name="nom_complet" value="{{ old('nom_complet') }}" required
                           class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('nom_complet')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="date_naissance" class="text-sm font-medium text-slate-700">Date de naissance <span class="text-red-500">*</span></label>
                    <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required
                           class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('date_naissance')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="adresse" class="text-sm font-medium text-slate-700">Adresse <span class="text-red-500">*</span></label>
                    <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" required
                           class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('adresse')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="telephone" class="text-sm font-medium text-slate-700">Numéro de téléphone <span class="text-red-500">*</span></label>
                    <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" required
                           class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('telephone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="text-sm font-medium text-slate-700">E-mail <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">
                    @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="message" class="text-sm font-medium text-slate-700">Message supplémentaire</label>
                    <textarea id="message" name="message" rows="4"
                              class="mt-2 w-full rounded-xl border border-brand-300 px-4 py-2.5 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200">{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Retour client : « add the stars in the reservation upload documents ».
                 Les six photos portent désormais l'astérisque rouge des champs
                 obligatoires ET sont réellement exigées à l'envoi : une étoile qui
                 n'engage rien induirait le patient en erreur.
                 Écart assumé avec le PPT, qui écrit « Photos (facultatif) » sur la
                 diapo 72 — le client a explicitement demandé le changement. D50. --}}
            <fieldset>
                <legend class="text-lg font-bold text-ppt-blue">Photos <span class="text-red-500">*</span></legend>
                <p class="mt-1 text-sm text-slate-500">Elles nous permettent de pré-évaluer votre cas avant la consultation&nbsp;: les six sont nécessaires. Le lien «&nbsp;voir exemple&nbsp;» montre le cadrage attendu.</p>
                <div class="mt-5 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($typesPhotos as $type => $label)
                        <x-photo-drop :name="'photo_' . $type" :label="$label" required />
                    @endforeach
                </div>
            </fieldset>

            <p class="text-xs leading-relaxed text-slate-500">Toutes les données personnelles récoltées resteront préservées à des fins de traitement uniquement et conformément aux règles énoncées dans notre <a href="{{ route('confidentialite') }}" class="text-ppt-blue underline">page de politique de confidentialité</a> que vous pouvez consulter.</p>

            <button type="submit" class="btn-brand px-10 disabled:cursor-not-allowed disabled:opacity-50"
                    @disabled(config('cleartrack.demo'))>Envoyer</button>
        </form>
    </section>
    </div>

    {{-- Annuaire des cabinets par ville (PPT slides 73-74) --}}
    <section class="bg-waves" aria-labelledby="annuaire-titre">
        <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6">
            <h2 id="annuaire-titre" class="text-2xl font-bold text-white md:text-3xl">Ou contactez directement un de nos cabinets certifiés Cleartrack®</h2>
            <div class="mt-8 space-y-3">
                @foreach ($villes as $ville)
                    <div class="accordion-row rounded-xl" x-data="{ ouvert: false }">
                        <h3>
                            <button type="button" @click="ouvert = !ouvert" :aria-expanded="ouvert"
                                    class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left font-semibold text-ppt-blue hover:bg-brand-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500">
                                <span>{{ $ville->nom }}</span>
                                <span class="text-xl font-bold text-ppt-blue" aria-hidden="true" x-text="ouvert ? '−' : '+'">+</span>
                            </button>
                        </h3>
                        <div x-show="ouvert" x-collapse.duration.300ms x-cloak class="px-5 pb-5">
                            @forelse ($ville->cabinets as $cabinet)
                                <div class="mt-2 rounded-lg bg-brand-50 p-4 text-sm">
                                    <p class="font-bold text-ppt-blue">{{ $cabinet->medecin }}</p>
                                    @if ($cabinet->telephone)<p class="mt-1">Tél&nbsp;: <a href="tel:{{ preg_replace('/\s+/', '', $cabinet->telephone) }}" class="text-ppt-blue underline">{{ $cabinet->telephone }}</a></p>@endif
                                    @if ($cabinet->adresse)<p class="mt-1 text-slate-600">{{ $cabinet->adresse }}</p>@endif
                                </div>
                            @empty
                                <p class="mt-2 text-sm text-slate-500">Cabinets certifiés bientôt référencés dans cette ville — contactez-nous au <a href="tel:+212693133170" class="text-ppt-blue underline">+212 693 133 170</a>.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
