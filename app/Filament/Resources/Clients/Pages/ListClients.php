<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;
use App\Models\Audit;
use App\Models\Client;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
            Action::make('create')
                ->form([
                    Select::make('audit_id')
                        ->required()
                        ->options(function () {
                            return Audit::all()->pluck('judul', 'id');
                        }),
                ])
                ->action(function (array $data) {
                    $audit = Audit::find($data['audit_id']);

                    if ($audit) {
                        Client::create([
                            'user_id' => Auth::user()->id,
                            'judul' => $audit->judul,
                            'penjelasan' => $audit->penjelasan,
                            'klausul_panduan' => $audit->klausul_panduan,
                        ]);
                    }
                }),

        ];
    }

    protected function getTableQuery(): Builder
    {

        return Client::where('user_id', Auth::user()->id)->orderBy('id', 'desc');

    }
}
