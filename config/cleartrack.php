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

];
