<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextEntry::make('name')
                    ->label(__('filament.resources.categories.fields.name'))
                    ->weight('bold')
                    ->size('lg')
                    ->color('primary')
                    ->icon('heroicon-m-tag')
                    ->columnSpan(2),

                IconEntry::make('is_active')
                    ->label(__('filament.resources.categories.fields.is_active'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->columnSpan(1),

                TextEntry::make('name_ar')
                    ->label(__('filament.resources.categories.fields.name_ar'))
                    ->icon('heroicon-m-language')
                    ->color('gray')
                    ->placeholder('-')
                    ->columnSpan(2),

                TextEntry::make('slug')
                    ->label(__('filament.resources.categories.fields.slug'))
                    ->copyable()
                    ->icon('heroicon-m-link')
                    ->color('gray')
                    ->columnSpan(1),

                TextEntry::make('description')
                    ->label(__('filament.resources.categories.fields.description'))
                    ->html()
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('description_ar')
                    ->label(__('filament.resources.categories.fields.description_ar'))
                    ->html()
                    ->placeholder('-')
                    ->icon('heroicon-m-language')
                    ->columnSpanFull(),

                TextEntry::make('parent.name')
                    ->label(__('filament.resources.categories.fields.parent_id'))
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-arrow-up-circle')
                    ->placeholder(__('filament.resources.categories.badges.parent')),

                TextEntry::make('products_count')
                    ->label(__('filament.resources.categories.fields.products_count'))
                    ->state(fn ($record) => $record->products()->count())
                    ->badge()
                    ->color(fn ($record): string => match (true) {
                        $record->products()->count() === 0 => 'gray',
                        $record->products()->count() < 5 => 'warning',
                        default => 'success',
                    })
                    ->icon('heroicon-m-cube'),

                TextEntry::make('category_type')
                    ->label('Type')
                    ->badge()
                    ->state(fn ($record) => $record->parent_id
                        ? __('filament.resources.categories.badges.subcategory')
                        : __('filament.resources.categories.badges.parent'))
                    ->color(fn ($record) => $record->parent_id ? 'warning' : 'success')
                    ->icon(fn ($record) => $record->parent_id ? 'heroicon-m-arrow-down-circle' : 'heroicon-m-check-badge'),

                TextEntry::make('created_at')
                    ->label(__('filament.resources.categories.fields.created_at'))
                    ->dateTime()
                    ->since()
                    ->icon('heroicon-m-plus-circle')
                    ->color('success'),

                TextEntry::make('updated_at')
                    ->label(__('filament.resources.categories.fields.updated_at'))
                    ->dateTime()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->color('warning'),

                TextEntry::make('deleted_at')
                    ->label(__('filament.resources.categories.fields.deleted_at'))
                    ->dateTime()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->visible(fn (Category $record): bool => $record->trashed()),
            ]);
    }
}
