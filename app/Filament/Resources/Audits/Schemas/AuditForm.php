<?php

namespace App\Filament\Resources\Audits\Schemas;

use Faker\Core\File;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class AuditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('judul')
                            ->required(),
                        TextInput::make('user_id')
                            ->default(auth()->id())
                            ->hidden()
                            ->required(),
                        TextInput::make('penjelasan'),
                        DatePicker::make('tanggal')
                            ->required(),
                    ]),

                Repeater::make('klausul_panduan')
                    ->schema([
                        Textarea::make('klausul'),
                        Textarea::make('paduan_bukti_objektif'),
                        Textarea::make('temuan')->hidden(),
                        FileUpload::make('lampiran')

                            ->directory('audit-attachments')
                            ->maxSize(1120)->hidden(),

                    ])


            ])->columns(1);
    }
}
