<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ville extends Model
{
    protected $table = 'villes';

    protected $fillable = ['nom', 'ordre'];

    public function cabinets(): HasMany
    {
        return $this->hasMany(Cabinet::class)->where('actif', true)->orderBy('ordre');
    }
}
