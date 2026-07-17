<?php

namespace App\Filament\Resources\DemandeCas;

use App\Filament\Resources\DemandeCas\Pages\CreateDemandeCas;
use App\Filament\Resources\DemandeCas\Pages\EditDemandeCas;
use App\Filament\Resources\DemandeCas\Pages\ListDemandeCas;
use App\Filament\Resources\DemandeCas\Schemas\DemandeCasForm;
use App\Filament\Resources\DemandeCas\Tables\DemandeCasTable;
use App\Models\DemandeCas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DemandeCasResource extends Resource
{
    protected static ?string $model = DemandeCas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DemandeCasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DemandeCasTable::configure($table);
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
            'index' => ListDemandeCas::route('/'),
            'create' => CreateDemandeCas::route('/create'),
            'edit' => EditDemandeCas::route('/{record}/edit'),
        ];
    }
}
