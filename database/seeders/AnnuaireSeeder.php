<?php

namespace Database\Seeders;

use App\Models\Cabinet;
use App\Models\Ville;
use Illuminate\Database\Seeder;

/**
 * Villes de l'annuaire des cabinets certifiés (PPT slides 73-75).
 * Les fiches médecins sont des placeholders identiques à ceux du PPT
 * (« Dr. M. XXXXX ») — données réelles à fournir par le client (Q5).
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

        // Placeholders du PPT (slide 74) sur Casablanca uniquement
        $casablanca = Ville::where('nom', 'Casablanca')->first();
        if ($casablanca && $casablanca->cabinets()->count() === 0) {
            foreach (range(1, 3) as $i) {
                Cabinet::create([
                    'ville_id' => $casablanca->id,
                    'medecin' => 'Dr. M. XXXXX',
                    'telephone' => '06 00 00 00 00',
                    'adresse' => '34, rue XXX, XXXX, XXX',
                    'ordre' => $i,
                ]);
            }
        }
    }
}
