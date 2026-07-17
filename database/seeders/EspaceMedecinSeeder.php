<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Telechargement;
use Illuminate\Database\Seeder;

class EspaceMedecinSeeder extends Seeder
{
    public function run(): void
    {
        // Documents du centre de téléchargement (PPT slide 86) — PDF à fournir par le client
        foreach ([
            'Fiche de prescription simplifiée',
            'Consentement éclairé du patient',
            'Consentement pour la contention',
        ] as $i => $titre) {
            Telechargement::updateOrCreate(['titre' => $titre], ['ordre' => $i]);
        }

        // FAQ Médecin — seule réponse fournie dans les sources (PPT slide 88).
        // Les ~19 autres questions du PPT attendent les réponses du client (voir CONTENT-DECISIONS.md).
        Faq::updateOrCreate(
            ['groupe' => 'medecin', 'question' => 'Pourquoi choisir Cleartrack ?'],
            ['reponse' => "Il y a tellement de traitements d'orthodontie esthétique sur le marché dentaire, alors pourquoi choisir Cleartrack ? L'orthodontie cosmétique est un terme utilisé pour décrire les appareils qui corrigent et alignent les dents pour obtenir un résultat plus esthétique. Les adultes, en particulier, préfèrent l'orthodontie cosmétique aux appareils fixes, car elle leur permet de suivre un traitement en toute discrétion. Cleartrack® est un système d'appareils dentaires transparents idéal pour ces types de cas.", 'ordre' => 0]
        );
    }
}
