<?php

namespace App\Filament\Resources\DemandeRdvs;

use App\Filament\Resources\DemandeRdvs\Pages\CreateDemandeRdv;
use App\Filament\Resources\DemandeRdvs\Pages\EditDemandeRdv;
use App\Filament\Resources\DemandeRdvs\Pages\ListDemandeRdvs;
use App\Filament\Resources\DemandeRdvs\Schemas\DemandeRdvForm;
use App\Filament\Resources\DemandeRdvs\Tables\DemandeRdvsTable;
use App\Models\DemandeRdv;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DemandeRdvResource extends Resource
{
    protected static ?string $model = DemandeRdv::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DemandeRdvForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DemandeRdvsTable::configure($table);
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
            'index' => ListDemandeRdvs::route('/'),
            'create' => CreateDemandeRdv::route('/create'),
            'edit' => EditDemandeRdv::route('/{record}/edit'),
        ];
    }
}
