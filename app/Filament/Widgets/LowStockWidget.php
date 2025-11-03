<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LowStockWidget extends BaseWidget
{
    protected static ?int $sort = 6;
    protected int | string | array $columnSpan = 2;

    public function getHeading(): string | \Illuminate\Contracts\Support\Htmlable | null
    {
        return __('filament.widgets.low_stock.heading');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('stock_quantity', '<=', 10)
                    ->orderBy('stock_quantity')
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label(__('filament.widgets.low_stock.image'))
                    ->disk('public')
                    ->size(40)
                    ->circular(),

                Tables\Columns\TextColumn::make('name_ar')
                    ->label(__('filament.widgets.low_stock.product'))
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('category.name_ar')
                    ->label(__('filament.widgets.low_stock.category'))
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('stock_quantity')
                    ->label(__('filament.widgets.low_stock.stock'))
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state <= 5 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('filament.widgets.low_stock.price'))
                    ->money('SAR')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label(__('filament.widgets.low_stock.status'))
                    ->sortable(),
            ])
            ->defaultSort('stock_quantity')
            ->emptyStateHeading(__('filament.widgets.low_stock.empty_heading'))
            ->emptyStateDescription(__('filament.widgets.low_stock.empty_description'))
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
