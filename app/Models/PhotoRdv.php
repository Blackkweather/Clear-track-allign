<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoRdv extends Model
{
    protected $table = 'photos_rdv';

    protected $fillable = ['demande_rdv_id', 'type', 'chemin'];

    public function demande(): BelongsTo
    {
        return $this->belongsTo(DemandeRdv::class, 'demande_rdv_id');
    }
}
