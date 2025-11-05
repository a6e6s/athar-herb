<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.resources.contact_messages.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('filament.resources.contact_messages.fields.email'))
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope'),
                TextColumn::make('phone')
                    ->label(__('filament.resources.contact_messages.fields.phone'))
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-phone'),
                TextColumn::make('subject')
                    ->label(__('filament.resources.contact_messages.fields.subject'))
                    ->searchable()
                    ->limit(50)
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('filament.resources.contact_messages.fields.status'))
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'read',
                        'success' => 'replied',
                    ])
                    ->formatStateUsing(fn (string $state): string => __('filament.resources.contact_messages.status_options.' . $state))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('filament.resources.contact_messages.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->since(),
                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.contact_messages.fields.deleted_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
