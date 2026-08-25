<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqEtBlogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Le blog est masqué par défaut depuis le retour client du 25/08/2026
        // (D53). Les tests ci-dessous portent sur son FONCTIONNEMENT — filtrage
        // des brouillons, données structurées — et non sur sa visibilité, que
        // vérifie PagesPubliquesTest. On l'active donc explicitement, pour que
        // ces garanties restent en place le jour où le client le rallume.
        config(['cleartrack.blog' => true]);
    }

    public function test_la_page_faq_affiche_les_questions_actives_dans_le_bon_groupe(): void
    {
        Faq::create(['groupe' => 'patient-general', 'question' => 'Question générale ?', 'reponse' => 'Réponse générale.', 'ordre' => 0]);
        Faq::create(['groupe' => 'patient-traitement', 'question' => 'Question traitement ?', 'reponse' => 'Réponse traitement.', 'ordre' => 0]);
        Faq::create(['groupe' => 'medecin', 'question' => 'Question médecin ?', 'reponse' => 'Réponse médecin.', 'ordre' => 0]);
        Faq::create(['groupe' => 'patient-general', 'question' => 'Question inactive ?', 'reponse' => 'Cachée.', 'ordre' => 1, 'actif' => false]);

        $response = $this->get('/faq');

        $response->assertSee('Question générale ?');
        $response->assertSee('Question traitement ?');
        $response->assertDontSee('Question médecin ?');
        $response->assertDontSee('Question inactive ?');
    }

    public function test_le_blog_naffiche_que_les_articles_publies(): void
    {
        Post::create(['titre' => 'Article publié', 'slug' => 'article-publie', 'extrait' => 'x', 'contenu' => '<p>x</p>', 'publie_le' => now()->subDay()]);
        Post::create(['titre' => 'Article brouillon', 'slug' => 'article-brouillon', 'extrait' => 'x', 'contenu' => '<p>x</p>', 'publie_le' => null]);
        Post::create(['titre' => 'Article futur', 'slug' => 'article-futur', 'extrait' => 'x', 'contenu' => '<p>x</p>', 'publie_le' => now()->addWeek()]);

        $response = $this->get('/blog');

        $response->assertSee('Article publié');
        $response->assertDontSee('Article brouillon');
        $response->assertDontSee('Article futur');
    }

    public function test_un_article_non_publie_retourne_404(): void
    {
        Post::create(['titre' => 'Brouillon', 'slug' => 'brouillon', 'extrait' => 'x', 'contenu' => '<p>x</p>', 'publie_le' => null]);

        $this->get('/blog/brouillon')->assertStatus(404);
    }

    public function test_un_article_publie_est_accessible_et_contient_le_schema_article(): void
    {
        Post::create(['titre' => 'Mon Article', 'slug' => 'mon-article', 'extrait' => 'Extrait', 'contenu' => '<p>Corps</p>', 'publie_le' => now()->subDay()]);

        $response = $this->get('/blog/mon-article');

        $response->assertStatus(200);
        $response->assertSee('Mon Article');
        $response->assertSee('"@type":"Article"', false);
    }
}
