<?php

/**
 * Rastérise EXACTEMENT les courbes de Bézier écrites dans le SVG (mêmes points de
 * contrôle Catmull-Rom), pour vérifier que le lissage ne produit pas de
 * dépassements ni de boucles parasites. Sans navigateur disponible, c'est la
 * seule façon honnête de contrôler ce que le SVG dessine réellement.
 */
$data = json_decode(file_get_contents($argv[1]), true);
$sortie = $argv[2];
$echelle = (float) ($argv[3] ?? 0.8);
$epaisseur = (float) ($argv[4] ?? 10.5);

$W = (int) round($data['largeur'] * $echelle);
$H = (int) round($data['hauteur'] * $echelle);
$k = $data['pool'] * $echelle;

$im = imagecreatetruecolor($W, $H);
imagefilledrectangle($im, 0, 0, $W, $H, imagecolorallocate($im, 0x15, 0x86, 0xC8));
$trait = imagecolorallocate($im, 0x24, 0x8A, 0xCA);

$rayon = max(1, (int) round($epaisseur * $echelle / 2));
$diam = $rayon * 2;

// Trait épais à bouts ronds : un disque à chaque échantillon. Lent mais fidèle
// à stroke-linecap/linejoin: round, et sans les artefacts de imagesetthickness.
$point = static function (float $x, float $y) use ($im, $trait, $diam) {
    imagefilledellipse($im, (int) round($x), (int) round($y), $diam, $diam, $trait);
};

$cubique = static function (array $p0, array $c1, array $c2, array $p1) use ($point) {
    $n = 12;
    for ($t = 0; $t <= $n; $t++) {
        $u = $t / $n;
        $v = 1 - $u;
        $x = $v * $v * $v * $p0[0] + 3 * $v * $v * $u * $c1[0] + 3 * $v * $u * $u * $c2[0] + $u * $u * $u * $p1[0];
        $y = $v * $v * $v * $p0[1] + 3 * $v * $v * $u * $c1[1] + 3 * $v * $u * $u * $c2[1] + $u * $u * $u * $p1[1];
        $point($x, $y);
    }
};

$nSeg = 0;
foreach ($data['traces'] as $t) {
    $pts = array_map(static fn ($p) => [$p[0] * $k, $p[1] * $k], $t['pts']);
    $n = count($pts);
    $ferme = $t['ferme'];
    $P = static function (int $i) use ($pts, $n, $ferme) {
        if ($ferme) {
            return $pts[(($i % $n) + $n) % $n];
        }

        return $pts[max(0, min($n - 1, $i))];
    };
    $dernier = $ferme ? $n : $n - 1;
    for ($i = 0; $i < $dernier; $i++) {
        $p0 = $P($i - 1);
        $p1 = $P($i);
        $p2 = $P($i + 1);
        $p3 = $P($i + 2);
        $c1 = [$p1[0] + ($p2[0] - $p0[0]) / 6, $p1[1] + ($p2[1] - $p0[1]) / 6];
        $c2 = [$p2[0] - ($p3[0] - $p1[0]) / 6, $p2[1] - ($p3[1] - $p1[1]) / 6];
        $cubique($p1, $c1, $c2, $p2);
        $nSeg++;
    }
}
imagepng($im, $sortie);
echo "Rendu Bézier : {$nSeg} segments, trait {$epaisseur} → {$sortie} ({$W}x{$H})\n";
