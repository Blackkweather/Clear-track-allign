<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telechargement extends Model
{
    protected $table = 'telechargements';

    protected $fillable = ['titre', 'fichier', 'ordre', 'actif'];

    protected function casts(): array
    {
        return ['actif' => 'boolean'];
    }
}
