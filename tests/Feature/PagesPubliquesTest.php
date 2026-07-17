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
}
