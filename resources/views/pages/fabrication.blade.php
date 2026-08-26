@extends('layouts.app')

@section('title', 'Comment sont fabriqués les aligneurs — ClearTrack® align')
@section('meta_description', 'Imagerie 3D, planification du traitement, impression de modèles 3D, thermoformage à haute pression et contrôle qualité : la fabrication des aligneurs Cleartrack® align.')

@section('content')
    {{-- En-tête (PPT slide 52)
         Retour client : « the picture of "comment sont ils fabriqués" — the same
         picture ». La diapo 52 porte bien un visuel (ppt/media/image78.jpeg :
         les aligneurs thermoformés sur leurs modèles bleus), que le site avait
         laissé de côté — l'en-tête n'était qu'un bandeau de titre. Il est repris
         tel quel, à droite du titre comme sur la diapositive. D45. --}}
    {{-- Retour client : « this picture needs to be showing as a banner as in the
         ppt, stick one to another ». Sur la diapo 52 ce visuel n'est pas une
         vignette à droite du titre : il court d'un bord à l'autre (x = 0 % à
         100,52 %, y = 14,95 % à 69,75 %), et le titre vient EN DESSOUS, à
         gauche, avec le bouton à sa droite.

         Le fichier a donc été recadré comme le PPT le recadre lui-même
         (`srcRect t="27230" b="28948"`) : une bande horizontale prise au milieu
         de l'image, 3535 × 1084, ratio 3,26 — exactement celui du cadre de la
         diapositive, donc aucune déformation. Il est servi pleine largeur,
         collé au bandeau de titre. D57. --}}
    <section class="bg-waves">
        <img src="{{ asset('assets/fabrication/entete-aligneurs.jpg') }}"
             alt="Aligneurs Cleartrack® thermoformés sur leurs modèles imprimés en 3D"
             width="3535" height="1084"
             class="block h-auto w-full" fetchpriority="high">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 py-10 sm:px-6 md:flex-row md:items-center md:justify-between">
            <h1 class="page-title text-white">Comment les aligneurs Cleartrack® align sont fabriqués</h1>
            <a href="{{ route('rdv') }}" class="btn-white shrink-0">Démarrer mon traitement</a>
        </div>
    </section>

    {{-- Introduction (PPT slide 53) — fond blanc à vagues (section pleine largeur, grille centrée à l'intérieur) --}}
    <section class="bg-waves-light">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
        <div>
            <h2 class="section-title">Voyons d’abord ce que sont les aligneurs Cleartrack® align</h2>
            <p class="mt-4 leading-relaxed">Prescrits par votre dentiste, les aligneurs Cleartrack® align sont des gouttières transparentes qui ont été développées spécifiquement pour aligner vos dents de manière prévisible, douce, claire et confortable. Au lieu d’attaches métalliques, de fils ou de vis, vous porterez un matériau thermoplastique qui vous permettra d’obtenir les résultats souhaités, tout en passant inaperçu aux yeux de votre entourage.</p>
            <p class="mt-4 leading-relaxed">Les gouttières transparentes fonctionnent selon les principes orthodontiques de base. Elles sont utilisées pour corriger des dents de travers, des espaces ou des rotations, tout en obtenant les résultats souhaités de manière organisée et planifiée. Ces gouttières sur mesure sont «&nbsp;invisibles&nbsp;» et déplacent la dent dans la direction souhaitée. Pour ce faire, on porte une série de gouttières, chacune pendant 22 heures par jour, 1 à 2 semaines à la fois (une étape), qui déplacent les dents par étape jusqu’à ce que leur alignement optimal soit atteint.</p>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('assets/ppt/slide53.jpg') }}" alt="Aligneur transparent Cleartrack align" class="w-full max-w-md rounded-2xl shadow-xl" loading="lazy">
        </div>
        </div>
    </section>

    {{-- Étapes cliniques + laboratoire (PPT slide 54)
         Retours client : « doit avoir les mêmes emoticons de étapes clinique et
         étapes laboratoire — logo docteur et labo » et « instead of the checks
         put numbers ».
         Les deux pictogrammes sont ceux de la diapo 54 : le buste au stéthoscope
         au-dessus de « Étapes cliniques » (ppt/media/image48.svg) et le microscope
         au-dessus de « Étapes de laboratoire » (ppt/media/image90.svg). Les
         versions SVG sont préférées aux PNG 384 px de la même diapositive : même
         dessin, net à toute taille.
         Les coches sont remplacées par des numéros — chaque liste devient une
         suite d'étapes ordonnées, ce qu'elle est réellement ; <ol> plutôt que
         <ul>, pour que la numérotation soit aussi dans la structure. D46. --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <h2 class="text-center text-3xl font-bold text-white md:text-4xl">La fabrication des aligneurs comporte quelques étapes pour obtenir ce sourire magique&nbsp;!</h2>
            @php
                $groupesEtapes = [
                    [
                        'titre' => 'Étapes cliniques',
                        'icone' => 'etapes-cliniques.svg',
                        'etapes' => [
                            'Contrôle de la santé bucco-dentaire par le dentiste',
                            'Empreintes — numériques ou physiques',
                            'Images de contrôle de la qualité',
                            'Rayons X',
                        ],
                    ],
                    [
                        'titre' => 'Étapes de laboratoire',
                        'icone' => 'etapes-laboratoire.svg',
                        'etapes' => [
                            'Scans ou imagerie 3D',
                            'Planification du traitement en 3D',
                            'Impression de modèles 3D',
                            'Thermoformage à pression positive',
                            'Contrôle de qualité',
                        ],
                    ],
                ];
            @endphp
            <div class="mt-10 grid gap-6 md:grid-cols-2">
                @foreach ($groupesEtapes as $groupe)
                    <div class="card">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('assets/icons/' . $groupe['icone']) }}" alt="" aria-hidden="true"
                                 class="h-14 w-14 shrink-0 object-contain" loading="lazy">
                            <h3 class="text-lg font-bold text-ppt-blue">{{ $groupe['titre'] }}</h3>
                        </div>
                        <ol class="mt-5 space-y-3 text-sm">
                            @foreach ($groupe['etapes'] as $etape)
                                <li class="flex items-start gap-3">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-500 text-xs font-bold text-white" aria-hidden="true">{{ $loop->iteration }}</span>
                                    <span>{{ $etape }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Procédure de laboratoire (PPT slides 55-56) — fond blanc à vagues
         Retour client : « procédure de laboratoire needs to have each picture with
         each text it has on the ppt ». Le site regroupait trois textes autour
         d'une seule photo, puis deux autres autour d'une seconde — et ces deux
         photos n'étaient même pas celles que la maquette leur associe.

         Appariement relevé dans le PPT (a:off de chaque bloc, diapos 55 et 56) :
           « Imagerie 3D et planification »  → image91.png (scan 3D des arcades)
           « Modèles 3D » + « Toutes les
             imprimantes 3D ne sont pas égales » → image92.jpeg (modèle imprimé)
           « Thermoformage »                 → image93.png (thermoformeuse)
           « Contrôle de qualité »           → image94.jpg (tampon QC)
           « Instructions de base »          → image95.jpeg (dentiste) — section
                                               suivante, sur fond bleu.
         Le portrait de dentiste servait donc à illustrer le thermoformage : c'est
         le décalage que le client a repéré. Les photos alternent gauche/droite
         d'un bloc à l'autre, comme les diapositives. D47. --}}
    @php
        $procedure = [
            [
                'titre' => 'Imagerie 3D et planification du traitement',
                'image' => 'imagerie-3d.webp',
                'alt' => 'Scan 3D des arcades dentaires réalisé au laboratoire Cleartrack',
                'paragraphes' => [
                    'Un scanner ou une empreinte en 3D est réalisé pour obtenir une réplique de vos dents. Une fois l’imagerie prête, des modèles 3D sont fabriqués pour chaque étape du traitement Cleartrack®. Une configuration virtuelle est alors préparée pour montrer au médecin le traitement prévu à chaque étape ainsi que le résultat final. Cela donne un avantage au traitement Cleartrack® par rapport au traitement orthodontique traditionnel, car le médecin voit le résultat final avant même que vous ne commenciez le traitement.',
                ],
            ],
            [
                'titre' => 'Modèles 3D',
                'image' => 'modeles-3d.jpg',
                'alt' => 'Modèle dentaire imprimé en 3D dans une imprimante MSLA du laboratoire Cleartrack',
                // La diapo 55 place ces deux titres dans le MÊME bloc de texte,
                // en regard de la même photo : ils restent donc réunis ici.
                'sousTitre' => 'Toutes les imprimantes 3D ne sont pas égales',
                'paragraphes' => [
                    'Des modèles 3D sont imprimés pour chaque étape du traitement Cleartrack dans nos laboratoires à l’aide d’imprimantes 3D dotées de la technologie MSLA. Nous garantissons la rapidité d’exécution de votre traitement.',
                    'Après plus de trois ans d’impression, nos laboratoires ont mis au point une méthode unique d’impression 3D précise. La technologie révolutionnaire MSLA permet à nos imprimantes d’atteindre des vitesses d’impression record, bien plus rapides que celles des imprimantes SLA ou DLP existantes.',
                ],
            ],
            [
                'titre' => 'Thermoformage',
                'image' => 'thermoformage.jpg',
                'alt' => 'Thermoformage d’un aligneur sur son modèle imprimé en 3D',
                'paragraphes' => [
                    'L’étape du thermoformage est celle où les modèles imprimés en 3D rencontrent le matériau thermoplastique utilisé pour créer les aligneurs Cleartrack®. Le thermoformage à haute pression est nécessaire pour former les aligneurs sur les modèles imprimés en 3D. Cette étape est importante car, pour créer des aligneurs clairs avec un mouvement dentaire prévisible, une précision est nécessaire sur les dents, la définition de la ligne gingivale et les textures gingivales.',
                ],
            ],
            [
                'titre' => 'Contrôle de qualité',
                'image' => 'controle-qualite.jpg',
                'alt' => 'Tampon « Quality control approved »',
                // Vignette : le fichier du PPT ne fait que 220 × 220.
                'petite' => true,
                'paragraphes' => [
                    'Avant d’autoriser la livraison des aligneurs à votre prestataire, un contrôle de qualité complet est effectué pour vérifier toutes les marges, les bordures, les épaisseurs, la numérotation et la forme de l’arcade de vos aligneurs. La différence Cleartrack® est claire.',
                ],
            ],
        ];
    @endphp

    <section class="bg-waves-light">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        <h2 class="section-title text-center">Procédure de laboratoire Cleartrack®</h2>
        <div class="mt-10 space-y-14">
            @foreach ($procedure as $etape)
                <div class="grid items-center gap-8 md:grid-cols-2">
                    {{-- Photo à droite pour les blocs impairs, à gauche pour les pairs --}}
                    <div class="flex justify-center {{ $loop->odd ? 'md:order-2' : 'md:order-1' }}">
                        <img src="{{ asset('assets/fabrication/' . $etape['image']) }}" alt="{{ $etape['alt'] }}"
                             class="w-full rounded-2xl shadow-xl {{ ($etape['petite'] ?? false) ? 'max-w-[220px] shadow-none' : 'max-w-md' }}" loading="lazy">
                    </div>
                    <div class="{{ $loop->odd ? 'md:order-1' : 'md:order-2' }}">
                        <h3 class="text-xl font-bold text-ppt-blue">{{ $etape['titre'] }}</h3>
                        <p class="mt-3 leading-relaxed">{{ $etape['paragraphes'][0] }}</p>
                        @if (isset($etape['sousTitre']))
                            <h3 class="mt-8 text-xl font-bold text-ppt-blue">{{ $etape['sousTitre'] }}</h3>
                            <p class="mt-3 leading-relaxed">{{ $etape['paragraphes'][1] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>

    {{-- Instructions de base (PPT slide 56)
         La diapo 56 associe ce bloc au portrait de dentiste (image95.jpeg) —
         celui-là même qui illustrait à tort le thermoformage. Il retrouve ici
         sa place, et les coches passent en numéros comme sur la diapo 54. D47. --}}
    <section class="bg-waves">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div>
                <h2 class="text-3xl font-bold text-white md:text-4xl">Instructions de base</h2>
                <ol class="mt-6 space-y-3 text-white/90">
                    @foreach ([
                        'Les aligneurs doivent être portés 20 à 22 heures par jour.',
                        'Passez au jeu suivant après 1 à 2 semaines (ou selon les instructions de votre dentiste).',
                        'Il est important de l’insérer et de le retirer correctement.',
                        'Le nettoyage des gouttières est important pour maintenir une bonne hygiène buccale.',
                        'Tous nos traitements sont livrés à votre dentiste avec un manuel d’instructions complet pour vous.',
                    ] as $instruction)
                        <li class="flex items-start gap-3">
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white text-xs font-bold text-ppt-blue" aria-hidden="true">{{ $loop->iteration }}</span>
                            <span>{{ $instruction }}</span>
                        </li>
                    @endforeach
                </ol>
                <a href="{{ route('rdv') }}" class="btn-white mt-8">Démarrer mon traitement</a>
            </div>
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('assets/fabrication/instructions-de-base.jpg') }}"
                     alt="Dentiste certifié Cleartrack® dans son cabinet"
                     class="w-full max-w-md rounded-2xl shadow-xl" loading="lazy">
            </div>
        </div>
    </section>
@endsection
