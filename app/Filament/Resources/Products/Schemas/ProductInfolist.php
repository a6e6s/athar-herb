<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                // Product Image
                ImageEntry::make('image_path')
                    ->label(__('filament.resources.products.fields.image_path'))
                    ->defaultImageUrl(url('/images/placeholder-product.png'))
                    ->columnSpan(1),

                // Product Basic Info
                TextEntry::make('name')
                    ->label(__('filament.resources.products.fields.name'))
                    ->weight('bold')
                    ->size('lg')
                    ->color('primary')
                    ->columnSpan(2),

                TextEntry::make('category.name')
                    ->label(__('filament.resources.products.fields.category_id'))
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-tag'),

                TextEntry::make('sku')
                    ->label(__('filament.resources.products.fields.sku'))
                    ->copyable()
                    ->icon('heroicon-m-clipboard-document')
                    ->color('gray'),

                TextEntry::make('slug')
                    ->label(__('filament.resources.products.fields.slug'))
                    ->copyable()
                    ->icon('heroicon-m-link')
                    ->color('gray'),

                IconEntry::make('is_active')
                    ->label(__('filament.resources.products.fields.is_active'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                IconEntry::make('is_featured')
                    ->label(__('filament.resources.products.fields.is_featured'))
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                // Descriptions
                TextEntry::make('short_description')
                    ->label(__('filament.resources.products.fields.short_description'))
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('description')
                    ->label(__('filament.resources.products.fields.description'))
                    ->html()
                    ->columnSpanFull(),

                // Pricing
                TextEntry::make('price')
                    ->label(__('filament.resources.products.fields.price'))
                    ->money('USD')
                    ->weight('bold')
                    ->size('lg')
                    ->color('success')
                    ->icon('heroicon-m-currency-dollar'),

                TextEntry::make('cost_price')
                    ->label(__('filament.resources.products.fields.cost_price'))
                    ->money('USD')
                    ->placeholder('-')
                    ->icon('heroicon-m-calculator')
                    ->color('gray'),

                TextEntry::make('profit_margin')
                    ->label(__('filament.resources.products.fields.profit_margin'))
                    ->state(function ($record) {
                        if ($record->cost_price && $record->price > 0) {
                            $margin = (($record->price - $record->cost_price) / $record->price) * 100;
                            return number_format($margin, 1) . '%';
                        }
                        return '-';
                    })
                    ->badge()
                    ->color(fn ($record) => match(true) {
                        !$record->cost_price => 'gray',
                        (($record->price - $record->cost_price) / $record->price) * 100 >= 30 => 'success',
                        (($record->price - $record->cost_price) / $record->price) * 100 >= 15 => 'warning',
                        default => 'danger',
                    })
                    ->icon('heroicon-m-chart-bar'),

                // Inventory
                TextEntry::make('stock_quantity')
                    ->label(__('filament.resources.products.fields.stock_quantity'))
                    ->numeric()
                    ->badge()
                    ->color(fn ($record) => match(true) {
                        $record->stock_quantity == 0 => 'danger',
                        $record->stock_quantity <= $record->low_stock_threshold => 'warning',
                        default => 'success',
                    })
                    ->icon(fn ($record) => match(true) {
                        $record->stock_quantity == 0 => 'heroicon-m-x-circle',
                        $record->stock_quantity <= $record->low_stock_threshold => 'heroicon-m-exclamation-triangle',
                        default => 'heroicon-m-check-circle',
                    }),

                TextEntry::make('low_stock_threshold')
                    ->label(__('filament.resources.products.fields.low_stock_threshold'))
                    ->numeric()
                    ->icon('heroicon-m-exclamation-triangle')
                    ->color('warning'),

                TextEntry::make('weight')
                    ->label(__('filament.resources.products.fields.weight'))
                    ->numeric()
                    ->suffix(' kg')
                    ->placeholder('-')
                    ->icon('heroicon-m-scale')
                    ->color('gray'),

                TextEntry::make('unit_of_measure')
                    ->label(__('filament.resources.products.fields.unit_of_measure'))
                    ->placeholder('-')
                    ->badge()
                    ->color('gray'),

                TextEntry::make('expiration_date')
                    ->label(__('filament.resources.products.fields.expiration_date'))
                    ->date()
                    ->placeholder('-')
                    ->icon('heroicon-m-calendar')
                    ->color(fn ($record) => $record->expiration_date && $record->expiration_date->isPast() ? 'danger' : 'gray')
                    ->columnSpan(2),

                // Additional Images
                ImageEntry::make('secondary_images')
                    ->label(__('filament.resources.products.fields.secondary_images'))
                    ->placeholder('-')
                    ->columnSpanFull(),

                // Timestamps
                TextEntry::make('created_at')
                    ->label(__('filament.resources.products.fields.created_at'))
                    ->dateTime()
                    ->since()
                    ->icon('heroicon-m-plus-circle')
                    ->color('success'),

                TextEntry::make('updated_at')
                    ->label(__('filament.resources.products.fields.updated_at'))
                    ->dateTime()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->color('warning'),

                TextEntry::make('deleted_at')
                    ->label(__('filament.resources.products.fields.deleted_at'))
                    ->dateTime()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->visible(fn (Product $record): bool => $record->trashed()),
            ]);
    }
}
