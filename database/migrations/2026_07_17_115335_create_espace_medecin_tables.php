<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Soumission de cas par un médecin (PPT slides 80-83)
        Schema::create('demandes_cas', function (Blueprint $table) {
            $table->id();
            // Médecin
            $table->string('medecin_nom');
            $table->string('cabinet_adresse');
            $table->string('ville');
            $table->string('telephone');
            $table->string('email');
            // Patient
            $table->string('patient_nom');
            $table->unsignedTinyInteger('patient_age');
            // Prescription
            $table->string('type_demande'); // estimation | conception | conception-fabrication
            $table->string('arcade'); // bimaxillaire | haut | bas
            $table->string('correction'); // esthetique | esthetique-fonctionnelle
            $table->string('dents_ne_pas_deplacer')->nullable();
            $table->string('dents_sans_attachements')->nullable();
            $table->text('instructions')->nullable();
            $table->boolean('gouttiere_essai')->default(false);
            $table->boolean('contact_formation')->default(false);
            $table->string('statut')->default('nouveau'); // nouveau | en-etude | devis-envoye | accepte | clos
            $table->timestamps();
        });

        Schema::create('fichiers_cas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_cas_id')->constrained('demandes_cas')->cascadeOnDelete();
            $table->string('type'); // visage-souriant, face-fermee, profil, intra-*, occlusale-*, radio-pano, teleradio
            $table->string('chemin');
            $table->timestamps();
        });

        // Demande de certification (PPT slides 84-85)
        Schema::create('demandes_certification', function (Blueprint $table) {
            $table->id();
            $table->string('medecin_nom');
            $table->string('structure')->nullable();
            $table->string('adresse');
            $table->string('ville');
            $table->string('telephone');
            $table->string('email');
            $table->boolean('contact_formation')->default(false);
            $table->text('message')->nullable();
            $table->string('statut')->default('nouveau');
            $table->timestamps();
        });

        // Centre de téléchargement (PPT slide 86)
        Schema::create('telechargements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('fichier')->nullable(); // null tant que le client n'a pas fourni le PDF
            $table->unsignedInteger('ordre')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telechargements');
        Schema::dropIfExists('demandes_certification');
        Schema::dropIfExists('fichiers_cas');
        Schema::dropIfExists('demandes_cas');
    }
};
