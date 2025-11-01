<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.resources.categories.fields.name'))
                    ->required(),
                TextInput::make('slug')
                    ->label(__('filament.resources.categories.fields.slug'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('filament.resources.categories.fields.description'))
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('parent_id')
                    ->label(__('filament.resources.categories.fields.parent_id'))
                    ->relationship('parent', 'name')
                    ->default(null),
                Toggle::make('is_active')
                    ->label(__('filament.resources.categories.fields.is_active'))
                    ->required(),
            ]);
    }
}
