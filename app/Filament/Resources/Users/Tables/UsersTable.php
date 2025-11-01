<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.resources.users.fields.name'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-m-user'),

                TextColumn::make('email')
                    ->label(__('filament.resources.users.fields.email'))
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),

                IconColumn::make('email_verified_at')
                    ->label(__('filament.resources.users.fields.email_verified_at'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable()
                    ->tooltip(fn ($record) => $record->email_verified_at
                        ? __('filament.resources.users.badges.verified') . ': ' . $record->email_verified_at->format('Y-m-d H:i')
                        : __('filament.resources.users.badges.unverified')),

                TextColumn::make('created_at')
                    ->label(__('filament.resources.users.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-clock')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('filament.resources.users.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.users.fields.deleted_at'))
                    ->dateTime()
                    ->sortable()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make()
                    ->label(__('filament.resources.users.filters.trashed')),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament.resources.users.actions.view')),
                EditAction::make()
                    ->label(__('filament.resources.users.actions.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament.resources.users.actions.delete')),
                    ForceDeleteBulkAction::make()
                        ->label(__('filament.resources.users.actions.force_delete')),
                    RestoreBulkAction::make()
                        ->label(__('filament.resources.users.actions.restore')),
                ]),
            ]);
    }
}
