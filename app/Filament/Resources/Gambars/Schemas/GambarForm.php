<?php

namespace App\Filament\Resources\Gambars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GambarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required(),
                FileUpload::make('image')
                    ->image(),
            ]);
    }
}
