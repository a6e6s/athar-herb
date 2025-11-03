<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 2;

    public function getHeading(): string | \Illuminate\Contracts\Support\Htmlable | null
    {
        return __('filament.widgets.recent_orders.heading');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('filament.widgets.recent_orders.order_id'))
                    ->searchable()
                    ->sortable()
                    ->prefix('#'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('filament.widgets.recent_orders.customer'))
                    ->searchable()
                    ->sortable()
                    ->default('زبون ضيف'),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label(__('filament.widgets.recent_orders.total'))
                    ->money('SAR')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('filament.widgets.recent_orders.status'))
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'processing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ])
                    ->formatStateUsing(fn (string $state): string => __(
                        'filament.widgets.recent_orders.statuses.' . $state
                    )),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label(__('filament.widgets.recent_orders.payment'))
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                    ])
                    ->formatStateUsing(fn (string $state): string => __(
                        'filament.widgets.recent_orders.payment_statuses.' . $state
                    )),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.widgets.recent_orders.date'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
