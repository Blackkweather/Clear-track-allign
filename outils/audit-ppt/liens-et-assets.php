<?php

/**
 * Contrôle de santé du site en ligne : parcourt toutes les pages du sitemap et
 * vérifie que chaque lien interne, image, feuille de style et script répond bien.
 * Signale aussi les traces d'erreur Laravel restées dans le HTML.
 *
 *   php outils/audit-ppt/liens-et-assets.php https://cleartrack-align.vercel.app
 */
$base = rtrim($argv[1] ?? 'http://127.0.0.1:8000', '/');

$ctx = stream_context_create(['http' => ['ignore_errors' => true, 'timeout' => 45, 'method' => 'GET']]);

function statut(string $url, $ctx): int
{
    @file_get_contents($url, false, $ctx);
    foreach ($http_response_header ?? [] as $h) {
        if (preg_match('#^HTTP/\S+\s+(\d+)#', $h, $m)) {
            return (int) $m[1];
        }
    }

    return 0;
}

$sitemap = @file_get_contents("{$base}/sitemap.xml", false, $ctx);
if (! $sitemap) {
    fwrite(STDERR, "sitemap injoignable\n");
    exit(1);
}
preg_match_all('#<loc>(.+?)</loc>#', $sitemap, $m);
$pages = array_values(array_unique(array_map(
    static fn ($u) => parse_url(html_entity_decode($u), PHP_URL_PATH) ?: '/', $m[1]
)));

$ressources = [];   // url => [pages qui la référencent]
$liens = [];
$soucis = [];

foreach ($pages as $p) {
    $html = @file_get_contents($base.$p, false, $ctx);
    $code = 0;
    foreach ($http_response_header ?? [] as $h) {
        if (preg_match('#^HTTP/\S+\s+(\d+)#', $h, $c)) {
            $code = (int) $c[1];
        }
    }
    if ($code !== 200 || ! $html) {
        $soucis[] = "PAGE {$p} → HTTP {$code}";

        continue;
    }

    // Traces d'erreur laissées dans la page
    foreach (['Server Error', 'Whoops', 'SQLSTATE', 'Undefined variable', 'ErrorException', 'view [', 'Target class'] as $t) {
        if (str_contains($html, $t)) {
            $soucis[] = "TRACE «{$t}» dans {$p}";
        }
    }

    // Ressources
    preg_match_all('#(?:src|href)="([^"]+)"#i', $html, $mm);
    foreach ($mm[1] as $u) {
        if ($u === '' || str_starts_with($u, 'data:') || str_starts_with($u, '#')
            || str_starts_with($u, 'mailto:') || str_starts_with($u, 'tel:')) {
            continue;
        }
        if (preg_match('#^https?://#', $u)) {
            // Comparaison sans le schéma : le site peut émettre du http:// derrière
            // un proxy TLS, on ne veut pas prendre ses propres URL pour externes.
            $hote = preg_replace('#^https?://#', '', $base);
            if (! str_starts_with(preg_replace('#^https?://#', '', $u), $hote)) {
                continue;   // externe : hors périmètre
            }
            $u = substr(preg_replace('#^https?://#', '', $u), strlen($hote));
            if ($u === '') {
                $u = '/';
            }
        }
        if (! str_starts_with($u, '/')) {
            continue;
        }
        $cible = strtok($u, '?#');
        if (preg_match('#\.(png|jpe?g|svg|webp|gif|css|js|mp4|woff2?|ico|pdf)$#i', $cible)) {
            $ressources[$cible][] = $p;
        } else {
            $liens[$cible][] = $p;
        }
    }
}

fwrite(STDERR, sprintf("Pages : %d · ressources distinctes : %d · liens internes distincts : %d\n",
    count($pages), count($ressources), count($liens)));

$casses = [];
foreach ($ressources as $u => $refs) {
    $c = statut($base.$u, $ctx);
    if ($c !== 200) {
        $casses[] = sprintf('RESSOURCE %s → HTTP %d  (sur %s)', $u, $c, implode(', ', array_unique($refs)));
    }
}
foreach ($liens as $u => $refs) {
    $c = statut($base.$u, $ctx);
    if ($c !== 200 && $c !== 302) {
        $casses[] = sprintf('LIEN %s → HTTP %d  (sur %s)', $u, $c, implode(', ', array_unique($refs)));
    }
}

echo "\n".str_repeat('=', 70)."\nRÉSULTAT\n".str_repeat('=', 70)."\n";
if (! $soucis && ! $casses) {
    echo "Aucun problème détecté.\n";
} else {
    foreach (array_merge($soucis, $casses) as $s) {
        echo '  ✗ '.$s."\n";
    }
    printf("\n%d problème(s).\n", count($soucis) + count($casses));
}
