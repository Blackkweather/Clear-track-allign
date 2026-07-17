<?php

namespace App\Filament\Resources\DemandeCas\Pages;

use App\Filament\Resources\DemandeCas\DemandeCasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDemandeCas extends ListRecords
{
    protected static string $resource = DemandeCasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
