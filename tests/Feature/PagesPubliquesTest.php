<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PagesPubliquesTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('pagesProvider')]
    public function test_page_publique_repond_200(string $uri): void
    {
        $this->get($uri)->assertStatus(200);
    }

    public static function pagesProvider(): array
    {
        return [
            'accueil' => ['/'],
            'pourquoi' => ['/pourquoi'],
            'avantages' => ['/avantages'],
            'cas-traitables' => ['/cas-traitables'],
            'fabrication' => ['/fabrication'],
            'faq' => ['/faq'],
            'instructions' => ['/instructions'],
            'a-propos' => ['/a-propos'],
            'prendre-rdv' => ['/prendre-rdv'],
            'confidentialite' => ['/politique-de-confidentialite'],
            'cgu' => ['/conditions-generales'],
            'blog' => ['/blog'],
            'espace-medecin' => ['/espace-medecin'],
            'espace-medecin-demarrer' => ['/espace-medecin/demarrer-un-traitement'],
            'espace-medecin-certifie' => ['/espace-medecin/devenir-certifie'],
            'espace-medecin-telechargements' => ['/espace-medecin/centre-de-telechargement'],
            'espace-medecin-faq' => ['/espace-medecin/faq'],
        ];
    }

    public function test_sitemap_xml_est_valide(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $this->assertStringContainsString('<urlset', $response->getContent());
    }

    public function test_robots_txt_reference_le_sitemap_et_bloque_admin(): void
    {
        $response = $this->get('/robots.txt');
        $response->assertStatus(200);
        $response->assertSee('Disallow: /admin');
        $response->assertSee('Sitemap:');
    }

    public function test_page_inconnue_retourne_404(): void
    {
        $this->get('/cette-page-n-existe-pas')->assertStatus(404);
    }

    public function test_admin_non_authentifie_est_redirige_vers_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_la_nav_expose_accueil_et_instructions(): void
    {
        $response = $this->get('/');
        $response->assertSee('Accueil');
        $response->assertSee('Instructions');
        // Le logo renvoie à l'accueil depuis n'importe quelle page
        $this->get('/pourquoi')->assertSee('aria-label="ClearTrack align — Accueil"', false);
    }

    public function test_les_quatre_categories_d_instructions_sont_presentes(): void
    {
        $response = $this->get('/instructions');
        foreach (['Mettre en place', 'Retirer', 'Rangement et entretien', 'Manger et boire'] as $categorie) {
            $response->assertSee($categorie);
        }
        $response->assertSee('role="tablist"', false);
    }

    public function test_la_page_instructions_est_dans_le_sitemap(): void
    {
        $this->get('/sitemap.xml')->assertSee(route('instructions'), false);
    }

    public function test_version_animee_charge_la_couche_animations(): void
    {
        config(['cleartrack.animations' => true]);
        $response = $this->get('/');
        $response->assertSee('data-animations="on"', false);
        $response->assertSee('data-splash', false);
    }

    public function test_version_statique_ne_charge_aucune_animation(): void
    {
        config(['cleartrack.animations' => false]);
        $response = $this->get('/');
        $response->assertSee('data-animations="off"', false);
        $response->assertDontSee('data-splash', false);
        $response->assertDontSee('animations.js', false);
    }

    public function test_aucune_image_de_marque_tierce_n_est_publiee(): void
    {
        // Les visuels concurrents (Spark/Invisalign…) et le rendu filigrané ne doivent
        // jamais être servis depuis la racine web — voir CONTENT-DECISIONS.md D15 et D20.
        foreach (['slide20_0.jpg', 'slide20_1.jpg', 'photo-sourire-1.jpg'] as $fichier) {
            $this->assertFileDoesNotExist(public_path('assets/ppt/'.$fichier));
            $this->assertFileDoesNotExist(public_path('assets/'.$fichier));
        }
    }
}
