<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FichierCas extends Model
{
    protected $table = 'fichiers_cas';

    protected $fillable = ['demande_cas_id', 'type', 'chemin'];

    public function demande(): BelongsTo
    {
        return $this->belongsTo(DemandeCas::class, 'demande_cas_id');
    }
}
