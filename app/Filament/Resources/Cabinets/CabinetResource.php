<?php

namespace App\Filament\Resources\Cabinets;

use App\Filament\Resources\Cabinets\Pages\CreateCabinet;
use App\Filament\Resources\Cabinets\Pages\EditCabinet;
use App\Filament\Resources\Cabinets\Pages\ListCabinets;
use App\Filament\Resources\Cabinets\Schemas\CabinetForm;
use App\Filament\Resources\Cabinets\Tables\CabinetsTable;
use App\Models\Cabinet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CabinetResource extends Resource
{
    protected static ?string $model = Cabinet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CabinetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CabinetsTable::configure($table);
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
            'index' => ListCabinets::route('/'),
            'create' => CreateCabinet::route('/create'),
            'edit' => EditCabinet::route('/{record}/edit'),
        ];
    }
}
