<?php

/**
 * Instantané statique du site, pour les copies d'aperçu mises en ligne
 * (validation client). Aspire les pages servies par le serveur de dev et les
 * écrit en HTML, puis recopie les assets.
 *
 * Pourquoi un instantané plutôt qu'un déploiement PHP : l'hébergement d'aperçu
 * n'exécute ni PHP ni base de données. Un instantané rend exactement ce que rend
 * le site, sans rien qui puisse tomber en erreur devant le client. Les
 * formulaires y sont neutralisés en amont par CLEARTRACK_DEMO=true.
 *
 *   php outils/apercu-statique/instantane.php http://127.0.0.1:8000 build-apercu
 */
$base = rtrim($argv[1] ?? 'http://127.0.0.1:8000', '/');
$sortie = $argv[2] ?? 'build-apercu';
$racine = dirname(__DIR__, 2);
$dest = $racine.'/'.$sortie;

/* ── Pages à aspirer ──────────────────────────────────────────────────────
   La liste est dérivée du sitemap, qui est déjà la source de vérité des pages
   publiques (SeoController) : on n'a donc pas deux listes à tenir à jour. */
$sitemap = @file_get_contents("{$base}/sitemap.xml");
if ($sitemap === false) {
    fwrite(STDERR, "Serveur injoignable sur {$base}\n");
    exit(1);
}
preg_match_all('#<loc>(.+?)</loc>#', $sitemap, $m);
$urls = array_map(static fn ($u) => parse_url(html_entity_decode($u), PHP_URL_PATH) ?: '/', $m[1]);
$urls = array_values(array_unique($urls));

if (! $urls) {
    fwrite(STDERR, "Sitemap vide — rien à aspirer\n");
    exit(1);
}

/* ── Aspiration ───────────────────────────────────────────────────────── */
@mkdir($dest, 0777, true);
$ecrites = 0;
$echecs = [];

foreach ($urls as $chemin) {
    $url = $base.$chemin;
    $ctx = stream_context_create(['http' => ['ignore_errors' => true, 'timeout' => 60]]);
    $html = @file_get_contents($url, false, $ctx);
    $code = 0;
    foreach ($http_response_header ?? [] as $h) {
        if (preg_match('#^HTTP/\S+\s+(\d+)#', $h, $c)) {
            $code = (int) $c[1];
        }
    }
    if ($html === false || $code !== 200) {
        $echecs[] = "{$chemin} (HTTP {$code})";

        continue;
    }

    /* URLs absolues → racine-relatives. Les vues emploient route()/url(), qui
       produisent des URL absolues bâties sur APP_URL : figées telles quelles,
       elles renverraient vers 127.0.0.1 depuis le site en ligne. Les rendre
       relatives évite d'avoir à connaître le domaine avant le déploiement. */
    $html = str_replace([$base.'/', $base], ['/', ''], $html);

    // « / » → index.html ; « /pourquoi » → « /pourquoi/index.html » (URL propres)
    $fichier = $chemin === '/' ? '/index.html' : rtrim($chemin, '/').'/index.html';
    $cible = $dest.$fichier;
    @mkdir(dirname($cible), 0777, true);
    file_put_contents($cible, $html);
    $ecrites++;
}

/* robots.txt : on interdit l'indexation de l'aperçu — c'est une copie de
   travail, elle ne doit pas se retrouver dans les moteurs de recherche à côté
   du site définitif (contenu dupliqué). */
file_put_contents($dest.'/robots.txt', "User-agent: *\nDisallow: /\n");

/* ── Assets ───────────────────────────────────────────────────────────── */
$copies = 0;
$copier = function (string $de, string $vers) use (&$copier, &$copies) {
    if (! is_dir($de)) {
        return;
    }
    @mkdir($vers, 0777, true);
    foreach (scandir($de) as $e) {
        if ($e === '.' || $e === '..') {
            continue;
        }
        is_dir("{$de}/{$e}") ? $copier("{$de}/{$e}", "{$vers}/{$e}")
                             : (copy("{$de}/{$e}", "{$vers}/{$e}") && $copies++);
    }
};
foreach (['assets', 'build'] as $d) {
    $copier("{$racine}/public/{$d}", "{$dest}/{$d}");
}
foreach (['favicon.ico', 'favicon.svg', 'apple-touch-icon.png'] as $f) {
    if (is_file("{$racine}/public/{$f}")) {
        copy("{$racine}/public/{$f}", "{$dest}/{$f}") && $copies++;
    }
}

printf("Pages écrites : %d / %d\n", $ecrites, count($urls));
printf("Fichiers d'assets copiés : %d\n", $copies);
if ($echecs) {
    fwrite(STDERR, "ÉCHECS :\n  - ".implode("\n  - ", $echecs)."\n");
    exit(1);
}
