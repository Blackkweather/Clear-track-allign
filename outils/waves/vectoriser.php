<?php

/**
 * Vectorise le fond à courbes de niveau du PPT (bg-waves-blue.png) en tracés SVG.
 *
 * Chaîne : masque binaire → max-pool ×2 → squelettisation Zhang-Suen →
 *          suivi des polylignes → simplification Douglas-Peucker →
 *          lissage Catmull-Rom → courbes de Bézier cubiques.
 *
 * La géométrie produite est celle de l'image d'origine : on ne redessine rien,
 * on relève l'axe médian de chaque trait.
 */
ini_set('memory_limit', '2G');

$src = $argv[1] ?? null;
$out = $argv[2] ?? null;
if (! $src || ! $out) {
    fwrite(STDERR, "usage: php vectoriser.php <source.png> <sortie.json>\n");
    exit(1);
}

$t0 = microtime(true);
$im = imagecreatefrompng($src);
$W = imagesx($im);
$H = imagesy($im);
fwrite(STDERR, "Source : {$W}x{$H}\n");

/* ─── 1. Masque binaire plein format ───────────────────────────────────────
   Fond #1586C8 (luminance 108), traits #248ACA (luminance 115). Seuil à 112.
   Les pixels transparents (bords après rotation) comptent comme fond.        */
const SEUIL = 112;
$maskFull = str_repeat("\0", $W * $H);
for ($y = 0; $y < $H; $y++) {
    $row = $y * $W;
    for ($x = 0; $x < $W; $x++) {
        $c = imagecolorat($im, $x, $y);
        if ((($c >> 24) & 0x7F) > 64) {
            continue;
        }          // transparent → fond
        $r = ($c >> 16) & 0xFF;
        $g = ($c >> 8) & 0xFF;
        $b = $c & 0xFF;
        $lum = 0.299 * $r + 0.587 * $g + 0.114 * $b;
        if ($lum >= SEUIL) {
            $maskFull[$row + $x] = "\1";
        }
    }
}
imagedestroy($im);

/* ─── 2. Max-pool ×2 ───────────────────────────────────────────────────────
   Réduit le coût de la squelettisation sans jamais rompre un trait : on garde
   le pixel si l'un des 4 du bloc est allumé (une moyenne, elle, effacerait
   les traits les plus fins).                                                 */
define('POOL', (int) ($argv[3] ?? 2));
if (POOL === 1) {
    // Pleine résolution : aucune fusion possible entre courbes voisines
    $w = $W;
    $h = $H;
    $mask = $maskFull;
} else {
    $w = intdiv($W, POOL);
    $h = intdiv($H, POOL);
    $mask = str_repeat("\0", $w * $h);
    for ($y = 0; $y < $h; $y++) {
        $sy = $y * POOL;
        $row = $y * $w;
        for ($x = 0; $x < $w; $x++) {
            $sx = $x * POOL;
            if ($maskFull[$sy * $W + $sx] === "\1"
                || $maskFull[$sy * $W + $sx + 1] === "\1"
                || $maskFull[($sy + 1) * $W + $sx] === "\1"
                || $maskFull[($sy + 1) * $W + $sx + 1] === "\1") {
                $mask[$row + $x] = "\1";
            }
        }
    }
}
unset($maskFull);
fwrite(STDERR, sprintf("Masque %dx%d, %.1f%% allumé (%.1fs)\n",
    $w, $h, 100 * substr_count($mask, "\1") / ($w * $h), microtime(true) - $t0));

/* ─── 3. Squelettisation Zhang-Suen ────────────────────────────────────────
   On n'itère que sur la liste des pixels encore allumés (~12 % de l'image) :
   balayer les 1,08 M de pixels à chaque passe serait inutilement lent.        */
$mask0 = $mask;          // masque plein, conservé pour mesurer l'épaisseur du trait

$fg = [];
for ($i = 0, $n = $w * $h; $i < $n; $i++) {
    if ($mask[$i] === "\1") {
        $fg[] = $i;
    }
}

$voisins = static function (string $m, int $i, int $w): array {
    return [
        $m[$i - $w] === "\1" ? 1 : 0, // P2  N
        $m[$i - $w + 1] === "\1" ? 1 : 0, // P3  NE
        $m[$i + 1] === "\1" ? 1 : 0, // P4  E
        $m[$i + $w + 1] === "\1" ? 1 : 0, // P5  SE
        $m[$i + $w] === "\1" ? 1 : 0, // P6  S
        $m[$i + $w - 1] === "\1" ? 1 : 0, // P7  SO
        $m[$i - 1] === "\1" ? 1 : 0, // P8  O
        $m[$i - $w - 1] === "\1" ? 1 : 0, // P9  NO
    ];
};

$passe = 0;
do {
    $retires = 0;
    foreach ([0, 1] as $sousPasse) {
        $aRetirer = [];
        foreach ($fg as $i) {
            if ($mask[$i] !== "\1") {
                continue;
            }
            $x = $i % $w;
            $y = intdiv($i, $w);
            if ($x < 1 || $y < 1 || $x >= $w - 1 || $y >= $h - 1) {
                continue;
            }

            $p = $voisins($mask, $i, $w);
            $B = array_sum($p);
            if ($B < 2 || $B > 6) {
                continue;
            }

            $A = 0;
            for ($k = 0; $k < 8; $k++) {
                if ($p[$k] === 0 && $p[($k + 1) % 8] === 1) {
                    $A++;
                }
            }
            if ($A !== 1) {
                continue;
            }

            // p[0]=P2(N) p[2]=P4(E) p[4]=P6(S) p[6]=P8(O)
            if ($sousPasse === 0) {
                if ($p[0] * $p[2] * $p[4] !== 0) {
                    continue;
                }
                if ($p[2] * $p[4] * $p[6] !== 0) {
                    continue;
                }
            } else {
                if ($p[0] * $p[2] * $p[6] !== 0) {
                    continue;
                }
                if ($p[0] * $p[4] * $p[6] !== 0) {
                    continue;
                }
            }
            $aRetirer[] = $i;
        }
        foreach ($aRetirer as $i) {
            $mask[$i] = "\0";
        }
        $retires += count($aRetirer);
    }
    $fg = array_values(array_filter($fg, static fn ($i) => $mask[$i] === "\1"));
    $passe++;
} while ($retires > 0 && $passe < 60);

$longueurSquelette = count($fg);
fwrite(STDERR, sprintf("Squelette : %d passes, %d pixels (%.1fs)\n",
    $passe, $longueurSquelette, microtime(true) - $t0));

/* ─── 4. Suivi des polylignes ──────────────────────────────────────────────
   Décalages des 8 voisins, diagonales en dernier : sur un squelette 8-connexe
   on préfère toujours un pas orthogonal quand il existe, sinon le tracé
   « coupe les coins » et fabrique des marches d'escalier.                     */
$dirs = [1, -1, $w, -$w, $w + 1, $w - 1, -$w + 1, -$w - 1];

$estSquelette = array_fill_keys($fg, true);
$degre = [];
foreach ($fg as $i) {
    $d = 0;
    foreach ($dirs as $dd) {
        if (isset($estSquelette[$i + $dd])) {
            $d++;
        }
    }
    $degre[$i] = $d;
}

$vu = [];
$polylignes = [];

/* On ne s'arrête PAS sur les pixels de degré ≠ 2. Sur un squelette 8-connexe,
   un simple virage produit un pixel de degré 3 (le pixel d'avant et celui
   d'après sont diagonalement voisins entre eux) : couper là fragmentait le
   tracé en 6 000 miettes. On avance donc tant qu'il reste un voisin non visité,
   en préférant un pas orthogonal — les lignes de niveau ne se croisant jamais,
   les vraies jonctions sont de toute façon quasi inexistantes. */
/* Le pas suivant est celui qui prolonge le mieux la direction courante.
   Sans ce critère, arrivé au bout d'une ligne de niveau le tracé sautait sur la
   ligne voisine (elles se frôlent à 2-3 px par endroits) et fabriquait des ponts
   entre courbes : 21 748 px de squelette se retrouvaient dans 30 polylignes au
   lieu de ~70. Une ligne de niveau étant lisse, elle ne tourne quasiment pas
   d'un pixel à l'autre : exiger cos ≥ 0,6 (virage ≤ 53°) coupe les sauts sans
   tronquer les vraies courbes. */
const COS_MIN = 0.6;

$marcher = static function (int $vers, ?array $dirInit) use (&$vu, $estSquelette, $dirs, $w) {
    $pts = [];
    $cur = $vers;
    $vu[$cur] = true;
    $pts[] = [$cur % $w, intdiv($cur, $w)];
    $dir = $dirInit;
    while (true) {
        $meilleur = null;
        $meilleurCos = -2.0;
        $meilleurDir = null;
        foreach ($dirs as $dd) {
            $c = $cur + $dd;
            if (! isset($estSquelette[$c]) || isset($vu[$c])) {
                continue;
            }
            $dx = ($c % $w) - ($cur % $w);
            $dy = intdiv($c, $w) - intdiv($cur, $w);
            $n = sqrt($dx * $dx + $dy * $dy);
            $ux = $dx / $n;
            $uy = $dy / $n;
            $cos = $dir === null ? 1.0 : $ux * $dir[0] + $uy * $dir[1];
            if ($cos > $meilleurCos) {
                $meilleurCos = $cos;
                $meilleur = $c;
                $meilleurDir = [$ux, $uy];
            }
        }
        if ($meilleur === null) {
            break;
        }
        if ($dir !== null && $meilleurCos < COS_MIN) {
            break;
        }
        $cur = $meilleur;
        $dir = $meilleurDir;
        $vu[$cur] = true;
        $pts[] = [$cur % $w, intdiv($cur, $w)];
    }

    return $pts;
};

// Les extrémités (degré 1) d'abord : démarrer une boucle en son milieu
// donnerait deux demi-tracés au lieu d'un seul.
$ordre = $fg;
usort($ordre, static fn ($a, $b) => $degre[$a] <=> $degre[$b]);

foreach ($ordre as $i) {
    if (isset($vu[$i])) {
        continue;
    }
    $vu[$i] = true;
    $depart = [$i % $w, intdiv($i, $w)];

    $libres = [];
    foreach ($dirs as $dd) {
        $c = $i + $dd;
        if (isset($estSquelette[$c]) && ! isset($vu[$c])) {
            $libres[] = $c;
        }
    }
    if (! $libres) {
        continue;
    }

    $vecteur = static function (int $de, int $vers) use ($w) {
        $dx = ($vers % $w) - ($de % $w);
        $dy = intdiv($vers, $w) - intdiv($de, $w);
        $n = sqrt($dx * $dx + $dy * $dy);

        return [$dx / $n, $dy / $n];
    };

    $avant = $marcher($libres[0], $vecteur($i, $libres[0]));
    $arriere = [];
    foreach (array_slice($libres, 1) as $c) {
        if (! isset($vu[$c])) {
            $arriere = $marcher($c, $vecteur($i, $c));
            break;
        }
    }

    $pts = array_merge(array_reverse($arriere), [$depart], $avant);

    // Boucle fermée : la fin retombe sur le départ (8-voisinage)
    $ferme = false;
    if (count($pts) > 8) {
        [$x0, $y0] = $pts[0];
        [$x1, $y1] = $pts[count($pts) - 1];
        $ferme = abs($x1 - $x0) <= 1 && abs($y1 - $y0) <= 1;
    }
    $polylignes[] = ['pts' => $pts, 'ferme' => $ferme];
}

fwrite(STDERR, sprintf("Polylignes brutes : %d (%.1fs)\n", count($polylignes), microtime(true) - $t0));

/* ─── 5. Douglas-Peucker ─────────────────────────────────────────────────── */
function douglasPeucker(array $pts, float $eps): array
{
    $n = count($pts);
    if ($n < 3) {
        return $pts;
    }
    $garder = array_fill(0, $n, false);
    $garder[0] = $garder[$n - 1] = true;
    $pile = [[0, $n - 1]];
    while ($pile) {
        [$a, $b] = array_pop($pile);
        if ($b <= $a + 1) {
            continue;
        }
        [$ax, $ay] = $pts[$a];
        [$bx, $by] = $pts[$b];
        $dx = $bx - $ax;
        $dy = $by - $ay;
        $len = sqrt($dx * $dx + $dy * $dy);
        $meilleur = -1.0;
        $idx = -1;
        for ($k = $a + 1; $k < $b; $k++) {
            [$px, $py] = $pts[$k];
            $d = $len > 1e-9
                ? abs($dy * $px - $dx * $py + $bx * $ay - $by * $ax) / $len
                : hypot($px - $ax, $py - $ay);
            if ($d > $meilleur) {
                $meilleur = $d;
                $idx = $k;
            }
        }
        if ($meilleur > $eps) {
            $garder[$idx] = true;
            $pile[] = [$a, $idx];
            $pile[] = [$idx, $b];
        }
    }
    $res = [];
    foreach ($pts as $k => $p) {
        if ($garder[$k]) {
            $res[] = $p;
        }
    }

    return $res;
}

const EPS = 0.8;         // px à l'échelle réduite (≈ 1,6 px sur l'original)
const LONG_MIN = 8;      // rejette les barbules de squelettisation

$final = [];
foreach ($polylignes as $pl) {
    if (count($pl['pts']) < LONG_MIN) {
        continue;
    }
    $s = douglasPeucker($pl['pts'], EPS);
    if (count($s) < 3) {
        continue;
    }
    $final[] = ['pts' => $s, 'ferme' => $pl['ferme']];
}

usort($final, static fn ($a, $b) => count($b['pts']) <=> count($a['pts']));

$totalPts = array_sum(array_map(static fn ($p) => count($p['pts']), $final));
fwrite(STDERR, sprintf("Retenu : %d tracés, %d points (%.1fs)\n",
    count($final), $totalPts, microtime(true) - $t0));

/* Épaisseur du trait : surface du masque ÷ longueur de l'axe médian.
   Mesurée sur le masque réduit puis ramenée à l'échelle de l'original. */
$aireMasque = substr_count($mask0, "\1");
$epaisseur = $aireMasque / max(1, $longueurSquelette) * POOL;
fwrite(STDERR, sprintf("Épaisseur mesurée : %.2f px (à %d px de large)\n", $epaisseur, $W));

file_put_contents($out, json_encode([
    'largeur' => $W, 'hauteur' => $H, 'pool' => POOL,
    'epaisseur' => round($epaisseur, 2), 'traces' => $final,
]));
fwrite(STDERR, "Écrit : {$out}\n");
