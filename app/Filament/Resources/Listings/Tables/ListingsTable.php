<?php

namespace App\Filament\Resources\Listings\Tables;

use App\Models\Listing;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ListingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('storeItem.title')
                    ->label('Product')
                    ->sortable()
                    ->searchable()
                    ->limit(30),
                TextColumn::make('user.name')
                    ->label('Seller')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('condition')
                    ->label('Condition')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'success',
                        'used' => 'warning',
                        'refurbished' => 'info',
                    }),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('condition')
                    ->options([
                        'new' => 'New',
                        'used' => 'Used',
                        'refurbished' => 'Refurbished',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (Listing $record) => $record->update(['status' => 'approved']))
                    ->visible(fn (Listing $record) => $record->status === 'pending'),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn (Listing $record) => $record->update(['status' => 'rejected']))
                    ->visible(fn (Listing $record) => $record->status === 'pending'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    BulkAction::make('approve')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'approved'])),
                    BulkAction::make('reject')
                        ->label('Reject Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'rejected'])),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
