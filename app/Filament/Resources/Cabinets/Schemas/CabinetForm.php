<?php

namespace App\Filament\Resources\Cabinets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CabinetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ville_id')
                    ->relationship('ville', 'id')
                    ->required(),
                TextInput::make('medecin')
                    ->required(),
                TextInput::make('telephone')
                    ->tel(),
                TextInput::make('adresse'),
                Toggle::make('actif')
                    ->required(),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
