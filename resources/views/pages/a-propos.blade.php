@extends('layouts.app')

{{--
    Page « À propos » — reproduction des diapositives 40 à 44 du PowerPoint client.
      diapo 40 : « Notre histoire »   — fond BLANC, photo à gauche, texte à droite
      diapo 41 : « Notre mission »    — fond BLANC, texte à gauche, photo à droite
      diapo 42 : « Nos standards »    — fond BLEU,  texte à gauche, photo à droite
      diapo 43 : « Nous aimons votre sourire ! » — fond BLANC, photo à gauche
    Le PPT n'ouvre pas cette page par un bandeau de titre : la première diapo
    attaque directement sur « Notre histoire », qui sert donc de titre de page.
--}}

@section('title', 'À propos — ClearTrack® align')
@section('meta_description', 'Notre histoire, notre mission et nos standards : ClearTrack® align rend les traitements orthodontiques professionnels accessibles au Maroc.')

@section('content')
    {{-- ══ Diapo 40 — Notre histoire (BLANC) ══ --}}
    <section class="bg-waves-light">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="flex justify-center md:order-1">
                <img src="{{ asset('assets/a-propos/notre-histoire.png') }}"
                     alt="Un aligneur Cleartrack® transparent tenu à la lumière du jour"
                     class="w-full max-w-md" loading="lazy">
            </div>
            <div class="md:order-2">
                <h1 class="section-title">Notre histoire</h1>
                <p class="mt-4 leading-relaxed">Les aligneurs existent depuis plus de 20 ans et pour beaucoup de gens, ils n’étaient toujours pas accessibles. Nous devions changer cela et nous savions que nous pouvions faire la différence.</p>
                <p class="mt-4 leading-relaxed">Après des années de développement et de traitements par aligneurs réussis, Cleartrack® a été fondée. Nous avons réduit le coût et construit une plateforme de télé dentisterie qui met nos clients en relation directe avec leur orthodontiste traitant. Votre santé passe toujours en premier, et nous ferons toujours ce qui est le mieux pour vous sur le plan médical. Nos médecins analysent soigneusement chaque cas et conçoivent un traitement qui tient compte de l’ensemble de votre santé bucco-dentaire. Nous vous conseillerons si nos orthodontistes déterminent que les gouttières invisibles ne vous conviennent pas.</p>
            </div>
        </div>
    </section>

    {{-- ══ Diapo 41 — Notre mission (BLANC, texte à gauche) ══ --}}
    <section class="bg-waves-light">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="md:order-1">
                <h2 class="section-title">Notre mission</h2>
                <p class="mt-4 leading-relaxed">Tout le monde mérite d’avoir confiance en soi, mais plusieurs personnes sont freinées ou complexées à cause de leur sourire. Pour certains, c’est parce que les appareils dentaires ne sont pas une option, et pour d’autres, c’est le coût élevé des traitements orthodontiques. Nous voulons changer cela. Nous pensons que la première impression compte et qu’un sourire confiant véhicule une image positive puissante.</p>
                <p class="mt-4 leading-relaxed">Dans cette philosophie, nous avons donné accès à des traitements orthodontiques professionnels En nous associant à des médecins qualifiés, des laboratoires et des fabricants innovants, nous sommes en mesure de fournir des produits de haute qualité à des prix abordables.</p>
            </div>
            <div class="flex justify-center md:order-2">
                <img src="{{ asset('assets/a-propos/notre-mission.jpg') }}"
                     alt="Aligneurs Cleartrack® rangés dans leur boîtier de transport"
                     class="w-full max-w-md" loading="lazy">
            </div>
        </div>
    </section>

    {{-- ══ Diapo 42 — Nos standards (BLEU, texte à gauche, photo à droite) ══ --}}
    <section class="bg-waves">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="text-white">
                <h2 class="section-title-invert">Nos standards</h2>
                <p class="mt-8 leading-relaxed text-white/90">Nous mettons au point des solutions de qualité à des prix équitables. Cleartrack innove mais ne négocie pas sur la qualité. Des orthodontistes qualifiés examinent chaque cas pour s’assurer que le traitement répond à un standard médical élevé.</p>
                <a href="{{ route('fabrication') }}" class="btn-outline-white mt-8">Comment sont ils fabriqués&nbsp;?</a>
            </div>
            {{-- Diapo 42 : la photo occupe toute la moitié droite et sort du cadre à droite --}}
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('assets/a-propos/nos-standards.jpg') }}"
                     alt="Un aligneur Cleartrack® tenu entre deux doigts"
                     class="w-full max-w-none md:-mr-16 lg:-mr-28" loading="lazy">
            </div>
        </div>
    </section>

    {{-- ══ Diapo 43 — Nous aimons votre sourire ! (BLANC, photo à gauche) ══
         La photo touche le bord gauche de l'écran, comme sur la diapositive. --}}
    <section class="bg-waves-light overflow-hidden">
        <div class="grid items-center gap-10 md:grid-cols-2">
            <img src="{{ asset('assets/a-propos/nous-aimons-votre-sourire.jpg') }}"
                 alt="Trois jeunes femmes souriantes sur fond bleu" loading="lazy"
                 class="h-64 w-full object-cover md:h-[32rem]">
            <div class="px-4 pb-16 pt-4 sm:px-6 md:py-16 md:pr-10">
                <h2 class="section-title">Nous aimons votre sourire&nbsp;!</h2>
                <p class="mt-6 leading-relaxed">Rendons-le plus beau …</p>
                <p class="mt-4 leading-relaxed">Nous éliminons les espaces entre les dents</p>
                <p class="mt-4 leading-relaxed">Nous redressons les dents inclinés et retournées pour</p>
                <p class="mt-4 leading-relaxed">obtenir un alignement parfait des dents</p>
                <div class="mt-8 flex flex-col items-start gap-3">
                    <a href="{{ route('cas-traitables') }}" class="btn-outline-brand">Voir les cas traitables</a>
                    <a href="{{ route('rdv') }}" class="btn-outline-brand">Démarrer mon traitement</a>
                </div>
            </div>
        </div>
    </section>
@endsection
