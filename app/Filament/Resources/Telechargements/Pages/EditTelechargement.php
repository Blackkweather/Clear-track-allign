<?php

namespace App\Filament\Resources\Telechargements\Pages;

use App\Filament\Resources\Telechargements\TelechargementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTelechargement extends EditRecord
{
    protected static string $resource = TelechargementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
