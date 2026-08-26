<?php

use App\Http\Controllers\EspaceMedecinController;
use App\Http\Controllers\RdvController;
use App\Http\Controllers\SeoController;
use App\Models\Faq;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// ── SEO ──────────────────────────────────────────────────────────────
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

// ── Site public patient ─────────────────────────────────────────────
Route::view('/', 'pages.home')->name('home');
Route::view('/pourquoi', 'pages.pourquoi')->name('pourquoi');
Route::view('/avantages', 'pages.avantages')->name('avantages');
Route::view('/cas-traitables', 'pages.cas-traitables')->name('cas-traitables');
Route::view('/fabrication', 'pages.fabrication')->name('fabrication');
Route::get('/faq', function () {
    return view('pages.faq', [
        'general' => Faq::actif()->where('groupe', 'patient-general')->get(),
        'traitement' => Faq::actif()->where('groupe', 'patient-traitement')->get(),
    ]);
})->name('faq');
// Page « Instructions d'utilisation » RÉTABLIE le 26/08/2026 : le client, qui
// avait demandé sa suppression la veille (D52), la veut de nouveau au même
// endroit et en français, mais sur la mise en page de l'ancienne page anglaise
// — onglets et panneau illustré. D58.
Route::view('/instructions', 'pages.instructions')->name('instructions');

// « Aligner Care Instructions », la page anglaise, reste supprimée (D52) : son
// contenu demeure dans l'historique Git si le client revenait sur sa décision.
Route::view('/a-propos', 'pages.a-propos')->name('a-propos');
Route::get('/prendre-rdv', [RdvController::class, 'show'])->name('rdv');
Route::post('/prendre-rdv', [RdvController::class, 'store'])
    ->middleware('throttle:5,10')->name('rdv.store');
Route::view('/politique-de-confidentialite', 'pages.confidentialite')->name('confidentialite');
Route::view('/conditions-generales', 'pages.cgu')->name('cgu');

// ── Blog ────────────────────────────────────────────────────────────
// Retour client : « blog — hide the whole, cause we don't have many blogs ».
// Le blog n'est pas supprimé mais MASQUÉ : gabarits, modèle, ressource Filament
// et tests restent en place, et une seule variable d'environnement le rallume
// (CLEARTRACK_BLOG=true) le jour où le client aura des articles à publier.
// Tant qu'il est masqué : plus de lien dans la nav ni le pied de page, plus
// d'entrée dans le sitemap, et les deux URL répondent 404 — le laisser
// accessible en direct reviendrait à publier une page vide. D53.
// Les deux routes restent DÉCLARÉES et c'est leur corps qui refuse de servir :
// les noms « blog.index » et « blog.show » continuent donc de se résoudre, ce
// dont dépendent le sitemap, l'admin Filament et les gabarits. Les enfermer
// dans un `if` au moment de l'enregistrement ferait échouer route('blog.index')
// avec une RouteNotFoundException dès qu'une vue y ferait référence.
Route::get('/blog', function () {
    abort_unless(config('cleartrack.blog'), 404);

    return view('pages.blog.index', [
        'posts' => Post::publie()->paginate(6),
    ]);
})->name('blog.index');
Route::get('/blog/{post:slug}', function (Post $post) {
    abort_unless(config('cleartrack.blog'), 404);
    abort_unless($post->publie_le && $post->publie_le->isPast(), 404);

    return view('pages.blog.show', ['post' => $post]);
})->name('blog.show');

// ── Espace Médecin ──────────────────────────────────────────────────
Route::prefix('espace-medecin')->name('medecin.')->group(function () {
    $ctrl = EspaceMedecinController::class;
    Route::get('/', [$ctrl, 'index'])->name('index');
    Route::get('/demarrer-un-traitement', [$ctrl, 'demarrer'])->name('demarrer');
    Route::post('/demarrer-un-traitement', [$ctrl, 'demarrerStore'])
        ->middleware('throttle:5,10')->name('demarrer.store');
    Route::get('/devenir-certifie', [$ctrl, 'certifie'])->name('certifie');
    Route::post('/devenir-certifie', [$ctrl, 'certifieStore'])
        ->middleware('throttle:5,10')->name('certifie.store');
    Route::get('/centre-de-telechargement', [$ctrl, 'telechargements'])->name('telechargements');
    Route::get('/faq', [$ctrl, 'faq'])->name('faq');
});
