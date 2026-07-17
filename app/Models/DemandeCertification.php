<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeCertification extends Model
{
    protected $table = 'demandes_certification';

    protected $fillable = [
        'medecin_nom', 'structure', 'adresse', 'ville', 'telephone', 'email',
        'contact_formation', 'message', 'statut',
    ];

    protected function casts(): array
    {
        return ['contact_formation' => 'boolean'];
    }
}
