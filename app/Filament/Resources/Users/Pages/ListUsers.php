<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        if (Auth::user()->hasAnyRole(['Penguji-1', 'Penguji-2', 'Admin'])) {
            return User::whereHas('roles', fn ($query) => $query->whereNot('name', 'super_admin'));
        }

        return User::where('user_id', Auth::id());
    }
}
