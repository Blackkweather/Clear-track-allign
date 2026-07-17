{{-- Zone d'upload photo en glisser-déposer (PPT slide 72 : « Glissez la photo ici ou parcourir ») --}}
@props(['name', 'label'])
<div x-data="{ fichier: null, survol: false }" class="flex flex-col">
    <span class="text-sm font-medium text-slate-700">{{ $label }} <a href="#" class="text-xs text-brand-500 underline" title="Exemple bientôt disponible" tabindex="-1">voir exemple</a></span>
    <label
        @dragover.prevent="survol = true" @dragleave.prevent="survol = false"
        @drop.prevent="survol = false; const f = $event.dataTransfer.files[0]; if (f) { $refs.input.files = $event.dataTransfer.files; fichier = f.name; }"
        :class="survol ? 'border-brand-500 bg-brand-50' : 'border-brand-300 bg-white'"
        class="mt-2 flex h-24 cursor-pointer items-center justify-center rounded-xl border-2 border-dashed px-3 text-center text-xs text-slate-500 transition hover:bg-brand-50">
        <input type="file" name="{{ $name }}" accept="image/jpeg,image/png" class="sr-only" x-ref="input"
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
</div>
