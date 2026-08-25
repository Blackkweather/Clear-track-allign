{{-- Façade vidéo cliquable : charge la vidéo seulement au clic (performance) --}}
@props(['src', 'poster', 'label' => 'Lancer la vidéo'])
<div x-data="{ joue: false }" class="relative overflow-hidden rounded-2xl shadow-xl">
    <template x-if="!joue">
        <button type="button" @click="joue = true" class="group relative block w-full" :aria-label="'{{ $label }}'">
            <img src="{{ asset($poster) }}" alt="" class="w-full object-cover" loading="lazy">
            <span class="absolute inset-0 flex items-center justify-center bg-black/20 transition group-hover:bg-black/30">
                <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 shadow-lg transition group-hover:scale-110">
                    <svg class="ml-1 h-7 w-7 text-ppt-blue" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                </span>
            </span>
        </button>
    </template>
    <template x-if="joue">
        <video :src="joue ? '{{ asset($src) }}' : ''" controls autoplay playsinline class="w-full" preload="none">
            Votre navigateur ne prend pas en charge la lecture vidéo.
        </video>
    </template>
</div>
