<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DemandeCas extends Model
{
    protected $table = 'demandes_cas';

    protected $fillable = [
        'medecin_nom', 'cabinet_adresse', 'ville', 'telephone', 'email',
        'patient_nom', 'patient_age', 'type_demande', 'arcade', 'correction',
        'dents_ne_pas_deplacer', 'dents_sans_attachements', 'instructions',
        'gouttiere_essai', 'contact_formation', 'statut',
    ];

    protected function casts(): array
    {
        return ['gouttiere_essai' => 'boolean', 'contact_formation' => 'boolean'];
    }

    public function fichiers(): HasMany
    {
        return $this->hasMany(FichierCas::class, 'demande_cas_id');
    }
}
