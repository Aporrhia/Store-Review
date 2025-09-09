<?php

namespace App\Filament\Resources\StoreItems;

use App\Filament\Resources\StoreItems\Pages\CreateStoreItems;
use App\Filament\Resources\StoreItems\Pages\EditStoreItems;
use App\Filament\Resources\StoreItems\Pages\ListStoreItems;
use App\Filament\Resources\StoreItems\Schemas\StoreItemsForm;
use App\Filament\Resources\StoreItems\Tables\StoreItemsTable;
use App\Models\StoreItems;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreItemsResource extends Resource
{
    protected static ?string $model = StoreItems::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'StoreItem';

    public static function form(Schema $schema): Schema
    {
        return StoreItemsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoreItemsTable::configure($table);
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
            'index' => ListStoreItems::route('/'),
            'create' => CreateStoreItems::route('/create'),
            'edit' => EditStoreItems::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
