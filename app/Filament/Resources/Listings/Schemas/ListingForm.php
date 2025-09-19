<?php

namespace App\Filament\Resources\Listings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;

class ListingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Listing Details')
                    ->schema([
                        Select::make('store_item_id')
                            ->label('Product')
                            ->relationship('storeItem', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('user_id')
                            ->label('Seller')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01)
                            ->required(),
                        Select::make('condition')
                            ->label('Condition')
                            ->options([
                                'new' => 'New',
                                'used' => 'Used',
                                'refurbished' => 'Refurbished',
                            ])
                            ->required(),
                        Textarea::make('comment')
                            ->label('Comment')
                            ->rows(3)
                            ->columnSpanFull(),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending Review',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('pending'),
                    ])->columns(2),
            ]);
    }
}
