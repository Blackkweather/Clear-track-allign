{{--
    Bandeau « aperçu de validation ». Ne s'affiche que si CLEARTRACK_DEMO=true,
    c'est-à-dire sur les copies mises en ligne pour validation du client.
    En production le composant ne rend rien du tout.

    Raison d'être : sur un instantané statique, un envoi de formulaire ne part
    nulle part. Plutôt que de laisser un visiteur croire que sa demande a été
    transmise, on désactive l'envoi et on le dit.
--}}
@if (config('cleartrack.demo'))
    <div class="mb-8 rounded-2xl border-2 border-amber-400 bg-amber-50 p-6" role="note">
        <p class="font-bold text-amber-900">Aperçu de validation</p>
        <p class="mt-1 text-sm leading-relaxed text-amber-900">
            Cette copie est mise en ligne pour valider la mise en page et les contenus.
            Le formulaire ci-dessous est <strong>désactivé</strong>&nbsp;: aucune donnée
            n’est enregistrée ni transmise. Il fonctionnera normalement sur le site
            définitif.
        </p>
    </div>
@endif
