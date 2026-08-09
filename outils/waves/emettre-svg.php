<?php

/**
 * Transforme les polylignes relevées en SVG : lissage Catmull-Rom → Bézier cubique.
 * Deux nuanciers issus d'une seule et même géométrie.
 */
$data = json_decode(file_get_contents($argv[1]), true);
$dossier = rtrim($argv[2], '/\\');

$W = $data['largeur'];
$H = $data['hauteur'];
$k = $data['pool'];
const EPAISSEUR = 10.5;   // mesuré sur les deux PNG d'origine (voir en-tête des fichiers)

/* ── Étirement vertical du PowerPoint ─────────────────────────────────────
   La maquette ne pose pas l'image à ses proportions natives : elle la fait
   pivoter de 90° (rot="5400000") puis l'étire sur toute la diapositive
   (<a:stretch><a:fillRect/>), qui est en 16:9. Le motif y est donc écrasé
   verticalement. Mesuré sur la diapositive 2 (fond bleu) :

     cadre rendu (après rotation) : 12 192 000 × 6 873 696 EMU → 1,7737
     image à ses proportions      : 2474 × 1749                → 1,4145
     écrasement vertical          : 1,4145 / 1,7737 = 0,7975

   La diapositive 5 (fond clair) donne 0,7906 : même traitement à 1 % près.
   On applique donc cet écrasement au groupe des tracés, ce qui reproduit aussi
   l'anisotropie du trait — dans le PPT une courbe horizontale est plus fine
   qu'une courbe verticale, puisque c'est le bitmap entier qui est étiré.

   Pour revenir aux proportions natives : mettre ÉTIREMENT à 1. */
const SLIDE_LARGEUR_EMU = 12192000;  // largeur de la diapositive
const SLIDE_FOND_HAUTEUR_EMU = 6873696;   // hauteur occupée par le fond, diapositive 2

$etirement = round(($W / $H) / (SLIDE_LARGEUR_EMU / SLIDE_FOND_HAUTEUR_EMU), 6);
$Hs = round($H * $etirement, 2);

/** Catmull-Rom uniforme → courbes de Bézier cubiques. */
function versBezier(array $pts, bool $ferme): string
{
    $n = count($pts);
    $P = static function (int $i) use ($pts, $n, $ferme) {
        if ($ferme) {
            return $pts[(($i % $n) + $n) % $n];
        }

        return $pts[max(0, min($n - 1, $i))];
    };
    $f = static fn (float $v) => rtrim(rtrim(number_format($v, 1, '.', ''), '0'), '.');

    $d = 'M'.$f($pts[0][0]).','.$f($pts[0][1]);
    $dernier = $ferme ? $n : $n - 1;
    for ($i = 0; $i < $dernier; $i++) {
        [$p0x, $p0y] = $P($i - 1);
        [$p1x, $p1y] = $P($i);
        [$p2x, $p2y] = $P($i + 1);
        [$p3x, $p3y] = $P($i + 2);
        $c1x = $p1x + ($p2x - $p0x) / 6;
        $c1y = $p1y + ($p2y - $p0y) / 6;
        $c2x = $p2x - ($p3x - $p1x) / 6;
        $c2y = $p2y - ($p3y - $p1y) / 6;
        $d .= 'C'.$f($c1x).','.$f($c1y)
            .' '.$f($c2x).','.$f($c2y)
            .' '.$f($p2x).','.$f($p2y);
    }

    return $d.($ferme ? 'Z' : '');
}

$chemins = [];
foreach ($data['traces'] as $t) {
    $pts = array_map(static fn ($p) => [$p[0] * $k, $p[1] * $k], $t['pts']);
    $chemins[] = versBezier($pts, $t['ferme']);
}

$nuanciers = [
    'bg-waves-blue.svg' => ['fond' => '#1586c8', 'trait' => '#248aca',
        'note' => 'Fond bleu des sections — teinte du PPT (ppt/media/image1.png).'],
    'bg-waves-landscape.svg' => ['fond' => '#ffffff', 'trait' => '#f6fafd',
        'note' => 'Variante claire — sections blanches à courbes discrètes.'],
    // Variante foncée (--color-brand-700), tenue prête si l'arbitrage D19 sur le
    // contraste est un jour inversé. Écart fond/trait repris du nuancier bleu
    // (+15, +4, +2) pour que les courbes s'y lisent avec la même discrétion.
    'bg-waves-dark.svg' => ['fond' => '#1667d5', 'trait' => '#256bd7',
        'note' => 'Variante foncée WCAG AA — texte blanc à 5,34:1 (voir D19).'],
];

foreach ($nuanciers as $nom => $c) {
    $svg = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $svg .= "<!--\n";
    $svg .= "  ClearTrack® align — fond à courbes de niveau.\n";
    $svg .= "  {$c['note']}\n\n";
    $svg .= "  Relevé vectoriel de la maquette PPT d'origine : ce sont les axes médians\n";
    $svg .= "  des traits du PNG, pas un motif redessiné. La géométrie est donc celle\n";
    $svg .= "  du client, au pixel près.\n\n";
    $svg .= "  Pour modifier l'aspect, il suffit des valeurs du bloc <style> :\n";
    $svg .= "    .fond  fill         → couleur de fond\n";
    $svg .= "    .trait stroke       → couleur des courbes\n";
    $svg .= "    .trait stroke-width → épaisseur (10.5 = celle du PPT)\n\n";
    $svg .= "  Le scale(1 {$etirement}) sur le groupe reproduit l'étirement de la maquette :\n";
    $svg .= "  le PPT fait pivoter l'image de 90° puis l'étire sur une diapositive 16:9,\n";
    $svg .= '  ce qui écrase le motif verticalement à '.round(100 * $etirement, 1)." %. Mettre 1 pour revenir\n";
    $svg .= "  aux proportions natives de l'image (viewBox à ajuster : {$W} × {$H}).\n";
    $svg .= "-->\n";
    $svg .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 '.$W.' '.$Hs.'">'."\n";
    $svg .= "  <style>\n";
    $svg .= "    .fond  { fill: {$c['fond']}; }\n";
    $svg .= "    .trait { fill: none; stroke: {$c['trait']}; stroke-width: ".EPAISSEUR.";\n";
    $svg .= "             stroke-linecap: round; stroke-linejoin: round; }\n";
    $svg .= "  </style>\n";
    $svg .= '  <rect class="fond" width="'.$W.'" height="'.$Hs.'"/>'."\n";
    $svg .= '  <g class="trait" transform="scale(1 '.$etirement.')">'."\n";
    foreach ($chemins as $d) {
        $svg .= '    <path d="'.$d.'"/>'."\n";
    }
    $svg .= "  </g>\n</svg>\n";

    file_put_contents("{$dossier}/{$nom}", $svg);
    printf("%-26s %6.1f Ko  (%d tracés, viewBox %d × %s)\n",
        $nom, strlen($svg) / 1024, count($chemins), $W, $Hs);
}
