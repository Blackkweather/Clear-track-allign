<?php

/**
 * Point d'entrée pour l'hébergement sans serveur (Vercel).
 *
 * Identique à public/index.php, à une chose près : sur Vercel le système de
 * fichiers du déploiement est EN LECTURE SEULE, seul /tmp est inscriptible.
 * Laravel, lui, a besoin d'écrire (vues compilées, journaux, fichiers reçus).
 * On redirige donc son dossier storage vers /tmp avant de traiter la requête.
 *
 * Conséquence à connaître : /tmp est propre à chaque instance et disparaît au
 * bout d'un moment. Les données durables (demandes, contenus, sessions) vont en
 * base Postgres — c'est pourquoi SESSION_DRIVER et CACHE_STORE valent
 * « database ». Seuls les FICHIERS JOINTS aux formulaires restent éphémères
 * tant qu'un stockage objet (S3/R2) n'est pas branché.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$stockage = '/tmp/cleartrack-storage';

foreach ([
    $stockage.'/framework/views',
    $stockage.'/framework/cache/data',
    $stockage.'/framework/sessions',
    $stockage.'/framework/testing',
    $stockage.'/app/private',
    $stockage.'/app/public',
    $stockage.'/logs',
    // Manifeste des paquets auto-découverts. Normalement écrit par composer
    // pendant la construction (package:discover) ; ici le dossier bootstrap/cache
    // du déploiement est en lecture seule, donc Laravel le régénère dans /tmp.
    // Les variables APP_PACKAGES_CACHE / APP_SERVICES_CACHE l'y envoient.
    $stockage.'/bootstrap',
] as $dossier) {
    if (! is_dir($dossier)) {
        @mkdir($dossier, 0o777, true);
    }
}

require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Doit être appelé avant handleRequest() : c'est lui qui amorce la configuration.
$app->useStoragePath($stockage);

$app->handleRequest(Request::capture());
