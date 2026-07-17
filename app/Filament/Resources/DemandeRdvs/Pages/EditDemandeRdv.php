<?php

namespace App\Filament\Resources\DemandeRdvs\Pages;

use App\Filament\Resources\DemandeRdvs\DemandeRdvResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDemandeRdv extends EditRecord
{
    protected static string $resource = DemandeRdvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
