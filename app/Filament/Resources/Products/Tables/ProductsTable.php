<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label(__('filament.resources.products.fields.image_path'))
                    ->circular()
                    ->defaultImageUrl(fn($record) => $record->image_path ? asset('storage/' . $record->image_path) : url('/images/placeholder-product.png'))
                    ->width(50),

                TextColumn::make('name')
                    ->label(__('filament.resources.products.fields.name'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn($record) => $record->sku)
                    ->icon('heroicon-m-cube')
                    ->iconColor('primary'),

                TextColumn::make('category.name')
                    ->label(__('filament.resources.products.fields.category_id'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('price')
                    ->label(__('filament.resources.products.fields.price'))
                    ->money('USD')
                    ->sortable()
                    ->weight('semibold')
                    ->color('success'),

                TextColumn::make('cost_price')
                    ->label(__('filament.resources.products.fields.cost_price'))
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color('gray'),

                TextColumn::make('profit_margin')
                    ->label(__('filament.resources.products.fields.profit_margin'))
                    ->state(function ($record) {
                        if ($record->cost_price && $record->price > 0) {
                            $margin = (($record->price - $record->cost_price) / $record->price) * 100;
                            return number_format($margin, 1) . '%';
                        }
                        return '-';
                    })
                    ->badge()
                    ->color(fn($record) => match (true) {
                        !$record->cost_price => 'gray',
                        (($record->price - $record->cost_price) / $record->price) * 100 >= 30 => 'success',
                        (($record->price - $record->cost_price) / $record->price) * 100 >= 15 => 'warning',
                        default => 'danger',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('stock_quantity')
                    ->label(__('filament.resources.products.fields.stock_quantity'))
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn($record) => match (true) {
                        $record->stock_quantity == 0 => 'danger',
                        $record->stock_quantity <= $record->low_stock_threshold => 'warning',
                        default => 'success',
                    })
                    ->icon(fn($record) => match (true) {
                        $record->stock_quantity == 0 => 'heroicon-m-x-circle',
                        $record->stock_quantity <= $record->low_stock_threshold => 'heroicon-m-exclamation-triangle',
                        default => 'heroicon-m-check-circle',
                    }),

                TextColumn::make('stock_status')
                    ->label(__('filament.resources.products.fields.stock_status'))
                    ->badge()
                    ->state(fn($record) => match (true) {
                        $record->stock_quantity == 0 => __('filament.resources.products.badges.out_of_stock'),
                        $record->stock_quantity <= $record->low_stock_threshold => __('filament.resources.products.badges.low_stock'),
                        default => __('filament.resources.products.filters.in_stock'),
                    })
                    ->color(fn($record) => match (true) {
                        $record->stock_quantity == 0 => 'danger',
                        $record->stock_quantity <= $record->low_stock_threshold => 'warning',
                        default => 'success',
                    })
                    ->icon(fn($record) => match (true) {
                        $record->stock_quantity == 0 => 'heroicon-m-x-circle',
                        $record->stock_quantity <= $record->low_stock_threshold => 'heroicon-m-exclamation-triangle',
                        default => 'heroicon-m-check-circle',
                    })
                    ->toggleable(),

                TextColumn::make('weight')
                    ->label(__('filament.resources.products.fields.weight'))
                    ->numeric(decimalPlaces: 2)
                    ->suffix(' kg')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('expiration_date')
                    ->label(__('filament.resources.products.fields.expiration_date'))
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color(fn($record) => $record->expiration_date && $record->expiration_date->isPast() ? 'danger' : 'gray'),

                IconColumn::make('is_active')
                    ->label(__('filament.resources.products.fields.is_active'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->label(__('filament.resources.products.fields.is_featured'))
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label(__('filament.resources.products.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->since(),

                TextColumn::make('updated_at')
                    ->label(__('filament.resources.products.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->since(),

                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.products.fields.deleted_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),

                SelectFilter::make('category_id')
                    ->label(__('filament.resources.products.filters.category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->indicator(__('filament.resources.products.filters.category')),

                Filter::make('is_active')
                    ->label(__('filament.resources.products.filters.active'))
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true))
                    ->toggle(),

                Filter::make('is_featured')
                    ->label(__('filament.resources.products.filters.featured'))
                    ->query(fn(Builder $query): Builder => $query->where('is_featured', true))
                    ->toggle(),

                SelectFilter::make('stock_status')
                    ->label(__('filament.resources.products.filters.stock_status'))
                    ->options([
                        'in_stock' => __('filament.resources.products.filters.in_stock'),
                        'low_stock' => __('filament.resources.products.filters.low_stock'),
                        'out_of_stock' => __('filament.resources.products.filters.out_of_stock'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'out_of_stock' => $query->where('stock_quantity', 0),
                            'low_stock' => $query->whereColumn('stock_quantity', '<=', 'low_stock_threshold')
                                ->where('stock_quantity', '>', 0),
                            'in_stock' => $query->whereColumn('stock_quantity', '>', 'low_stock_threshold'),
                            default => $query,
                        };
                    })
                    ->indicator(__('filament.resources.products.filters.stock_status')),
            ])
            ->filtersFormColumns(2)
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament.resources.products.actions.view'))
                    ->icon('heroicon-m-eye'),
                EditAction::make()
                    ->label(__('filament.resources.products.actions.edit'))
                    ->icon('heroicon-m-pencil-square'),
                DeleteAction::make()
                    ->label(__('filament.resources.products.actions.delete'))
                    ->icon('heroicon-m-trash'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->poll('60s');
    }
}
