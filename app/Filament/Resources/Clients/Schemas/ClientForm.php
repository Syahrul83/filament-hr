<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('judul')
                    ->required(),
                TextInput::make('penjelasan'),
                DatePicker::make('tanggal')
                    ->required(),
                Textarea::make('klausul_panduan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
