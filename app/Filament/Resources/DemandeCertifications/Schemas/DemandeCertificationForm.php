<?php

namespace App\Filament\Resources\DemandeCertifications\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DemandeCertificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('medecin_nom')
                    ->required(),
                TextInput::make('structure'),
                TextInput::make('adresse')
                    ->required(),
                TextInput::make('ville')
                    ->required(),
                TextInput::make('telephone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Toggle::make('contact_formation')
                    ->required(),
                Textarea::make('message')
                    ->columnSpanFull(),
                TextInput::make('statut')
                    ->required()
                    ->default('nouveau'),
            ]);
    }
}
