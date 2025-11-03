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
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('filament.resources.users.fields.id'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('name')
                    ->label(__('filament.resources.users.fields.name'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-m-user')
                    ->description(fn ($record) => $record->email)
                    ->copyable()
                    ->copyMessage(__('filament.resources.users.messages.copied'))
                    ->copyMessageDuration(1500),

                TextColumn::make('email')
                    ->label(__('filament.resources.users.fields.email'))
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->copyMessage(__('filament.resources.users.messages.email_copied'))
                    ->copyMessageDuration(1500)
                    ->toggleable(),

                TextColumn::make('user_type')
                    ->label(__('filament.resources.users.fields.user_type'))
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label(__('filament.resources.users.fields.is_active'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(),


                TextColumn::make('created_at')
                    ->label(__('filament.resources.users.fields.created_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-calendar')
                    ->description(fn ($record) => $record->created_at->format('Y-m-d H:i'))
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label(__('filament.resources.users.fields.updated_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->description(fn ($record) => $record->updated_at->format('Y-m-d H:i'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.users.fields.deleted_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('user_type')
                    ->label(__('filament.resources.users.filters.user_type'))
                    ->options([
                        'customer' => __('filament.resources.users.user_types.customer'),
                        'admin' => __('filament.resources.users.user_types.admin'),
                        'manager' => __('filament.resources.users.user_types.manager'),
                        'support' => __('filament.resources.users.user_types.support'),
                    ])
                    ->native(false),

                SelectFilter::make('is_active')
                    ->label(__('filament.resources.users.filters.status'))
                    ->options([
                        '1' => __('filament.resources.users.badges.active'),
                        '0' => __('filament.resources.users.badges.inactive'),
                    ])
                    ->native(false),

                SelectFilter::make('email_verified')
                    ->label(__('filament.resources.users.filters.verification_status'))
                    ->options([
                        'verified' => __('filament.resources.users.badges.verified'),
                        'unverified' => __('filament.resources.users.badges.unverified'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder =>
                        match ($data['value'] ?? null) {
                            'verified' => $query->whereNotNull('email_verified_at'),
                            'unverified' => $query->whereNull('email_verified_at'),
                            default => $query,
                        }
                    ),

                Filter::make('created_this_month')
                    ->label(__('filament.resources.users.filters.created_this_month'))
                    ->query(fn (Builder $query): Builder => $query->whereMonth('created_at', now()->month))
                    ->toggle(),

                Filter::make('created_this_week')
                    ->label(__('filament.resources.users.filters.created_this_week'))
                    ->query(fn (Builder $query): Builder => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]))
                    ->toggle(),

                TrashedFilter::make()
                    ->label(__('filament.resources.users.filters.trashed')),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament.resources.users.actions.view'))
                    ->icon('heroicon-m-eye'),
                EditAction::make()
                    ->label(__('filament.resources.users.actions.edit'))
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament.resources.users.actions.delete'))
                        ->icon('heroicon-m-trash'),
                    ForceDeleteBulkAction::make()
                        ->label(__('filament.resources.users.actions.force_delete'))
                        ->icon('heroicon-m-trash'),
                    RestoreBulkAction::make()
                        ->label(__('filament.resources.users.actions.restore'))
                        ->icon('heroicon-m-arrow-path'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->emptyStateHeading(__('filament.resources.users.empty_state.heading'))
            ->emptyStateDescription(__('filament.resources.users.empty_state.description'))
            ->emptyStateIcon('heroicon-o-user-group');
    }
}
