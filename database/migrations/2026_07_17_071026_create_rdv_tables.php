<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Annuaire des cabinets certifiés par ville (PPT slides 73-74)
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });

        Schema::create('cabinets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ville_id')->constrained('villes')->cascadeOnDelete();
            $table->string('medecin');
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->boolean('actif')->default(true);
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });

        // Demandes de RDV patient (formulaire PPT slides 71-72)
        Schema::create('demandes_rdv', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->date('date_naissance');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('email');
            $table->text('message')->nullable();
            $table->string('statut')->default('nouveau'); // nouveau | contacte | converti | clos
            $table->timestamps();
        });

        Schema::create('photos_rdv', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_rdv_id')->constrained('demandes_rdv')->cascadeOnDelete();
            $table->string('type'); // visage-souriant | profil-droit | profil-gauche | intra-face | intra-droite | intra-gauche
            $table->string('chemin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos_rdv');
        Schema::dropIfExists('demandes_rdv');
        Schema::dropIfExists('cabinets');
        Schema::dropIfExists('villes');
    }
};
