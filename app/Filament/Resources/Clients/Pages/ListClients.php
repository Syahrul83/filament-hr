<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;

use App\Models\Audit;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Wizard\Step;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
           Action::make('create')

            ->schema([
                Select::make('audit_id')
                    ->required()
                    ->options(
                        Audit::all()->pluck('judul', 'id')
                    )->afterStateUpdated(function ($state, callable $set) {
                        $audit = Audit::find($state);
                        $set('judul', $audit->judul);
                        $set('penjelasan', $audit->penjelasan);
                        $set('tanggal', $audit->tanggal);
                        $set('klausul_panduan', $audit->klausul_panduan);
                    })
                
               
            ])
           


        ];
    }
}
