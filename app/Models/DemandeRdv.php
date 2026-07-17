<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DemandeRdv extends Model
{
    protected $table = 'demandes_rdv';

    protected $fillable = ['nom_complet', 'date_naissance', 'adresse', 'telephone', 'email', 'message', 'statut'];

    protected function casts(): array
    {
        return ['date_naissance' => 'date'];
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PhotoRdv::class, 'demande_rdv_id');
    }
}
