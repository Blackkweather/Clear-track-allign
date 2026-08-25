<?php

return [

    /*
    |---------------------------------------------------------------------
    | Version animée / version statique
    |---------------------------------------------------------------------
    |
    | Le client a demandé deux rendus : une « version statique de base »,
    | copie conforme du PowerPoint, et une « version animée » enrichie
    | (écran d'ouverture au logo, apparition machine à écrire au défilement,
    | révélations douces, survols).
    |
    | true  → version animée (par défaut)
    | false → version statique : ni animations.css ni animations.js ne sont
    |         chargés, et les animations déjà présentes dans app.css/app.js
    |         sont neutralisées. La mise en page ne change pas d'un pixel.
    |
    */

    'animations' => (bool) env('CLEARTRACK_ANIMATIONS', true),

    /*
    |---------------------------------------------------------------------
    | Mode aperçu (démonstration)
    |---------------------------------------------------------------------
    |
    | Destiné aux copies d'aperçu mises en ligne pour validation du client
    | (instantané statique, sans PHP ni base de données). Les trois
    | formulaires — prise de rendez-vous, soumission de cas, demande de
    | certification — y afficheraient un faux succès sans rien enregistrer :
    | on les neutralise donc explicitement et on l'annonce, plutôt que de
    | laisser croire qu'une demande a été transmise.
    |
    | false → site normal (par défaut). Aucune incidence en production.
    |
    */

    'demo' => (bool) env('CLEARTRACK_DEMO', false),

    /*
    |---------------------------------------------------------------------
    | Blog
    |---------------------------------------------------------------------
    |
    | Le client a demandé de masquer le blog tant qu'il n'a pas assez
    | d'articles (« hide the whole, cause we don't have many blogs »).
    |
    | false → masqué (par défaut) : aucun lien dans la nav ni le pied de
    |         page, aucune entrée dans le sitemap, et /blog comme
    |         /blog/{slug} répondent 404. Rien n'est supprimé pour autant :
    |         le modèle Post, les gabarits et la ressource Filament restent
    |         en place, et les articles déjà saisis sont conservés.
    | true  → blog publié, comme avant.
    |
    | Il suffit de poser CLEARTRACK_BLOG=true dans .env pour le rallumer,
    | sans modification de code.
    |
    */

    'blog' => (bool) env('CLEARTRACK_BLOG', false),

];
