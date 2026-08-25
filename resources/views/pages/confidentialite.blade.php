@extends('layouts.app')

@section('title', 'Politique de confidentialité — ClearTrack® align')
@section('meta_description', 'Politique de confidentialité du site www.cleartrack.ma — Go dental SARL.')

@section('content')
    {{-- En-tête (PPT slide 59)
         Retour client : « add the picture of ClearTrack Align logo and the hand
         holding the model to politique et confidentialité, as in the ppt ».
         La diapo 59 ouvre bien la page sur un bandeau photo pleine largeur — une
         main tenant un aligneur sur fond bleu — avec le logo posé par-dessus, à
         gauche. Le site n'affichait qu'un bandeau de titre uni.

         Le PPT juxtapose deux fichiers quasi identiques (image96 et image97) pour
         couvrir la largeur de la diapositive ; ici une seule suffit, étirée en
         bandeau : elle fait 4399 × 2110 et couvre largement un écran large.
         Le titre reste dans le bandeau, au-dessus de la photo — sans quoi la page
         s'ouvrirait sans <h1>. D48. --}}
    <section class="bg-waves relative overflow-hidden">
        <img src="{{ asset('assets/confidentialite/aligneur-main.jpg') }}" alt="" aria-hidden="true"
             class="absolute inset-0 h-full w-full object-cover object-right" fetchpriority="high">
        {{-- Voile bleu : la photo s'éclaircit vers la droite et le texte blanc doit
             rester lisible par-dessus, quelle que soit la largeur du bandeau. --}}
        <div class="absolute inset-0 bg-ppt-blue/70"></div>
        <div class="relative mx-auto flex max-w-7xl items-center gap-8 px-4 py-14 sm:px-6">
            <img src="{{ asset('assets/brand/logo-on-blue.png') }}" alt="ClearTrack® align"
                 class="hidden h-20 w-auto shrink-0 sm:block">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Politique de confidentialité</h1>
        </div>
    </section>

    {{-- Texte intégral (PPT slides 59-64) — fond blanc à vagues (voir cgu.blade.php
         pour le pourquoi de la section pleine largeur + conteneur centré interne). --}}
    <section class="bg-waves-light">
        <div class="mx-auto max-w-4xl space-y-6 px-4 py-16 leading-relaxed sm:px-6">
        <p>Go dental SARL (numéro du registre de commerce 147751) («&nbsp;Go dental&nbsp;», «&nbsp;nous&nbsp;» et «&nbsp;notre&nbsp;», «&nbsp;Cleartrack&nbsp;») respecte votre vie privée (l’utilisateur de ce site web) et prend au sérieux la protection de vos informations personnelles. À cette fin, la présente politique de confidentialité («&nbsp;Politique de confidentialité&nbsp;») explique comment nous recueillons, traitons, protégeons, conservons et partageons vos informations personnelles lorsque vous utilisez ce site web (www.cleartrack.ma, ci-après «&nbsp;le site web&nbsp;») et ses fonctionnalités connexes.</p>
        <p>Il convient de noter qu’en utilisant le site web et les fonctionnalités connexes, vous acceptez les conditions, les pratiques et les politiques relatives à la présente politique de confidentialité, vous consentez à la collecte et au traitement de toutes les informations (y compris les informations spéciales) et déclarez que vous avez plus de 18 ans. Si vous n’êtes pas d’accord avec les conditions, les pratiques et les politiques relatives à l’utilisation du site web telles qu’elles figurent dans la présente politique de confidentialité, il vous est interdit d’en faire usage. La divulgation et la fourniture d’informations personnelles sont volontaires. La poursuite de l’utilisation du site web et de ses fonctionnalités sera considérée comme une acceptation de toutes les dispositions, politiques et conditions contenues dans le présent document.</p>
        <p>En outre, il convient de noter que les conditions de la politique de confidentialité de Cleartrack peuvent être modifiées de temps à autre sans préavis. Il est de votre responsabilité de vous assurer que vous êtes au courant de ces changements lorsque vous utilisez le site web. La poursuite de votre utilisation sera considérée comme une acceptation de ces changements. Si vous n’êtes pas d’accord avec ces modifications, vous devez immédiatement cesser d’utiliser le site web.</p>
        <p>La présente politique de confidentialité ne concerne pas les informations dépersonnalisées, dans la mesure où ces informations ne peuvent pas être ré-identifiées, les informations anonymes et celles qui ont été divulguées publiquement et qui ne sont donc plus considérées comme des informations confidentielles.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">1. Informations personnelles recueillies</h2>
        <p>Cleartrack recueille divers types de renseignements lorsque vous utilisez le site web et ses fonctions connexes. Certaines informations collectées vous identifient directement et d’autres ne vous identifient pas personnellement. En utilisant le site web, en participant à des concours, en répondant à des questionnaires, en effectuant des achats et en créant un compte, Cleartrack recueille des informations personnelles, notamment, mais sans s’y limiter, les informations suivantes&nbsp;:</p>
        <ol class="list-decimal space-y-2 pl-6">
            <li>Les informations relatives à la race, au sexe, à l’état civil, à l’âge, à la santé physique et mentale et aux antécédents, au bien-être, au handicap, à la religion, à la langue, à l’adresse physique et à l’adresse professionnelle, au numéro d’identité et au statut professionnel&nbsp;;</li>
            <li>L’adresse de livraison, l’adresse électronique, le numéro de contact, les opinions personnelles et les coordonnées de vos prestataires de services médicaux&nbsp;;</li>
            <li>Informations sur l’équipement informatique et les logiciels que vous utilisez&nbsp;;</li>
            <li>Adresse de protocole Internet, habitudes de navigation, données de trafic, habitudes de clic et autres informations d’utilisation utilisant des technologies de suivi telles que les balises de suivi, les cookies, les cookies flash et autres&nbsp;;</li>
            <li>Certaines informations obtenues de votre part peuvent être celles qui concernent votre santé et des informations médicales. Dans de telles circonstances, vous reconnaissez qu’elles sont obtenues afin d’aider à la fourniture d’aligneurs, de tout traitement ou produit ou service connexe en général que propose Go dental.</li>
        </ol>
        <p>En utilisant le site web et ses fonctions connexes, vous consentez au traitement de toutes les informations recueillies auprès de vous et divulguées par vous, y compris les informations spéciales.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">2. Comment nous recueillons les informations</h2>
        <p>Cleartrack recueille vos renseignements personnels de diverses manières par l’intermédiaire du site web et des fonctionnalités connexes, notamment&nbsp;:</p>
        <ul class="list-disc space-y-2 pl-6">
            <li>Directement et volontairement de votre part lorsque vous les fournissez à Cleartrack en remplissant des formulaires en ligne, des questionnaires, des concours, des abonnements, des études, des enquêtes, en signalant des problèmes avec le site internet et en enregistrant un compte auprès de Cleartrack&nbsp;;</li>
            <li>Lorsque vous correspondez avec Cleartrack, par le biais du site web, de ses comptes de réseaux sociaux et par tout autre moyen électronique&nbsp;;</li>
            <li>Lorsque vous effectuez des achats sur le site web de Cleartrack&nbsp;;</li>
            <li>Automatiquement (avec votre consentement tel que détaillé dans les présentes) par le biais, entre autres, de l’utilisation de cookies (persistants et de session), de balises de suivi, de cookies flash, de suivi du comportement et d’autres technologies de collecte de données.</li>
        </ul>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">3. Partage de vos informations personnelles</h2>
        <p>Cleartrack n’a pas pour vocation de vendre des informations personnelles. Les renseignements personnels recueillis auprès de vous et que vous avez fournis sont partagés avec un groupe limité de tiers, notamment&nbsp;:</p>
        <ol class="list-decimal space-y-2 pl-6">
            <li>Votre professionnel dentaire agréé par Cleartrack&nbsp;;</li>
            <li>Tous les tiers, y compris, mais sans s’y limiter, les employés de Go dental, les techniciens dentaires agréés, les entités apparentées, les dentistes et les orthodontistes exerçant au-delà des frontières du Royaume du Maroc, les sociétés affiliées, les sous-traitants et les associés impliqués dans la fourniture, la recherche et la commercialisation d’aligneurs, de tout produit ou service connexe&nbsp;;</li>
            <li>Les successeurs en titre, les cessionnaires et les sociétés affiliées de Cleartrack.</li>
        </ol>
        <p>Lorsque la loi, une citation à comparaître ou une ordonnance du tribunal l’exigent, Cleartrack peut être tenu de divulguer vos renseignements personnels à des tiers. Sous réserve de ce qui est contenu dans les présentes, Cleartrack s’efforcera de s’assurer que les parties mentionnées ci-dessus adhèrent à la présente politique de confidentialité lorsqu’elles traitent vos informations personnelles, qu’elles les traitent de manière confidentielle et qu’elles mettent en place les mesures de sécurité nécessaires afin de protéger ces informations.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">4. Ce que fait Cleartrack avec vos informations personnelles recueillies</h2>
        <p>Cleartrack utilise les informations personnelles que vous nous fournissez et que nous recueillons à votre sujet de la manière suivante&nbsp;:</p>
        <ol class="list-decimal space-y-2 pl-6">
            <li>Afin d’aider votre fournisseur et tout tiers à fournir des aligneurs et tout produit ou service connexe&nbsp;;</li>
            <li>Afin de se conformer à toute loi, assignation à comparaître ou ordonnance d’un tribunal&nbsp;;</li>
            <li>Afin de faire respecter les droits de Cleartrack (et de ses employés), des fournisseurs, des hygiénistes buccaux, des techniciens dentaires agréés et de toutes les parties impliquées dans la fourniture, la recherche et la commercialisation d’aligneurs et de tout produit et service connexe&nbsp;;</li>
            <li>Pour vérifier votre identité&nbsp;;</li>
            <li>À des fins de marketing, y compris, mais sans s’y limiter, pour vous inviter à des événements, vous informer de promotions, vous envoyer des mises à jour et des lettres d’information (vous pouvez vous désabonner de notre lettre d’information). Ces informations peuvent être transmises à toute agence de marketing à laquelle Cleartrack fait appel&nbsp;;</li>
            <li>Pour vous fournir le site web&nbsp;;</li>
            <li>Pour répondre aux demandes de renseignements&nbsp;;</li>
            <li>Pour vous informer des changements ou de toute autre information pertinente&nbsp;;</li>
            <li>Pour améliorer les services qui vous sont fournis&nbsp;;</li>
            <li>Pour vous permettre d’ouvrir un compte et d’effectuer des achats en ligne&nbsp;;</li>
            <li>Analyser les tendances et les statistiques&nbsp;;</li>
            <li>Faciliter la recherche et le développement en ce qui concerne les aligneurs et tout produit ou service connexe.</li>
        </ol>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">5. Protection de vos renseignements personnels</h2>
        <p>Cleartrack prendra toutes les mesures raisonnables et appropriées pour sécuriser les informations personnelles recueillies auprès de vous et divulguées par vous. Nous utilisons, entre autres, des logiciels anti-virus, des technologies de cryptage et des économiseurs d’écran protégés par mot de passe.</p>
        <p>Il convient toutefois de noter que Cleartrack ne peut garantir la sécurité totale de vos renseignements personnels.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">6. Conservation des informations personnelles</h2>
        <p>Les informations personnelles collectées auprès de vous et fournies par vous sont conservées et maintenues uniquement pendant la période nécessaire à la réalisation des objectifs énumérés au paragraphe 4 (points 1 à 12), à moins que la conservation de ces informations ne soit autorisée par la loi pour une période plus longue.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">7. Maintenance et accès aux informations personnelles</h2>
        <p>Nous souhaitons maintenir l’exactitude de tous les renseignements personnels recueillis et obtenus auprès de vous. Nous pouvons vous demander de confirmer et de mettre à jour vos informations personnelles de temps à autre. Vous pouvez mettre à jour certaines informations en les modifiant via votre compte en ligne.</p>
        <p>En outre, vous pouvez demander la divulgation et/ou la destruction de vos informations personnelles conformément aux dispositions de la loi de protection des données à caractère personnel.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">8. Utilisation promotionnelle</h2>
        <p>Votre attention est attirée sur le fait qu’en fournissant vos informations, en créant un compte en ligne, en vous abonnant à nos lettres d’information, en participant à des concours et en répondant à des questionnaires, vous consentez à recevoir des informations promotionnelles et marketing par e-mail, SMS et téléphone. Vous avez la possibilité de vous désinscrire de ces communications à tout moment.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">9. Divulgation internationale</h2>
        <p>Comme indiqué ci-dessus, vos informations personnelles peuvent être divulguées au niveau international afin d’aider à la fourniture des aligneurs et de tout produit ou service connexe. Ces informations sont en outre partagées avec ces parties à des fins de recherche et de développement des services et produits susmentionnés.</p>
        <p>Les parties internationales concernées peuvent ne pas être soumises aux mêmes lois que celles relatives au traitement des informations à caractère personnel du Maroc et le niveau de protection de ces informations peut être inférieur à celui du Maroc.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">10. Coordonnées</h2>
        <p>Les coordonnées de Go dental SARL – Cleartrack sont les suivantes&nbsp;:</p>
        <ul class="list-disc space-y-1 pl-6">
            <li><a href="mailto:contact@cleartrack.ma" class="text-ppt-blue underline">contact@cleartrack.ma</a></li>
            <li><a href="mailto:godental.ma@gmail.com" class="text-ppt-blue underline">godental.ma@gmail.com</a></li>
            <li>16, Résidence Ifrane, Avenue Hassan II, Agdal, Rabat, 10090</li>
            <li><a href="tel:+212693133170" class="text-ppt-blue underline">+212 693 133 170</a></li>
        </ul>
        </div>
    </section>
@endsection
