<?php

namespace App\Filament\Resources\DemandeCas\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DemandeCasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('medecin_nom')
                    ->required(),
                TextInput::make('cabinet_adresse')
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
                TextInput::make('patient_nom')
                    ->required(),
                TextInput::make('patient_age')
                    ->required()
                    ->numeric(),
                TextInput::make('type_demande')
                    ->required(),
                TextInput::make('arcade')
                    ->required(),
                TextInput::make('correction')
                    ->required(),
                TextInput::make('dents_ne_pas_deplacer'),
                TextInput::make('dents_sans_attachements'),
                Textarea::make('instructions')
                    ->columnSpanFull(),
                Toggle::make('gouttiere_essai')
                    ->required(),
                Toggle::make('contact_formation')
                    ->required(),
                TextInput::make('statut')
                    ->required()
                    ->default('nouveau'),
            ]);
    }
}
