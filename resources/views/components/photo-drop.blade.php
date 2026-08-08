{{-- Zone d'upload photo en glisser-déposer (PPT slide 72 : « Glissez la photo ici ou parcourir ») --}}
@props(['name', 'label', 'type' => null, 'accept' => 'image/jpeg,image/png'])

@php
    // Le type de photo permet d'afficher le schéma de cadrage ; à défaut, on le déduit du nom du champ.
    $typeGuide = $type ?? \Illuminate\Support\Str::after($name, '_');
    $guide = \App\Support\GuidesPhotos::pour($typeGuide);
@endphp

<div x-data="{ fichier: null, survol: false, exemple: false }" class="flex flex-col">
    <span class="text-sm font-medium text-slate-700">
        {{ $label }}
        @if ($guide)
            <button type="button" @click="exemple = true"
                    class="text-xs text-brand-500 underline hover:text-brand-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500">voir exemple</button>
        @endif
    </span>
    <label
        @dragover.prevent="survol = true" @dragleave.prevent="survol = false"
        @drop.prevent="survol = false; const f = $event.dataTransfer.files[0]; if (f) { $refs.input.files = $event.dataTransfer.files; fichier = f.name; }"
        :class="survol ? 'border-brand-500 bg-brand-50' : 'border-brand-300 bg-white'"
        class="mt-2 flex h-24 cursor-pointer items-center justify-center rounded-xl border-2 border-dashed px-3 text-center text-xs text-slate-500 transition hover:bg-brand-50">
        <input type="file" name="{{ $name }}" accept="{{ $accept }}" class="sr-only" x-ref="input"
               @change="fichier = $event.target.files[0]?.name ?? null">
        <span x-show="!fichier">Glissez la photo ici ou <span class="font-semibold text-brand-600 underline">parcourir</span></span>
        <span x-show="fichier" x-cloak class="flex items-center gap-2 font-medium text-brand-700">
            <svg class="h-4 w-4 shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
            <span x-text="fichier" class="truncate"></span>
        </span>
    </label>
    @error(str_replace('[', '.', rtrim($name, ']')))
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror

    @if ($guide)
        {{-- Exemple de cadrage : schéma neutre + consignes de prise de vue (aucune photo de patient) --}}
        <div x-show="exemple" x-cloak @keydown.escape.window="exemple = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4"
             role="dialog" aria-modal="true" aria-labelledby="exemple-titre-{{ $name }}">
            <div @click.outside="exemple = false" x-transition.opacity
                 class="max-h-full w-full max-w-lg overflow-y-auto rounded-2xl bg-white p-6 shadow-xl">
                <div class="flex items-start justify-between gap-4">
                    <h3 id="exemple-titre-{{ $name }}" class="text-lg font-bold text-brand-700">{{ $guide['titre'] }}</h3>
                    <button type="button" @click="exemple = false" aria-label="Fermer"
                            class="shrink-0 rounded-full p-1 text-2xl leading-none text-slate-400 hover:bg-slate-100 hover:text-slate-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500">&times;</button>
                </div>
                <div class="mt-4 flex flex-col items-center gap-5 sm:flex-row sm:items-start">
                    <x-photo-schema :type="$typeGuide" />
                    <ul class="space-y-2 text-sm leading-relaxed text-slate-600">
                        @foreach ($guide['consignes'] as $consigne)
                            <li class="flex gap-2">
                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-brand-500" aria-hidden="true"></span>
                                <span>{{ $consigne }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <p class="mt-5 border-t border-slate-100 pt-4 text-xs text-slate-500">
                    Schéma de cadrage indicatif. Photographiez en lumière naturelle ou avec le flash du cabinet, sans flou&nbsp;; les fichiers restent strictement confidentiels.
                </p>
            </div>
        </div>
    @endif
</div>
