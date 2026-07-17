{{--
    Carrousel générique accessible (référence : flèches rondes + points, PPT slides 9-10, 14-15).
    Utilisation : <x-carousel :items="$collection" :per-view="['base' => 1, 'md' => 3]">
        @foreach ($items as $item) ... @endforeach   (chaque enfant direct = une diapo)
    </x-carousel>
--}}
@props(['label' => 'Carrousel', 'perViewMd' => 3])
<div
    x-data="{
        index: 0,
        total: {{ substr_count((string) $slot, 'data-carousel-slide') }},
        perView: window.matchMedia('(min-width: 768px)').matches ? {{ $perViewMd }} : 1,
        get maxIndex() { return Math.max(0, this.total - this.perView); },
        next() { this.index = Math.min(this.index + 1, this.maxIndex); },
        prev() { this.index = Math.max(this.index - 1, 0); },
        goTo(i) { this.index = Math.min(i, this.maxIndex); },
        updatePerView() {
            this.perView = window.matchMedia('(min-width: 768px)').matches ? {{ $perViewMd }} : 1;
            this.index = Math.min(this.index, this.maxIndex);
        },
    }"
    x-init="updatePerView(); window.addEventListener('resize', () => updatePerView())"
    role="region" aria-label="{{ $label }}" aria-roledescription="carrousel"
    class="relative">

    <div class="overflow-hidden">
        <div class="flex transition-transform duration-500 ease-out"
             :style="`transform: translateX(-${index * (100 / perView)}%)`">
            {{ $slot }}
        </div>
    </div>

    {{-- Flèches --}}
    <button type="button" @click="prev()" x-show="index > 0" x-cloak
            class="absolute -left-4 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white text-brand-500 shadow-lg transition hover:bg-brand-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 sm:-left-5"
            aria-label="Diapositive précédente">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" @click="next()" x-show="index < maxIndex" x-cloak
            class="absolute -right-4 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white text-brand-500 shadow-lg transition hover:bg-brand-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 sm:-right-5"
            aria-label="Diapositive suivante">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- Points --}}
    <div class="mt-6 flex justify-center gap-2" x-show="maxIndex > 0" x-cloak>
        <template x-for="i in maxIndex + 1" :key="i">
            <button type="button" @click="goTo(i - 1)"
                    class="h-2.5 rounded-full transition-all"
                    :class="index === i - 1 ? 'w-6 bg-brand-500' : 'w-2.5 bg-brand-200 hover:bg-brand-300'"
                    :aria-label="`Aller à la diapositive ${i}`" :aria-current="index === i - 1"></button>
        </template>
    </div>
</div>
