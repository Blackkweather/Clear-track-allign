@extends('layouts.app')

@section('title', 'Instructions d’utilisation — ClearTrack® align')
@section('meta_description', 'Comment mettre en place, retirer, ranger et entretenir vos aligneurs Cleartrack® align, et que manger ou boire pendant le traitement.')

@section('content')
    {{-- En-tête — BLEU --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="page-title max-w-3xl text-white">Instructions d’utilisation</h1>
            <p class="texte-ppt mt-4 max-w-2xl text-white/90">Tout ce qu’il faut savoir pour porter vos aligneurs Cleartrack® correctement, jour après jour. En cas de doute, votre dentiste traitant reste votre premier interlocuteur.</p>
        </div>
    </section>

    {{-- Onglets « signets » — BLANC --}}
    @php
        $onglets = [
            [
                'cle' => 'mise-en-place',
                'titre' => 'Mettre en place',
                'intro' => 'Il est important d’insérer vos aligneurs correctement : un aligneur mal posé ne déplace pas les dents comme prévu.',
                'icone' => 'M12 4v16m8-8H4',
                'points' => [
                    'Insérez d’abord l’aligneur sur les dents de devant, puis poussez-le doucement vers le bas (ou vers le haut) sur les dents du fond.',
                    'Vous pouvez aussi procéder de l’arrière vers l’avant, ou d’un côté à l’autre : commencez par un côté, avancez vers les dents antérieures, puis appuyez sur l’autre côté.',
                    'Appuyez uniquement avec les doigts. Ne mordez jamais l’aligneur pour le mettre en place : vous risquez de le déformer ou de le fissurer.',
                    'Utilisez les « chewies », ce petit cylindre de matériau souple fourni dans la boîte : quelques secondes de mordillage aident l’aligneur à bien s’asseoir sur chaque dent, surtout au passage à une nouvelle étape.',
                    'Rincez toujours vos aligneurs à l’eau froide avant de les remettre en bouche.',
                ],
            ],
            [
                'cle' => 'retrait',
                'titre' => 'Retirer',
                'intro' => 'Retirez vos aligneurs pour manger, pour boire autre chose que de l’eau froide, et pour vous brosser les dents.',
                'icone' => 'M20 12H4',
                'points' => [
                    'Commencez par décoller l’aligneur au niveau des molaires, d’un côté puis de l’autre, avant de le dégager vers l’avant.',
                    'Ne tirez pas d’un coup sec sur les dents de devant : c’est le meilleur moyen de déformer l’aligneur.',
                    'Vos aligneurs semblent « collés » ? La viscosité de la salive crée parfois un joint avec les dents. Faites circuler vigoureusement de l’eau dans votre bouche en vous aidant des joues pour briser ce joint.',
                    'Si vous n’arrivez toujours pas à les retirer, contactez votre dentiste dès que possible — n’insistez pas avec un objet.',
                    'Dès qu’ils sont retirés, rangez-les immédiatement dans leur étui (voir l’onglet « Rangement »).',
                ],
            ],
            [
                'cle' => 'rangement',
                'titre' => 'Rangement et entretien',
                'intro' => 'Le nettoyage des gouttières est essentiel pour garder une bonne hygiène buccale — et des aligneurs qui restent transparents.',
                'icone' => 'M5 8h14l-1 12H6L5 8zm3 0V6a4 4 0 118 0v2',
                'points' => [
                    'Rangez toujours vos aligneurs dans l’étui fourni dès que vous les retirez. Jamais dans une serviette en papier : c’est ainsi qu’on les jette par mégarde.',
                    'Nettoyez-les matin et soir, en même temps que vos dents, avec une brosse à dents à poils souples, de l’eau froide et une petite quantité de savon doux.',
                    'N’utilisez pas de dentifrice : il est abrasif et rend les aligneurs troubles.',
                    'Évitez l’eau chaude, le lave-vaisselle et toute source de chaleur : le matériau se déforme et l’aligneur devient inefficace.',
                    'Brossez l’intérieur et l’extérieur, puis rincez à l’eau avant chaque remise en bouche. Correctement entretenus, vos aligneurs ne sentent pas.',
                ],
            ],
            [
                'cle' => 'alimentation',
                'titre' => 'Manger et boire',
                'intro' => 'Contrairement aux appareils dentaires classiques, aucun aliment ne vous est interdit : il suffit de retirer vos aligneurs pour manger.',
                'icone' => 'M4 3v18M4 8h4m0-5v18m8-18v7a3 3 0 003 3v8',
                'points' => [
                    'Retirez systématiquement vos aligneurs pour manger : aucune restriction alimentaire pendant le traitement.',
                    'Vous pouvez garder vos aligneurs pour boire de l’eau froide. Les boissons chaudes déforment le plastique.',
                    'Retirez-les aussi pour les boissons sucrées ou colorées : le liquide reste piégé contre l’émail et peut tacher l’aligneur.',
                    'Pas de chewing-gum avec les aligneurs : il colle au matériau. Retirez-les si vous souhaitez en mâcher.',
                    'Brossez-vous les dents après chaque repas avant de remettre vos aligneurs : sous la gouttière, la salive ne reminéralise plus l’émail comme d’habitude.',
                ],
            ],
        ];
    @endphp

    {{-- Fond blanc à vagues comme les autres sections claires du site (pas de bg-white nu) --}}
    <section class="bg-waves-light" aria-labelledby="instructions-titre">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6"
             x-data="{ onglet: '{{ $onglets[0]['cle'] }}' }">
            <h2 id="instructions-titre" class="section-title text-center">Comment porter vos aligneurs</h2>
            <p class="section-subtitle mx-auto max-w-2xl text-center">Portez vos aligneurs 22&nbsp;heures par jour et ne les retirez que pour manger, boire et vous brosser les dents.</p>

            <div class="mt-10 gap-8 lg:grid lg:grid-cols-[16rem_1fr]">
                {{-- Signets --}}
                <div class="flex gap-2 overflow-x-auto pb-2 lg:flex-col lg:overflow-visible lg:pb-0"
                     role="tablist" aria-label="Catégories d’instructions">
                    @foreach ($onglets as $o)
                        <button type="button" role="tab"
                                :id="'onglet-' + '{{ $o['cle'] }}'"
                                :aria-selected="onglet === '{{ $o['cle'] }}'"
                                :tabindex="onglet === '{{ $o['cle'] }}' ? 0 : -1"
                                aria-controls="panneau-{{ $o['cle'] }}"
                                @click="onglet = '{{ $o['cle'] }}'"
                                @keydown.right.prevent="$el.nextElementSibling?.focus(); $el.nextElementSibling?.click()"
                                @keydown.left.prevent="$el.previousElementSibling?.focus(); $el.previousElementSibling?.click()"
                                :class="onglet === '{{ $o['cle'] }}'
                                    ? 'bg-brand-500 text-white shadow-md'
                                    : 'bg-brand-50 text-brand-700 hover:bg-brand-100'"
                                class="flex shrink-0 items-center gap-3 rounded-xl px-5 py-3.5 text-left text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 lg:w-full">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $o['icone'] }}"/>
                            </svg>
                            {{ $o['titre'] }}
                        </button>
                    @endforeach
                </div>

                {{-- Panneaux --}}
                <div class="mt-6 lg:mt-0">
                    @foreach ($onglets as $o)
                        <div id="panneau-{{ $o['cle'] }}" role="tabpanel"
                             :aria-labelledby="'onglet-' + '{{ $o['cle'] }}'"
                             {{-- x-cloak seulement à partir du 2e panneau : la règle CSS
                                  [x-cloak]{display:none} s'applique aussi sans JavaScript,
                                  donc la poser partout viderait la page si Alpine ne
                                  démarre pas. --}}
                             x-show="onglet === '{{ $o['cle'] }}'" @if (! $loop->first) x-cloak @endif
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             tabindex="0"
                             class="card border border-brand-100 !p-7 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500">
                            <h3 class="text-xl font-bold text-brand-600">{{ $o['titre'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $o['intro'] }}</p>
                            <ul class="mt-6 space-y-4">
                                @foreach ($o['points'] as $point)
                                    <li class="flex gap-3 text-sm leading-relaxed">
                                        <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-brand-500" aria-hidden="true"></span>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Rappel + CTA — BLEU --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-4xl px-4 py-14 text-center text-white sm:px-6">
            <h2 class="text-2xl font-bold md:text-3xl">22 heures par jour, chaque jour</h2>
            <p class="mx-auto mt-4 max-w-2xl text-white/90">Passez au jeu suivant après 1 à 2&nbsp;semaines, ou selon les instructions de votre dentiste. Un rappel programmé sur votre téléphone, ou la date de changement notée sur chaque sachet, aide à ne pas se tromper d’étape.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('faq') }}" class="btn-white">Questions fréquentes</a>
                <a href="https://wa.me/212693133170" target="_blank" rel="noopener" class="btn-outline-white">Parler à un représentant</a>
            </div>
        </div>
    </section>
@endsection
