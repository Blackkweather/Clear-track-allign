@extends('layouts.app')

@section('title', 'Instructions d’utilisation — ClearTrack® align')
@section('meta_description', 'Comment mettre en place, retirer, ranger et entretenir vos aligneurs Cleartrack® align, et que manger ou boire pendant le traitement.')

@section('content')
    {{-- Page RÉTABLIE à la demande du client : « get back to the french
         instruction and get them back to where they was, french, but with the
         english model but with french ».

         Elle avait été retirée avec la page anglaise « Aligner Care Instructions »
         (D52). Le client la veut de nouveau, au même endroit (/instructions, dans
         la nav et le pied de page) et dans son contenu FRANÇAIS d'origine — mais
         présentée comme la page anglaise l'était : une barre d'onglets, puis un
         panneau à deux colonnes (illustration à gauche, titre et liste à droite).

         Le texte est donc celui de la version française d'avant suppression,
         repris mot pour mot ; seule la mise en page change. La page anglaise,
         elle, reste supprimée. D58. --}}
    @php
        $sections = [
            [
                'cle' => 'mise-en-place',
                'titre' => 'Mettre en place vos aligneurs',
                'onglet' => 'Mettre en place',
                'image' => 'assets/aligneur-doigts.webp',
                'alt' => 'Mise en place d’un aligneur Cleartrack avec les doigts',
                'intro' => 'Il est important d’insérer vos aligneurs correctement : un aligneur mal posé ne déplace pas les dents comme prévu.',
                'points' => [
                    'Insérez d’abord l’aligneur sur les dents de devant, puis poussez-le doucement vers le bas (ou vers le haut) sur les dents du fond.',
                    'Vous pouvez aussi procéder de l’arrière vers l’avant, ou d’un côté à l’autre : commencez par un côté, avancez vers les dents antérieures, puis appuyez sur l’autre côté.',
                    'Appuyez uniquement avec les doigts. Ne mordez jamais l’aligneur pour le mettre en place : vous risquez de le déformer ou de le fissurer.',
                    'Utilisez les «&nbsp;chewies&nbsp;», ce petit cylindre de matériau souple fourni dans la boîte : quelques secondes de mordillage aident l’aligneur à bien s’asseoir sur chaque dent, surtout au passage à une nouvelle étape.',
                    'Rincez toujours vos aligneurs à l’eau froide avant de les remettre en bouche.',
                ],
            ],
            [
                'cle' => 'retrait',
                'titre' => 'Retirer vos aligneurs',
                'onglet' => 'Retirer',
                'image' => 'assets/aligneur-serre.webp',
                'alt' => 'Retrait d’un aligneur Cleartrack',
                'intro' => 'Retirez vos aligneurs pour manger, pour boire autre chose que de l’eau froide, et pour vous brosser les dents.',
                'points' => [
                    'Commencez par décoller l’aligneur au niveau des molaires, d’un côté puis de l’autre, avant de le dégager vers l’avant.',
                    'Ne tirez pas d’un coup sec sur les dents de devant : c’est le meilleur moyen de déformer l’aligneur.',
                    'Vos aligneurs semblent «&nbsp;collés&nbsp;»&nbsp;? La viscosité de la salive crée parfois un joint avec les dents. Faites circuler vigoureusement de l’eau dans votre bouche en vous aidant des joues pour briser ce joint.',
                    'Si vous n’arrivez toujours pas à les retirer, contactez votre dentiste dès que possible — n’insistez pas avec un objet.',
                    'Dès qu’ils sont retirés, rangez-les immédiatement dans leur étui (voir l’onglet «&nbsp;Rangement et entretien&nbsp;»).',
                ],
            ],
            [
                'cle' => 'rangement',
                'titre' => 'Rangement et entretien',
                'onglet' => 'Rangement et entretien',
                'image' => 'assets/photo-aligneur-main-detoure.webp',
                'alt' => 'Manipulation d’un aligneur Cleartrack avec les mains propres',
                'intro' => 'Le nettoyage des gouttières est essentiel pour garder une bonne hygiène buccale — et des aligneurs qui restent transparents.',
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
                'onglet' => 'Manger et boire',
                'image' => 'assets/pourquoi/icone-alimentation.png',
                'alt' => 'Manger et boire avec des aligneurs Cleartrack',
                'intro' => 'Contrairement aux appareils dentaires classiques, aucun aliment ne vous est interdit : il suffit de retirer vos aligneurs pour manger.',
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

    {{-- En-tête — BLEU --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="page-title max-w-3xl text-white">Instructions d’utilisation</h1>
            <p class="texte-ppt mt-4 max-w-2xl text-white/90">Tout ce qu’il faut savoir pour porter vos aligneurs Cleartrack® correctement, jour après jour. En cas de doute, votre dentiste traitant reste votre premier interlocuteur.</p>
        </div>
    </section>

    <section class="bg-waves-light" aria-labelledby="instructions-titre">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6"
             x-data="{ onglet: '{{ $sections[0]['cle'] }}' }">
            <h2 id="instructions-titre" class="section-title text-center">Comment porter vos aligneurs</h2>
            <p class="section-subtitle mx-auto max-w-2xl text-center">Portez vos aligneurs 22&nbsp;heures par jour et ne les retirez que pour manger, boire et vous brosser les dents.</p>

            {{-- Barre d'onglets : défilement horizontal sur mobile plutôt qu'un
                 empilement, pour rester lisible sans occuper tout l'écran. --}}
            <div class="mt-10 -mx-4 overflow-x-auto px-4 pb-2 sm:mx-0 sm:px-0">
                <div class="flex min-w-max gap-2 sm:min-w-0 sm:flex-wrap sm:justify-center"
                     role="tablist" aria-label="Instructions d’utilisation">
                    @foreach ($sections as $s)
                        <button type="button" role="tab"
                                id="tab-{{ $s['cle'] }}"
                                aria-controls="panel-{{ $s['cle'] }}"
                                @click="onglet = '{{ $s['cle'] }}'"
                                :aria-selected="onglet === '{{ $s['cle'] }}' ? 'true' : 'false'"
                                :class="onglet === '{{ $s['cle'] }}'
                                    ? 'bg-brand-600 text-white shadow'
                                    : 'bg-brand-50 text-ppt-blue hover:bg-brand-100'"
                                class="rounded-xl px-5 py-3 text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 md:text-base">
                            {{ $s['onglet'] }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Panneaux. x-cloak seulement à partir du 2e : la règle CSS
                 [x-cloak]{display:none} s'applique aussi sans JavaScript, donc la
                 poser partout viderait la page si Alpine ne démarre pas. --}}
            <div class="mt-10 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-brand-100 md:p-10">
                @foreach ($sections as $s)
                    <div id="panel-{{ $s['cle'] }}" role="tabpanel"
                         aria-labelledby="tab-{{ $s['cle'] }}"
                         x-show="onglet === '{{ $s['cle'] }}'" @if (! $loop->first) x-cloak @endif
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="grid items-center gap-10 md:grid-cols-2">
                        <div class="flex justify-center">
                            <img src="{{ asset($s['image']) }}" alt="{{ $s['alt'] }}"
                                 class="w-full max-w-sm object-contain" loading="lazy">
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-ppt-blue md:text-3xl">{{ $s['titre'] }}</h3>
                            <p class="mt-4 leading-relaxed text-slate-600">{!! $s['intro'] !!}</p>
                            <ul class="mt-6 space-y-3">
                                @foreach ($s['points'] as $point)
                                    <li class="flex gap-3 leading-relaxed">
                                        <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-brand-500" aria-hidden="true"></span>
                                        <span>{!! $point !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('rdv') }}" class="btn-brand btn-grand">Prendre rendez-vous</a>
            </div>
        </div>
    </section>
@endsection
