<?php

namespace App\Filament\Resources\Telechargements\Pages;

use App\Filament\Resources\Telechargements\TelechargementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTelechargements extends ListRecords
{
    protected static string $resource = TelechargementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
