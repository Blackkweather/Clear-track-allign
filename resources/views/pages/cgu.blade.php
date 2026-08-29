@extends('layouts.app')

@section('title', 'Conditions générales d’utilisation — ClearTrack® align')
@section('meta_description', 'Conditions générales d’utilisation du site www.cleartrack.ma exploité par Go dental SARL.')

@section('content')
    <section class="bg-waves">
        <div class="mx-auto max-w-7xl px-4 py-9 sm:py-14 sm:px-6">
            <h1 class="text-3xl font-bold text-white md:text-4xl">Conditions générales d’utilisation</h1>
        </div>
    </section>

    {{-- Texte intégral (PPT slides 66-68) — fond blanc à vagues, comme toutes les
         diapos blanches. Le fond est porté par la section pleine largeur et le
         conteneur centré passe à l'intérieur : porté par le conteneur, les courbes
         s'arrêteraient à 896 px et laisseraient des marges blanches sur les côtés. --}}
    <section class="bg-waves-light">
        <div class="mx-auto max-w-4xl space-y-6 px-4 py-10 sm:py-16 leading-relaxed sm:px-6">
        <p class="text-lg font-semibold text-ppt-blue">Bienvenue sur Cleartrack&nbsp;!</p>
        <p>Les présentes conditions d’utilisation («&nbsp;Conditions&nbsp;», «&nbsp;Conditions de service&nbsp;») régissent votre utilisation de notre site web www.cleartrack.ma (ensemble ou individuellement «&nbsp;Service&nbsp;») exploité par Go dental sarl.</p>
        <p>Notre politique de confidentialité régit également votre utilisation de notre service et explique comment nous recueillons, protégeons et divulguons les informations résultant de votre utilisation de nos pages web.</p>
        <p>Votre accord avec nous comprend les présentes Conditions et notre Politique de confidentialité («&nbsp;Accords&nbsp;»). Vous reconnaissez avoir lu et compris les Accords, et acceptez d’y être lié.</p>
        <p>Si vous n’êtes pas d’accord avec les Accords (ou si vous ne pouvez pas vous y conformer), vous ne pouvez pas utiliser le Service, mais vous devez nous le faire savoir en nous envoyant un e-mail à <a href="mailto:contact@cleartrack.ma" class="text-ppt-blue underline">contact@cleartrack.ma</a> afin que nous puissions essayer de trouver une solution. Ces Conditions s’appliquent à tous les visiteurs, utilisateurs et autres personnes qui souhaitent accéder au Service ou l’utiliser.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">Achats</h2>
        <p>Si vous souhaitez acheter un produit ou un service disponible par le biais du Service («&nbsp;Achat&nbsp;»), il peut vous être demandé de fournir certaines informations relatives à votre Achat, y compris, mais sans s’y limiter, votre numéro de carte de crédit ou de débit, la date d’expiration de votre carte, votre adresse de facturation et vos informations de livraison.</p>
        <p>Vous déclarez et garantissez que&nbsp;:</p>
        <ul class="list-disc space-y-2 pl-6">
            <li>(i) vous avez le droit légal d’utiliser toute(s) carte(s) ou autre(s) méthode(s) de paiement dans le cadre de tout achat&nbsp;; et que</li>
            <li>(ii) les informations que vous nous fournissez sont vraies, correctes et complètes.</li>
        </ul>
        <p>Nous pouvons faire appel à des services tiers pour faciliter le paiement et la réalisation des achats. En soumettant vos informations, vous nous donnez le droit de fournir ces informations à ces tiers, conformément à notre politique de confidentialité.</p>
        <p>Nous nous réservons le droit de refuser ou d’annuler votre commande à tout moment pour des raisons incluant mais non limitées à&nbsp;: la disponibilité du produit ou du service, des erreurs dans la description ou le prix du produit ou du service, une erreur dans votre commande ou d’autres raisons.</p>
        <p>Nous nous réservons le droit de refuser ou d’annuler votre commande si une fraude ou une transaction non autorisée ou illégale est suspectée.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">Contenu</h2>
        <p>Le contenu trouvé sur ou via ce service est la propriété de Cleartrack ou utilisé avec permission. Vous ne pouvez pas distribuer, modifier, transmettre, réutiliser, télécharger, réafficher, copier ou utiliser ledit contenu, en tout ou en partie, à des fins commerciales ou pour votre bénéfice personnel, sans notre autorisation écrite préalable.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">Liens vers d’autres sites web</h2>
        <p>Notre Service peut contenir des liens vers des sites web ou des services tiers qui ne sont pas détenus ou contrôlés par Cleartrack.</p>
        <p>Cleartrack n’a aucun contrôle sur, et n’assume aucune responsabilité pour, le contenu, les politiques de confidentialité ou les pratiques de tout site web ou service tiers. Vous reconnaissez et acceptez également que Cleartrack ne peut être tenu responsable, directement ou indirectement, de tout dommage ou perte causé ou supposé être causé par ou en relation avec l’utilisation ou la confiance accordée à un tel contenu, biens ou services disponibles sur ou via de tels sites web ou services.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">Modifications</h2>
        <p>Nous nous réservons le droit, à notre seule discrétion, de modifier ou de remplacer ces conditions à tout moment. Si une révision est importante, nous nous efforcerons de fournir un préavis d’au moins 30 jours avant l’entrée en vigueur des nouvelles conditions. Ce qui constitue une modification importante sera déterminé à notre seule discrétion.</p>

        <h2 class="pt-4 text-xl font-bold text-ppt-blue">Nous contacter</h2>
        <p>Si vous avez des questions sur les présentes conditions, veuillez nous contacter&nbsp;:</p>
        <ul class="list-disc space-y-1 pl-6">
            <li><a href="mailto:contact@cleartrack.ma" class="text-ppt-blue underline">contact@cleartrack.ma</a></li>
            <li><a href="tel:+212693133170" class="text-ppt-blue underline">+212 693 133 170</a></li>
        </ul>
        </div>
    </section>
@endsection
