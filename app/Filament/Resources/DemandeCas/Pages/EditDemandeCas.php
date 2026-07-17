<?php

namespace App\Filament\Resources\DemandeCas\Pages;

use App\Filament\Resources\DemandeCas\DemandeCasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDemandeCas extends EditRecord
{
    protected static string $resource = DemandeCasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
