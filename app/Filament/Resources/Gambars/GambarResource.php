<?php

namespace App\Filament\Resources\Gambars;

use App\Filament\Resources\Gambars\Pages\CreateGambar;
use App\Filament\Resources\Gambars\Pages\EditGambar;
use App\Filament\Resources\Gambars\Pages\ListGambars;
use App\Filament\Resources\Gambars\Schemas\GambarForm;
use App\Filament\Resources\Gambars\Tables\GambarsTable;
use App\Models\Gambar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GambarResource extends Resource
{
    protected static ?string $model = Gambar::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Gambar';

    public static function form(Schema $schema): Schema
    {
        return GambarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GambarsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGambars::route('/'),
            'create' => CreateGambar::route('/create'),
            'edit' => EditGambar::route('/{record}/edit'),
        ];
    }
}
