<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label(__('filament.resources.orders.fields.order_number'))
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-hashtag')
                    ->copyable()
                    ->copyMessage(__('filament.resources.orders.helpers.copied'))
                    ->weight('bold'),

                TextColumn::make('user.name')
                    ->label(__('filament.resources.orders.fields.customer'))
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user')
                    ->description(fn ($record) => $record->user->email ?? ''),

                TextColumn::make('items_count')
                    ->label(__('filament.resources.orders.fields.items_count'))
                    ->counts('items')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-shopping-bag'),

                TextColumn::make('total_amount')
                    ->label(__('filament.resources.orders.fields.total_amount'))
                    ->money('SAR')
                    ->sortable()
                    ->icon('heroicon-o-banknotes')
                    ->weight('bold')
                    ->color('success'),

                TextColumn::make('status')
                    ->label(__('filament.resources.orders.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => __('filament.resources.orders.status.' . $state))
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'processing' => 'heroicon-o-arrow-path',
                        'shipped' => 'heroicon-o-truck',
                        'delivered' => 'heroicon-o-check-circle',
                        'cancelled' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label(__('filament.resources.orders.fields.payment_status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => __('filament.resources.orders.payment_status.' . $state))
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'paid' => 'heroicon-o-check-circle',
                        'failed' => 'heroicon-o-x-circle',
                        'refunded' => 'heroicon-o-arrow-uturn-left',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label(__('filament.resources.orders.fields.order_date'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->description(fn ($record) => $record->created_at->diffForHumans()),

                TextColumn::make('updated_at')
                    ->label(__('filament.resources.orders.fields.updated_at'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.orders.fields.deleted_at'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('filament.resources.orders.filters.status'))
                    ->options([
                        'pending' => __('filament.resources.orders.status.pending'),
                        'processing' => __('filament.resources.orders.status.processing'),
                        'shipped' => __('filament.resources.orders.status.shipped'),
                        'delivered' => __('filament.resources.orders.status.delivered'),
                        'cancelled' => __('filament.resources.orders.status.cancelled'),
                    ])
                    ->multiple(),

                SelectFilter::make('payment_status')
                    ->label(__('filament.resources.orders.filters.payment_status'))
                    ->options([
                        'pending' => __('filament.resources.orders.payment_status.pending'),
                        'paid' => __('filament.resources.orders.payment_status.paid'),
                        'failed' => __('filament.resources.orders.payment_status.failed'),
                        'refunded' => __('filament.resources.orders.payment_status.refunded'),
                    ])
                    ->multiple(),

                Filter::make('created_at')
                    ->label(__('filament.resources.orders.filters.order_date'))
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('created_from')
                            ->label(__('filament.resources.orders.filters.from')),
                        \Filament\Forms\Components\DatePicker::make('created_until')
                            ->label(__('filament.resources.orders.filters.to')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),

                Filter::make('total_amount')
                    ->label(__('filament.resources.orders.filters.total_amount'))
                    ->form([
                        \Filament\Forms\Components\TextInput::make('amount_from')
                            ->label(__('filament.resources.orders.filters.min_amount'))
                            ->numeric()
                            ->prefix('SAR'),
                        \Filament\Forms\Components\TextInput::make('amount_until')
                            ->label(__('filament.resources.orders.filters.max_amount'))
                            ->numeric()
                            ->prefix('SAR'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['amount_from'],
                                fn (Builder $query, $amount): Builder => $query->where('total_amount', '>=', $amount),
                            )
                            ->when(
                                $data['amount_until'],
                                fn (Builder $query, $amount): Builder => $query->where('total_amount', '<=', $amount),
                            );
                    }),

                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament.resources.orders.actions.view')),
                EditAction::make()
                    ->label(__('filament.resources.orders.actions.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
