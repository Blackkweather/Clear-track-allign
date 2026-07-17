<?php

namespace App\Filament\Resources\DemandeCertifications\Pages;

use App\Filament\Resources\DemandeCertifications\DemandeCertificationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDemandeCertification extends EditRecord
{
    protected static string $resource = DemandeCertificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
