<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['titre', 'slug', 'extrait', 'contenu', 'image', 'publie_le'];

    protected function casts(): array
    {
        return ['publie_le' => 'datetime'];
    }

    public function scopePublie($query)
    {
        return $query->whereNotNull('publie_le')
            ->where('publie_le', '<=', now())
            ->orderByDesc('publie_le');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
