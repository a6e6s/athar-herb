<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label(__('filament.resources.products.fields.category_id'))
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('name')
                    ->label(__('filament.resources.products.fields.name'))
                    ->required(),
                TextInput::make('slug')
                    ->label(__('filament.resources.products.fields.slug'))
                    ->required(),
                Textarea::make('short_description')
                    ->label(__('filament.resources.products.fields.short_description'))
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label(__('filament.resources.products.fields.description'))
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label(__('filament.resources.products.fields.price'))
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('cost_price')
                    ->label(__('filament.resources.products.fields.cost_price'))
                    ->numeric()
                    ->default(null),
                TextInput::make('sku')
                    ->label(__('filament.resources.products.fields.sku'))
                    ->required(),
                TextInput::make('stock_quantity')
                    ->label(__('filament.resources.products.fields.stock_quantity'))
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('low_stock_threshold')
                    ->label(__('filament.resources.products.fields.low_stock_threshold'))
                    ->required()
                    ->numeric()
                    ->default(5),
                TextInput::make('weight')
                    ->label(__('filament.resources.products.fields.weight'))
                    ->numeric()
                    ->default(null),
                TextInput::make('unit_of_measure')
                    ->label(__('filament.resources.products.fields.unit_of_measure'))
                    ->default(null),
                DatePicker::make('expiration_date')
                    ->label(__('filament.resources.products.fields.expiration_date')),
                FileUpload::make('image_path')
                    ->label(__('filament.resources.products.fields.image_path'))
                    ->image(),
                Textarea::make('secondary_images')
                    ->label(__('filament.resources.products.fields.secondary_images'))
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label(__('filament.resources.products.fields.is_active'))
                    ->required(),
                Toggle::make('is_featured')
                    ->label(__('filament.resources.products.fields.is_featured'))
                    ->required(),
            ]);
    }
}
