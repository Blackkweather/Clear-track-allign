<?php

namespace App\Filament\Resources\Cabinets\Pages;

use App\Filament\Resources\Cabinets\CabinetResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCabinet extends EditRecord
{
    protected static string $resource = CabinetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
