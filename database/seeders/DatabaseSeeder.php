<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Les trois seeders de contenu, que CLAUDE.md annonce depuis toujours
        // comme lancés par « php artisan db:seed » — ils ne l'étaient en fait
        // jamais, DatabaseSeeder ne créant que le « Test User » d'échafaudage
        // de Laravel. Constaté le 01/09/2026 en production : base migrée, mais
        // entièrement vide de contenu.
        //
        // Ce « Test User » est retiré au passage. Il passait par
        // User::factory(), donc par fakerphp/faker — une dépendance de
        // développement, absente du vendor/ de production installé en
        // --no-dev. Le seeding échouait donc dès la première ligne sur
        // « Call to undefined function Database\Factories\fake() ». Et un
        // compte « Test User / test@example.com » n'avait de toute façon rien
        // à faire sur le site du client.
        //
        // Les trois seeders utilisent updateOrCreate : les rejouer à chaque
        // déploiement ne crée pas de doublons.
        $this->call([
            AnnuaireSeeder::class,
            ContenuSeeder::class,
            EspaceMedecinSeeder::class,
        ]);
    }
}
