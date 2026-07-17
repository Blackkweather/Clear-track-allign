<?php

namespace Tests\Feature;

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

    public function test_le_formulaire_rejette_les_champs_obligatoires_manquants(): void
    {
        $response = $this->post('/prendre-rdv', []);

        $response->assertSessionHasErrors(['nom_complet', 'date_naissance', 'adresse', 'telephone', 'email']);
        $this->assertDatabaseCount('demandes_rdv', 0);
    }

    public function test_une_demande_valide_est_enregistree_avec_ses_photos(): void
    {
        $response = $this->post('/prendre-rdv', [
            'nom_complet' => 'Fatima Zahra Test',
            'date_naissance' => '1998-03-15',
            'adresse' => '12 rue Test, Rabat',
            'telephone' => '0611223344',
            'email' => 'fatima.test@example.com',
            'message' => 'Consultation souhaitée',
            'photo_visage_souriant' => UploadedFile::fake()->image('souriant.jpg'),
            'photo_intra_face' => UploadedFile::fake()->image('intra.jpg'),
        ]);

        $response->assertRedirect('/prendre-rdv');
        $response->assertSessionHas('succes', true);

        $this->assertDatabaseHas('demandes_rdv', [
            'nom_complet' => 'Fatima Zahra Test',
            'email' => 'fatima.test@example.com',
            'statut' => 'nouveau',
        ]);

        $demande = DemandeRdv::first();
        $this->assertCount(2, $demande->photos);

        Mail::assertSent(NouvelleDemandeRdv::class, fn ($mail) => $mail->demande->id === $demande->id);
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
