<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $staticRoutes = [
            'home', 'pourquoi', 'avantages', 'cas-traitables', 'fabrication', 'faq',
            'instructions', 'aligner-care', 'a-propos', 'rdv', 'confidentialite', 'cgu', 'blog.index',
            'medecin.index', 'medecin.demarrer', 'medecin.certifie',
            'medecin.telechargements', 'medecin.faq',
        ];

        $urls = collect($staticRoutes)->map(fn ($name) => [
            'loc' => route($name),
            'priority' => $name === 'home' ? '1.0' : '0.7',
        ]);

        $urls = $urls->merge(
            Post::publie()->get()->map(fn (Post $post) => [
                'loc' => route('blog.show', $post),
                'priority' => '0.6',
                'lastmod' => $post->updated_at->toAtomString(),
            ])
        );

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
