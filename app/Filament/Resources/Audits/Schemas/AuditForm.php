<?php

namespace App\Filament\Resources\Audits\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

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

                        TextInput::make('nilai_uji_1')->hidden(),
                        TextInput::make('nilai_uji_2')->hidden(),

                    ]),
            ])->columns(1);
    }
}
