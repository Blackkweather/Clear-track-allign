<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cabinet extends Model
{
    protected $table = 'cabinets';

    protected $fillable = ['ville_id', 'medecin', 'telephone', 'adresse', 'actif', 'ordre'];

    protected function casts(): array
    {
        return ['actif' => 'boolean'];
    }

    public function ville(): BelongsTo
    {
        return $this->belongsTo(Ville::class);
    }
}
