<?php

namespace App\Filament\Resources\DemandeCas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DemandeCasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('medecin_nom')
                    ->searchable(),
                TextColumn::make('cabinet_adresse')
                    ->searchable(),
                TextColumn::make('ville')
                    ->searchable(),
                TextColumn::make('telephone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('patient_nom')
                    ->searchable(),
                TextColumn::make('patient_age')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type_demande')
                    ->searchable(),
                TextColumn::make('arcade')
                    ->searchable(),
                TextColumn::make('correction')
                    ->searchable(),
                TextColumn::make('dents_ne_pas_deplacer')
                    ->searchable(),
                TextColumn::make('dents_sans_attachements')
                    ->searchable(),
                IconColumn::make('gouttiere_essai')
                    ->boolean(),
                IconColumn::make('contact_formation')
                    ->boolean(),
                TextColumn::make('statut')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
