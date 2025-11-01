<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')
                    ->label(__('filament.resources.products.fields.category_id'))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('filament.resources.products.fields.name'))
                    ->searchable(),
                TextColumn::make('slug')
                    ->label(__('filament.resources.products.fields.slug'))
                    ->searchable(),
                TextColumn::make('price')
                    ->label(__('filament.resources.products.fields.price'))
                    ->money()
                    ->sortable(),
                TextColumn::make('cost_price')
                    ->label(__('filament.resources.products.fields.cost_price'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sku')
                    ->label(__('filament.resources.products.fields.sku'))
                    ->searchable(),
                TextColumn::make('stock_quantity')
                    ->label(__('filament.resources.products.fields.stock_quantity'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('low_stock_threshold')
                    ->label(__('filament.resources.products.fields.low_stock_threshold'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('weight')
                    ->label(__('filament.resources.products.fields.weight'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('unit_of_measure')
                    ->label(__('filament.resources.products.fields.unit_of_measure'))
                    ->searchable(),
                TextColumn::make('expiration_date')
                    ->label(__('filament.resources.products.fields.expiration_date'))
                    ->date()
                    ->sortable(),
                ImageColumn::make('image_path')
                    ->label(__('filament.resources.products.fields.image_path')),
                IconColumn::make('is_active')
                    ->label(__('filament.resources.products.fields.is_active'))
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->label(__('filament.resources.products.fields.is_featured'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('filament.resources.products.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.resources.products.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.products.fields.deleted_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
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
