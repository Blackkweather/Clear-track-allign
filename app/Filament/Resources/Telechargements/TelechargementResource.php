<?php

namespace App\Filament\Resources\Telechargements;

use App\Filament\Resources\Telechargements\Pages\CreateTelechargement;
use App\Filament\Resources\Telechargements\Pages\EditTelechargement;
use App\Filament\Resources\Telechargements\Pages\ListTelechargements;
use App\Filament\Resources\Telechargements\Schemas\TelechargementForm;
use App\Filament\Resources\Telechargements\Tables\TelechargementsTable;
use App\Models\Telechargement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TelechargementResource extends Resource
{
    protected static ?string $model = Telechargement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TelechargementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TelechargementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTelechargements::route('/'),
            'create' => CreateTelechargement::route('/create'),
            'edit' => EditTelechargement::route('/{record}/edit'),
        ];
    }
}
