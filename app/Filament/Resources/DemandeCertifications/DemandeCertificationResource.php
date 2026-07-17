<?php

namespace App\Filament\Resources\DemandeCertifications;

use App\Filament\Resources\DemandeCertifications\Pages\CreateDemandeCertification;
use App\Filament\Resources\DemandeCertifications\Pages\EditDemandeCertification;
use App\Filament\Resources\DemandeCertifications\Pages\ListDemandeCertifications;
use App\Filament\Resources\DemandeCertifications\Schemas\DemandeCertificationForm;
use App\Filament\Resources\DemandeCertifications\Tables\DemandeCertificationsTable;
use App\Models\DemandeCertification;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DemandeCertificationResource extends Resource
{
    protected static ?string $model = DemandeCertification::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DemandeCertificationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DemandeCertificationsTable::configure($table);
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
            'index' => ListDemandeCertifications::route('/'),
            'create' => CreateDemandeCertification::route('/create'),
            'edit' => EditDemandeCertification::route('/{record}/edit'),
        ];
    }
}
