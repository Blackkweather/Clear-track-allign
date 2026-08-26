<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        // « aligner-care » (page anglaise) a été retirée du site (D52) ; la page
        // française « instructions » a, elle, été rétablie (D58).
        $staticRoutes = [
            'home', 'pourquoi', 'avantages', 'cas-traitables', 'fabrication', 'faq',
            'instructions', 'a-propos', 'rdv', 'confidentialite', 'cgu',
            'medecin.index', 'medecin.demarrer', 'medecin.certifie',
            'medecin.telechargements', 'medecin.faq',
        ];

        // Le blog est masqué par défaut (D53) : ni son index ni ses articles ne
        // doivent être proposés aux moteurs tant que les routes répondent 404.
        if (config('cleartrack.blog')) {
            $staticRoutes[] = 'blog.index';
        }

        $urls = collect($staticRoutes)->map(fn ($name) => [
            'loc' => route($name),
            'priority' => $name === 'home' ? '1.0' : '0.7',
        ]);

        if (config('cleartrack.blog')) {
            $urls = $urls->merge(
                Post::publie()->get()->map(fn (Post $post) => [
                    'loc' => route('blog.show', $post),
                    'priority' => '0.6',
                    'lastmod' => $post->updated_at->toAtomString(),
                ])
            );
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lines), 200)->header('Content-Type', 'text/plain');
    }
}
