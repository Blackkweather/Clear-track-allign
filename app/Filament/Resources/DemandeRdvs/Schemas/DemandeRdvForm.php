<?php

namespace App\Filament\Resources\DemandeRdvs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DemandeRdvForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom_complet')
                    ->required(),
                DatePicker::make('date_naissance')
                    ->required(),
                TextInput::make('adresse')
                    ->required(),
                TextInput::make('telephone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Textarea::make('message')
                    ->columnSpanFull(),
                TextInput::make('statut')
                    ->required()
                    ->default('nouveau'),
            ]);
    }
}
