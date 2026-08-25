<?php

namespace Tests\Feature;

use App\Http\Controllers\RdvController;
use App\Mail\NouvelleDemandeRdv;
use App\Models\DemandeRdv;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PrendreRdvTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        Mail::fake();
    }

    /** Demande complète et valide : tous les champs, et les six photos exigées. */
    private function demandeComplete(array $remplacements = []): array
    {
        $photos = [];
        foreach (array_keys(RdvController::TYPES_PHOTOS) as $type) {
            $photos["photo_$type"] = UploadedFile::fake()->image("$type.jpg");
        }

        return array_merge([
            'nom_complet' => 'Fatima Zahra Test',
            'date_naissance' => '1998-03-15',
            'adresse' => '12 rue Test, Rabat',
            'telephone' => '0611223344',
            'email' => 'fatima.test@example.com',
            'message' => 'Consultation souhaitée',
        ], $photos, $remplacements);
    }

    public function test_le_formulaire_rejette_les_champs_obligatoires_manquants(): void
    {
        $response = $this->post('/prendre-rdv', []);

        $response->assertSessionHasErrors(['nom_complet', 'date_naissance', 'adresse', 'telephone', 'email']);
        $this->assertDatabaseCount('demandes_rdv', 0);
    }

    public function test_une_demande_valide_est_enregistree_avec_ses_photos(): void
    {
        $response = $this->post('/prendre-rdv', $this->demandeComplete());

        $response->assertRedirect('/prendre-rdv');
        $response->assertSessionHas('succes', true);

        $this->assertDatabaseHas('demandes_rdv', [
            'nom_complet' => 'Fatima Zahra Test',
            'email' => 'fatima.test@example.com',
            'statut' => 'nouveau',
        ]);

        $demande = DemandeRdv::first();
        $this->assertCount(count(RdvController::TYPES_PHOTOS), $demande->photos);

        Mail::assertSent(NouvelleDemandeRdv::class, fn ($mail) => $mail->demande->id === $demande->id);
    }

    /**
     * Les six photos sont obligatoires depuis le retour client du 25/08/2026
     * (D50) : l'astérisque affiché sur chaque zone de dépôt doit correspondre
     * à une exigence réelle, côté serveur.
     */
    public function test_les_six_photos_sont_obligatoires(): void
    {
        $sansPhotos = $this->demandeComplete();
        foreach (array_keys(RdvController::TYPES_PHOTOS) as $type) {
            unset($sansPhotos["photo_$type"]);
        }

        $response = $this->post('/prendre-rdv', $sansPhotos);

        $response->assertSessionHasErrors(
            array_map(fn ($type) => "photo_$type", array_keys(RdvController::TYPES_PHOTOS))
        );
        $this->assertDatabaseCount('demandes_rdv', 0);
    }

    public function test_une_seule_photo_manquante_suffit_a_rejeter_la_demande(): void
    {
        $incomplete = $this->demandeComplete();
        unset($incomplete['photo_intra_gauche']);

        $response = $this->post('/prendre-rdv', $incomplete);

        $response->assertSessionHasErrors('photo_intra_gauche');
        $this->assertDatabaseCount('demandes_rdv', 0);
    }

    public function test_le_pot_de_miel_bloque_silencieusement_les_robots(): void
    {
        $response = $this->post('/prendre-rdv', [
            'nom_complet' => 'Bot',
            'site_web' => 'http://spam.example',
        ]);

        $response->assertRedirect('/prendre-rdv');
        $this->assertDatabaseCount('demandes_rdv', 0);
    }

    public function test_le_throttle_limite_les_soumissions_repetees(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/prendre-rdv', []);
        }

        $response = $this->post('/prendre-rdv', []);
        $response->assertStatus(429);
    }
}
