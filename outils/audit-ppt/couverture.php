<?php

/**
 * Audit de COUVERTURE des diapositives.
 *
 * L'audit précédent (commit 720c87c) comparait des phrases : 382 sur 383
 * retrouvées. Il répondait à « le texte publié est-il fidèle ? », pas à
 * « toutes les diapositives sont-elles représentées quelque part ? ».
 * Le PPT compte 89 diapositives, le site 18 pages : une diapositive entière
 * peut manquer sans qu'aucune phrase publiée ne soit fautive.
 *
 * Méthode : pour chaque diapositive, on extrait ses fragments de texte
 * significatifs, on les normalise (minuscules, sans accents ni ponctuation) et
 * on cherche chacun dans le corpus du site. Une diapositive dont aucun fragment
 * n'est retrouvé est signalée comme absente.
 *
 *   php outils/audit-ppt/couverture.php "../Website conception.pptx" http://127.0.0.1:8000
 */
$pptx = $argv[1] ?? null;
$base = rtrim($argv[2] ?? 'http://127.0.0.1:8000', '/');
if (! $pptx || ! is_file($pptx)) {
    fwrite(STDERR, "PPTX introuvable\n");
    exit(1);
}

/** Normalisation : ce qui compte est le mot, pas sa casse ni ses accents. */
function normaliser(string $t): string
{
    $t = mb_strtolower($t, 'UTF-8');
    $t = strtr($t, [
        'à' => 'a', 'â' => 'a', 'ä' => 'a', 'á' => 'a', 'ã' => 'a', 'å' => 'a',
        'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
        'î' => 'i', 'ï' => 'i', 'í' => 'i',
        'ô' => 'o', 'ö' => 'o', 'ó' => 'o', 'õ' => 'o',
        'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ú' => 'u',
        'ç' => 'c', 'ñ' => 'n', 'œ' => 'oe', 'æ' => 'ae',
        '’' => ' ', "'" => ' ', '‘' => ' ', '«' => ' ', '»' => ' ',
        '“' => ' ', '”' => ' ', '–' => ' ', '—' => ' ', '…' => ' ',
    ]);
    $t = preg_replace('/[^a-z0-9]+/', ' ', $t);

    return trim(preg_replace('/\s+/', ' ', $t));
}

/* ── 1. Texte de chaque diapositive ──────────────────────────────────────── */
$zip = new ZipArchive;
$zip->open($pptx);
$diapos = [];
for ($i = 0; $i < $zip->numFiles; $i++) {
    $n = $zip->getNameIndex($i);
    if (! preg_match('#^ppt/slides/slide(\d+)\.xml$#', $n, $m)) {
        continue;
    }
    $xml = $zip->getFromIndex($i);

    // Chaque <a:p> est un paragraphe ; ses <a:t> sont les fragments de texte.
    $paras = [];
    if (preg_match_all('#<a:p>(.*?)</a:p>#s', $xml, $pp)) {
        foreach ($pp[1] as $p) {
            if (preg_match_all('#<a:t>(.*?)</a:t>#s', $p, $tt)) {
                $ligne = html_entity_decode(implode('', $tt[1]), ENT_QUOTES | ENT_XML1, 'UTF-8');
                $ligne = trim(preg_replace('/\s+/', ' ', $ligne));
                if ($ligne !== '') {
                    $paras[] = $ligne;
                }
            }
        }
    }
    $diapos[(int) $m[1]] = $paras;
}
$zip->close();
ksort($diapos);

/* ── 2. Corpus du site ───────────────────────────────────────────────────── */
$sitemap = @file_get_contents("{$base}/sitemap.xml");
if ($sitemap === false) {
    fwrite(STDERR, "Serveur injoignable sur {$base}\n");
    exit(1);
}
preg_match_all('#<loc>(.+?)</loc>#', $sitemap, $m);
$urls = array_values(array_unique(array_map(
    static fn ($u) => parse_url(html_entity_decode($u), PHP_URL_PATH) ?: '/',
    $m[1]
)));

$corpus = '';
$ctx = stream_context_create(['http' => ['ignore_errors' => true, 'timeout' => 60]]);
foreach ($urls as $chemin) {
    $html = @file_get_contents($base.$chemin, false, $ctx);
    if ($html === false) {
        continue;
    }
    $html = preg_replace('#<script.*?</script>|<style.*?</style>#si', ' ', $html);
    $corpus .= ' '.html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
$corpus = normaliser($corpus);
fwrite(STDERR, sprintf("Corpus site : %d pages, %d mots\n", count($urls), str_word_count($corpus)));

/* ── 3. Comparaison ──────────────────────────────────────────────────────── */
const MIN_MOTS = 4;   // en dessous, un fragment (« Nom », « 1 ») ne prouve rien

$absentes = [];
$partielles = [];
$couvertes = 0;
$decoratives = 0;

foreach ($diapos as $num => $paras) {
    $verifiables = [];
    foreach ($paras as $p) {
        $n = normaliser($p);
        if (str_word_count($n) >= MIN_MOTS) {
            $verifiables[] = ['brut' => $p, 'norm' => $n];
        }
    }

    if (! $verifiables) {
        $decoratives++;

        continue;   // diapositive d'image / de titre court : rien à vérifier
    }

    $trouves = 0;
    $manquants = [];
    foreach ($verifiables as $v) {
        if (str_contains($corpus, $v['norm'])) {
            $trouves++;

            continue;
        }
        // Repli : suite de 6 mots consécutifs, pour tolérer une reformulation légère
        $mots = explode(' ', $v['norm']);
        $ok = false;
        for ($i = 0; $i + 6 <= count($mots); $i++) {
            if (str_contains($corpus, implode(' ', array_slice($mots, $i, 6)))) {
                $ok = true;
                break;
            }
        }
        $ok ? $trouves++ : $manquants[] = $v['brut'];
    }

    $taux = $trouves / count($verifiables);
    if ($taux === 0.0) {
        $absentes[$num] = $manquants;
    } elseif ($taux < 0.5) {
        $partielles[$num] = ['taux' => $taux, 'manquants' => $manquants];
    } else {
        $couvertes++;
    }
}

/* ── 4. Rapport ──────────────────────────────────────────────────────────── */
printf("\n%s\n", str_repeat('=', 74));
printf("COUVERTURE DES DIAPOSITIVES — %d diapositives au total\n", count($diapos));
printf("%s\n", str_repeat('=', 74));
printf("  couvertes (≥ 50%% des fragments retrouvés) : %d\n", $couvertes);
printf("  partielles (< 50%%)                        : %d\n", count($partielles));
printf("  ABSENTES (aucun fragment retrouvé)        : %d\n", count($absentes));
printf("  sans texte vérifiable (images, titres)    : %d\n", $decoratives);

if ($absentes) {
    printf("\n%s\nDIAPOSITIVES ABSENTES DU SITE\n%s\n", str_repeat('-', 74), str_repeat('-', 74));
    foreach ($absentes as $num => $manquants) {
        printf("\n· Diapositive %d — %d fragment(s) introuvable(s)\n", $num, count($manquants));
        foreach (array_slice($manquants, 0, 4) as $t) {
            printf("    « %s »\n", mb_strimwidth($t, 0, 100, '…'));
        }
        if (count($manquants) > 4) {
            printf("    … et %d autre(s)\n", count($manquants) - 4);
        }
    }
}

if ($partielles) {
    printf("\n%s\nDIAPOSITIVES PARTIELLEMENT REPRISES\n%s\n", str_repeat('-', 74), str_repeat('-', 74));
    foreach ($partielles as $num => $d) {
        printf("\n· Diapositive %d — %d%% retrouvé\n", $num, (int) round(100 * $d['taux']));
        foreach (array_slice($d['manquants'], 0, 3) as $t) {
            printf("    « %s »\n", mb_strimwidth($t, 0, 100, '…'));
        }
        if (count($d['manquants']) > 3) {
            printf("    … et %d autre(s)\n", count($d['manquants']) - 3);
        }
    }
}
echo "\n";
