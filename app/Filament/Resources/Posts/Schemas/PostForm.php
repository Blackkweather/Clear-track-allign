<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('extrait')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('contenu')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                DateTimePicker::make('publie_le'),
            ]);
    }
}
