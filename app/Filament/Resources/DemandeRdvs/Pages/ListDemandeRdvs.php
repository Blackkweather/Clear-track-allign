<?php

namespace App\Filament\Resources\DemandeRdvs\Pages;

use App\Filament\Resources\DemandeRdvs\DemandeRdvResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDemandeRdvs extends ListRecords
{
    protected static string $resource = DemandeRdvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
