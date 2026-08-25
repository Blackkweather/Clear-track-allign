<?php

namespace Database\Seeders;

use App\Models\Cabinet;
use App\Models\Ville;
use Illuminate\Database\Seeder;

/**
 * Villes de l'annuaire des cabinets certifiés (PPT slides 73-75).
 *
 * Aucune fiche médecin n'est créée : les vraies coordonnées restent à fournir
 * par le client (Q5). Chaque ville affiche donc le message d'attente de la vue
 * (« Cabinets certifiés bientôt référencés dans cette ville — contactez-nous
 * au … »), ce qui est honnête tant que l'annuaire est vide.
 *
 * Retour client : « modify Casablanca in the cities, do the same one as
 * Mohammedia ». Casablanca portait les trois placeholders de la diapo 74
 * (« Dr. M. XXXXX », « 06 00 00 00 00 », « 34, rue XXX, XXXX, XXX ») ; elle se
 * comporte désormais comme toutes les autres villes. Voir D51.
 */
class AnnuaireSeeder extends Seeder
{
    public function run(): void
    {
        $villes = [
            'Casablanca', 'Mohammedia', 'Rabat', 'Kenitra', 'Larache', 'Assilah',
            'Tanger', 'Tétouan', 'Hoceima', 'Nador', 'Oujda', 'Taza', 'Fès',
            'Meknès', 'Beni Mellal', 'Settat', 'Marrakech', 'Safi', 'Agadir',
            'Laâyoune', 'Dakhla',
        ];

        foreach ($villes as $i => $nom) {
            Ville::updateOrCreate(['nom' => $nom], ['ordre' => $i]);
        }

        // Nettoyage des placeholders de la diapo 74, semés jusqu'ici sur
        // Casablanca. Le seeder est rejoué sur une base déjà remplie : les
        // supprimer explicitement est le seul moyen de faire disparaître les
        // fiches « Dr. M. XXXXX » d'un environnement existant. Les fiches
        // réelles, saisies depuis l'admin, ne portent pas ce nom et sont donc
        // intactes.
        Cabinet::where('medecin', 'Dr. M. XXXXX')->delete();
    }
}
