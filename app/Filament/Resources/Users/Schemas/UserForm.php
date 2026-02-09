<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('email')
                    ->unique(ignoreRecord: true)
                    ->required(),

                Select::make('roles')
                    ->relationship(
                        'roles',
                        'name',
                        fn (Builder $query) => $query->when(
                            auth()->id() !== 1,
                            fn ($q) => $q->where('name', '!=', 'super_admin')
                        )
                    )
                    ->default(2)
                    ->required()
                    ->preload()
                    ->searchable(),

                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }
}
