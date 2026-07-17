<?php

namespace App\Filament\Resources\DemandeCertifications\Pages;

use App\Filament\Resources\DemandeCertifications\DemandeCertificationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDemandeCertifications extends ListRecords
{
    protected static string $resource = DemandeCertificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
