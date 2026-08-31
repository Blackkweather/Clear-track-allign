{{-- Façade vidéo cliquable : charge la vidéo seulement au clic (performance) --}}
@props(['src', 'poster', 'label' => 'Lancer la vidéo'])

{{-- `aspect-video` réserve la place du 16/9 AVANT que quoi que ce soit n'arrive.
     Sans elle, la boîte mesurait 0 px de haut tant que l'affiche n'était pas
     téléchargée : une `<img loading="lazy">` sans dimensions déclarées n'a
     aucune hauteur intrinsèque avant son chargement. Sur téléphone — réseau
     plus lent, défilement plus rapide — la section « Regardez comment ça
     marche » s'affichait donc vide, titre seul : le client a cru la vidéo
     retirée. Mesuré en émulation mobile (390 px) avant correction : section
     168 px de haut, affiche 362 × 0 px ; après chargement, 362 × 203 px.
     L'affiche (800 × 450) et la vidéo (1920 × 1080) sont toutes deux en 16/9 :
     une fois chargées, la géométrie est identique au pixel près à l'ancienne,
     desktop compris. D86. --}}
<div x-data="{ joue: false }" class="relative aspect-video overflow-hidden rounded-2xl shadow-xl">
    {{-- L'affiche et son bouton sont du HTML réel, et non plus le contenu d'un
         `<template x-if>` : ils s'affichent dès le premier rendu, sans attendre
         qu'Alpine ait démarré (et même s'il ne démarre jamais). Alpine ne fait
         plus que les masquer au clic. D86. --}}
    <button type="button" x-show="!joue" @click="joue = true"
            class="group relative block h-full w-full" aria-label="{{ $label }}">
        {{-- width/height : les proportions de l'affiche, connues du navigateur
             avant même son téléchargement. --}}
        <img src="{{ asset($poster) }}" alt="" width="800" height="450"
             class="h-full w-full object-cover" loading="lazy">
        <span class="absolute inset-0 flex items-center justify-center bg-black/20 transition group-hover:bg-black/30">
            <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 shadow-lg transition group-hover:scale-110">
                <svg class="ml-1 h-7 w-7 text-ppt-blue" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
            </span>
        </span>
    </button>
    <template x-if="joue">
        <video :src="joue ? '{{ asset($src) }}' : ''" controls autoplay playsinline class="h-full w-full" preload="none">
            Votre navigateur ne prend pas en charge la lecture vidéo.
        </video>
    </template>
</div>
