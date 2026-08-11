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
Route::view('/instructions', 'pages.instructions')->name('instructions');

// Page fournie par le client, en anglais (annotations du 11/08/2026).
Route::view('/aligner-care-instructions', 'pages.aligner-care-instructions')->name('aligner-care');
Route::view('/a-propos', 'pages.a-propos')->name('a-propos');
Route::get('/prendre-rdv', [RdvController::class, 'show'])->name('rdv');
Route::post('/prendre-rdv', [RdvController::class, 'store'])
    ->middleware('throttle:5,10')->name('rdv.store');
Route::view('/politique-de-confidentialite', 'pages.confidentialite')->name('confidentialite');
Route::view('/conditions-generales', 'pages.cgu')->name('cgu');

// ── Blog ────────────────────────────────────────────────────────────
Route::get('/blog', function () {
    return view('pages.blog.index', [
        'posts' => Post::publie()->paginate(6),
    ]);
})->name('blog.index');
Route::get('/blog/{post:slug}', function (Post $post) {
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
