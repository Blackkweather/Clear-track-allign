@extends('layouts.app')

@section('title', 'Aligner Care Instructions — ClearTrack® align')
@section('meta_description', 'Inserting, removing, wearing and caring for your ClearTrack® clear aligners, plus food, drinks and hygiene guidance.')

@section('content')
    {{-- Page fournie mot pour mot par le client (annotations du 11/08/2026).
         Le contenu est en ANGLAIS, contrairement au reste du site qui est en
         français : c'est la demande explicite, les textes sont repris tels quels
         sans traduction ni reformulation.

         À noter : cette page recoupe largement /instructions (4 onglets en
         français). Les deux coexistent pour l'instant — voir CONTENT-DECISIONS D29. --}}
    @php
        $sections = [
            [
                'cle' => 'inserting',
                'onglet' => 'Inserting Your Clear Aligners:',
                'titre' => 'Inserting Your Clear Aligners:',
                'image' => 'assets/aligneur-doigts.png',
                'alt' => 'Placing a ClearTrack aligner with the fingers',
                'points' => [
                    'Use your fingers to put your aligners place.',
                    'Be careful not use your teeth to bite your aligners into place.',
                    'First place the aligners over your front teeth, and then use your fingers to push the aligner down gently over your molars FRONT TO BACK.',
                    'Start wearing each new set of aligners at night (do not take them out for the first 8 – 12 hours).',
                    'When the aligners are correctly inserted, they will fit all the way down on the teeth, with no space between the top of the aligners and the top of the teeth.',
                    'Aligners will fit tightly at first but should fit well at the end of the period.',
                    'You can also use a "chewie" to seat an aligner that doesn’t seat completely at first.',
                ],
            ],
            [
                'cle' => 'removing',
                'onglet' => 'Removing Your Aligners:',
                'titre' => 'Removing Your Aligners:',
                'image' => 'assets/aligneur-serre.png',
                'alt' => 'Removing a ClearTrack aligner',
                'points' => [
                    'Keep your aligners in except when flossing, brushing, and eating.',
                    'It’s also best to remove the aligners when drinking warm beverages such as coffee or tea.',
                    'Remove the aligner by pulling it off both sides of your back teeth simultaneously then lifting it off of your front teeth. BACK TO FRONT.',
                    'Place your aligners in the case we provided any time they are not being worn.',
                ],
            ],
            [
                'cle' => 'wearing',
                'onglet' => 'Wearing Your Aligners:',
                'titre' => 'Wearing Your Aligners:',
                'image' => 'assets/pourquoi/aligneur-3d.png',
                'alt' => 'ClearTrack aligner in place on the teeth',
                'points' => [
                    'Wear aligners in the correct numerical order (Each aligner bag is labeled).',
                    'Your dentist or orthodontist will tell you when to switch each set of aligners based on evaluation of the weekly scans you’re taking with Dental Monitoring®.',
                    'It is important to avoid leaving aligners out of the mouth for longer than 30 minutes especially during the first 3 days of each new aligner',
                    'Keep all of your old aligners and bring them to your orthodontic appointments.',
                    'If you lose an aligner, notify the dental practice immediately. They will advise you whether to jump ahead to the next aligner.',
                    'If travelling always bring 2 extra aligners with you, just in case.',
                ],
            ],
            [
                'cle' => 'caring',
                'onglet' => 'Caring For Your Aligners',
                'titre' => 'Caring for your Aligners:',
                'image' => 'assets/photo-aligneur-main-detoure.png',
                'alt' => 'Handling a ClearTrack aligner with clean hands',
                'points' => [
                    'Wash your hands with soap and water before handling your aligners.',
                    'Remove your aligners when removing them from the packaging.',
                    'Don’t place your aligners on a napkin or tissue. Many aligners have accidentally been thrown out this way.',
                    'If you smoke, do not to smoke with the aligners in your mouth. The smoke can stain the aligners as well as your teeth.',
                    'If you have attachments, request your orthodontist apply the correct amount of composite, otherwise you may have trouble removing your aligners.',
                    'If you have pets, don’t place your aligners anywhere that your pets can reach them.',
                ],
            ],
            [
                'cle' => 'food',
                'onglet' => 'Food And Drinks',
                'titre' => 'Food and Drinks:',
                'image' => 'assets/pourquoi/icone-alimentation.png',
                'alt' => 'Eating and drinking with ClearTrack aligners',
                'points' => [
                    'Always store your aligners in the case provided when eating or brushing.',
                    'Don’t chew gum with your aligners in.',
                    'Aligners should be removed to eat anything.',
                    'Aligners should be removed for drinking anything except cool water.',
                ],
            ],
            [
                'cle' => 'hygiene',
                'onglet' => 'Hygiene:',
                'titre' => 'Hygiene:',
                'image' => 'assets/pourquoi/icone-confort.png',
                'alt' => 'Cleaning ClearTrack aligners',
                'points' => [
                    'Clean aligners with a non-abrasive toothpaste and soft bristle brush.',
                    'Do not use Denture cleaner, alcohol, or bleach to clean your aligners.',
                    'Do not use boiling water or warm water on your aligners.',
                ],
            ],
        ];
    @endphp

    <section class="bg-waves-light" x-data="{ onglet: '{{ $sections[0]['cle'] }}' }">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <h1 class="text-center text-3xl font-extrabold text-brand-800 md:text-5xl">Aligner Care Instructions</h1>

            {{-- Barre d'onglets : défilement horizontal sur mobile plutôt qu'un
                 empilement, pour rester lisible sans occuper tout l'écran. --}}
            <div class="mt-10 -mx-4 overflow-x-auto px-4 pb-2 sm:mx-0 sm:px-0">
                <div class="flex min-w-max gap-2 sm:flex-wrap sm:justify-center sm:min-w-0"
                     role="tablist" aria-label="Aligner care topics">
                    @foreach ($sections as $s)
                        <button type="button" role="tab"
                                id="tab-{{ $s['cle'] }}"
                                aria-controls="panel-{{ $s['cle'] }}"
                                @click="onglet = '{{ $s['cle'] }}'"
                                :aria-selected="onglet === '{{ $s['cle'] }}' ? 'true' : 'false'"
                                :class="onglet === '{{ $s['cle'] }}'
                                    ? 'bg-brand-600 text-white shadow'
                                    : 'bg-brand-50 text-brand-900 hover:bg-brand-100'"
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
                            <h2 class="text-2xl font-bold text-brand-600 md:text-3xl">{{ $s['titre'] }}</h2>
                            <ul class="mt-6 space-y-3">
                                @foreach ($s['points'] as $point)
                                    <li class="flex gap-3 leading-relaxed">
                                        <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-brand-500" aria-hidden="true"></span>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
