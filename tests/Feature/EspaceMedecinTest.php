<?php

namespace Tests\Feature;

use App\Mail\NouvelleDemandeCas;
use App\Mail\NouvelleDemandeCertification;
use App\Models\DemandeCas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EspaceMedecinTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        Mail::fake();
    }

    private function casValide(array $overrides = []): array
    {
        $fichiers = [];
        foreach ([
            'visage_souriant', 'face_fermee', 'profil_ferme', 'intra_face', 'intra_droite',
            'intra_gauche', 'occlusale_maxillaire', 'occlusale_mandibulaire', 'radio_panoramique',
        ] as $type) {
            $fichiers["fichier_$type"] = UploadedFile::fake()->image("$type.jpg");
        }

        return array_merge([
            'medecin_nom' => 'Dr Test',
            'cabinet_adresse' => '5 av. Test',
            'ville' => 'Rabat',
            'telephone' => '0600112233',
            'email' => 'dr.test@example.com',
            'patient_nom' => 'Patient Test',
            'patient_age' => 28,
            'type_demande' => 'estimation',
            'arcade' => 'bimaxillaire',
            'correction' => 'esthetique',
            'consentement' => '1',
        ], $fichiers, $overrides);
    }

    public function test_le_formulaire_de_cas_exige_le_consentement(): void
    {
        $data = $this->casValide();
        unset($data['consentement']);

        $response = $this->post('/espace-medecin/demarrer-un-traitement', $data);

        $response->assertSessionHasErrors('consentement');
        $this->assertDatabaseCount('demandes_cas', 0);
    }

    public function test_le_formulaire_de_cas_exige_les_9_photos_obligatoires(): void
    {
        $data = $this->casValide();
        unset($data['fichier_radio_panoramique']);

        $response = $this->post('/espace-medecin/demarrer-un-traitement', $data);

        $response->assertSessionHasErrors('fichier_radio_panoramique');
    }

    public function test_un_cas_complet_est_enregistre_avec_ses_9_fichiers(): void
    {
        $response = $this->post('/espace-medecin/demarrer-un-traitement', $this->casValide());

        $response->assertRedirect('/espace-medecin/demarrer-un-traitement');
        $this->assertDatabaseHas('demandes_cas', [
            'medecin_nom' => 'Dr Test',
            'patient_nom' => 'Patient Test',
            'statut' => 'nouveau',
        ]);

        $demande = DemandeCas::first();
        $this->assertCount(9, $demande->fichiers);

        Mail::assertSent(NouvelleDemandeCas::class);
    }

    public function test_une_demande_de_certification_valide_est_enregistree(): void
    {
        $response = $this->post('/espace-medecin/devenir-certifie', [
            'medecin_nom' => 'Dr Certif',
            'adresse' => '10 rue Atlas',
            'ville' => 'Fès',
            'telephone' => '0611998877',
            'email' => 'dr.certif@example.com',
            'contact_formation' => '1',
        ]);

        $response->assertRedirect('/espace-medecin/devenir-certifie');
        $this->assertDatabaseHas('demandes_certification', [
            'medecin_nom' => 'Dr Certif',
            'ville' => 'Fès',
            'contact_formation' => true,
        ]);

        Mail::assertSent(NouvelleDemandeCertification::class);
    }

    public function test_un_fichier_non_image_ni_pdf_est_rejete(): void
    {
        $data = $this->casValide();
        $data['fichier_visage_souriant'] = UploadedFile::fake()->create('malware.exe', 10);

        $response = $this->post('/espace-medecin/demarrer-un-traitement', $data);

        $response->assertSessionHasErrors('fichier_visage_souriant');
    }
}
