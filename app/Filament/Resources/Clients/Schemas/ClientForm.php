<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('judul')
                            ->disabled()
                            ->required(),
                        TextInput::make('user_id')
                            ->default(auth()->id())
                            ->hidden()
                            ->required(),
                        TextInput::make('penjelasan')
                            ->disabled(),
                        DatePicker::make('tanggal')
                            ->disabled(Auth::user()->hasAnyRole(['Penguji-1', 'Penguji-2', 'Admin']))
                            ->required(),
                    ]),

                Repeater::make('klausul_panduan')
                    ->schema([
                        Textarea::make('klausul')
                            ->readOnly(Auth::user()->hasAnyRole(['Penguji-1', 'Penguji-2', 'Admin'])),
                        Textarea::make('paduan_bukti_objektif')
                            ->readOnly(Auth::user()->hasAnyRole(['Penguji-1', 'Penguji-2', 'Admin'])),
                        Textarea::make('temuan')
                            ->readOnly(Auth::user()->hasAnyRole(['Penguji-1', 'Penguji-2', 'Admin'])),
                        FileUpload::make('lampiran')
                            ->image()
                            ->openable()
                            ->imagePreviewHeight('250')
                            ->deletable(
                                fn() => !auth()->user()?->hasAnyRole(['Penguji-1', 'Penguji-2'])
                            )
                            ->directory('auditAttachments')
                            ->maxSize(1120),
                        TextInput::make('nilai_uji_1')
                            ->hidden(Auth::user()->hasAnyRole(['Penguji-2', 'Admin', 'User'])),
                        TextInput::make('nilai_uji_2')
                            ->hidden(Auth::user()->hasAnyRole(['Penguji-1', 'Admin', 'User'])),
                    ])
                    ->addable(false)
                    ->deletable(false),

            ])->columns(1);
    }
}
