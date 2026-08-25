{{-- Ligne d'accordéon ± (design PPT slides 36-38) --}}
@props(['question', 'reponse'])
<div class="accordion-row rounded-xl" x-data="{ ouvert: false }">
    <h3>
        <button type="button" @click="ouvert = !ouvert" :aria-expanded="ouvert"
                class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left font-semibold text-ppt-blue hover:bg-brand-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500">
            <span>{{ $question }}</span>
            <span class="text-xl font-bold text-ppt-blue" aria-hidden="true" x-text="ouvert ? '−' : '+'">+</span>
        </button>
    </h3>
    <div x-show="ouvert" x-collapse.duration.300ms x-cloak class="px-5 pb-5 text-sm leading-relaxed text-slate-600">
        {{-- Les réponses saisies sur plusieurs lignes (admin ou seed) deviennent autant de paragraphes --}}
        @foreach (preg_split('/\R+/', trim($reponse)) as $paragraphe)
            <p @class(['mt-3' => ! $loop->first])>{{ $paragraphe }}</p>
        @endforeach
    </div>
</div>
