@extends('layouts.app')

@section('title', 'À propos — ClearTrack® align')
@section('meta_description', 'Notre histoire, notre mission et nos standards : ClearTrack® align rend les traitements orthodontiques professionnels accessibles au Maroc.')

@section('content')
    {{-- Notre histoire (PPT slide 40) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">À propos de Cleartrack®</h1>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
        <div>
            <h2 class="section-title">Notre histoire</h2>
            <p class="mt-4 leading-relaxed">Les aligneurs existent depuis plus de 20 ans et pour beaucoup de gens, ils n’étaient toujours pas accessibles. Nous devions changer cela et nous savions que nous pouvions faire la différence.</p>
            <p class="mt-4 leading-relaxed">Après des années de développement et de traitements par aligneurs réussis, Cleartrack® a été fondée. Nous avons réduit le coût et construit une plateforme de télédentisterie qui met nos clients en relation directe avec leur orthodontiste traitant. Votre santé passe toujours en premier, et nous ferons toujours ce qui est le mieux pour vous sur le plan médical. Nos médecins analysent soigneusement chaque cas et conçoivent un traitement qui tient compte de l’ensemble de votre santé bucco-dentaire. Nous vous conseillerons si nos orthodontistes déterminent que les gouttières invisibles ne vous conviennent pas.</p>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('assets/ppt/slide40_0.png') }}" alt="L’équipe et le laboratoire Cleartrack" class="w-full max-w-md rounded-2xl shadow-xl" loading="lazy">
        </div>
    </section>

    {{-- Notre mission (PPT slide 41) --}}
    <section class="bg-waves">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2">
            <div class="flex justify-center">
                <img src="{{ asset('assets/photo-histoire.jpg') }}" alt="Un sourire confiant grâce à Cleartrack" class="w-full max-w-md rounded-2xl shadow-xl" loading="lazy">
            </div>
            <div class="text-white">
                <h2 class="text-3xl font-bold md:text-4xl">Notre mission</h2>
                <p class="mt-4 leading-relaxed text-white/90">Tout le monde mérite d’avoir confiance en soi, mais plusieurs personnes sont freinées ou complexées à cause de leur sourire. Pour certains, c’est parce que les appareils dentaires ne sont pas une option, et pour d’autres, c’est le coût élevé des traitements orthodontiques. Nous voulons changer cela. Nous pensons que la première impression compte et qu’un sourire confiant véhicule une image positive puissante.</p>
                <p class="mt-4 leading-relaxed text-white/90">Dans cette philosophie, nous avons donné accès à des traitements orthodontiques professionnels. En nous associant à des médecins qualifiés, des laboratoires et des fabricants innovants, nous sommes en mesure de fournir des produits de haute qualité à des prix abordables.</p>
            </div>
        </div>
    </section>

    {{-- Nos standards (PPT slide 42) --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="section-title">Nos standards</h2>
            <p class="mt-4 leading-relaxed">Nous mettons au point des solutions de qualité à des prix équitables. Cleartrack innove mais ne négocie pas sur la qualité. Des orthodontistes qualifiés examinent chaque cas pour s’assurer que le traitement répond à un standard médical élevé.</p>
            <a href="{{ route('fabrication') }}" class="btn-brand mt-8">Comment sont-ils fabriqués&nbsp;?</a>
        </div>
    </section>

    {{-- Nous aimons votre sourire (PPT slide 43) --}}
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-16 text-center text-white sm:px-6">
            <h2 class="text-3xl font-bold md:text-4xl">Nous aimons votre sourire&nbsp;!</h2>
            <p class="mt-3 text-xl font-semibold">Rendons-le plus beau…</p>
            <p class="mx-auto mt-4 max-w-2xl text-white/90">Nous éliminons les espaces entre les dents. Nous redressons les dents inclinées et retournées pour obtenir un alignement parfait des dents.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('rdv') }}" class="btn-white">Démarrer mon traitement</a>
                <a href="{{ route('cas-traitables') }}" class="btn-outline-white">Voir les cas traitables</a>
            </div>
        </div>
    </section>
@endsection
