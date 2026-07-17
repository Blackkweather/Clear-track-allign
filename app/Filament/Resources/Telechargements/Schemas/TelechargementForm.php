<?php

namespace App\Filament\Resources\Telechargements\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TelechargementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                TextInput::make('fichier'),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('actif')
                    ->required(),
            ]);
    }
}
