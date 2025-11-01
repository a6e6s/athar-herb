<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.resources.categories.fields.name'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-m-tag')
                    ->description(fn ($record) => $record->slug),

                TextColumn::make('name_ar')
                    ->label(__('filament.resources.categories.fields.name_ar'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->icon('heroicon-m-language'),

                TextColumn::make('parent.name')
                    ->label(__('filament.resources.categories.fields.parent_id'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-arrow-up-circle')
                    ->placeholder(__('filament.resources.categories.badges.parent'))
                    ->tooltip(fn ($record) => $record->parent_id
                        ? __('filament.resources.categories.badges.subcategory')
                        : __('filament.resources.categories.badges.parent')),

                TextColumn::make('products_count')
                    ->label(__('filament.resources.categories.fields.products_count'))
                    ->counts('products')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'gray',
                        $state < 5 => 'warning',
                        default => 'success',
                    })
                    ->icon('heroicon-m-cube')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label(__('filament.resources.categories.fields.is_active'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable()
                    ->tooltip(fn ($record) => $record->is_active
                        ? __('filament.resources.categories.badges.active')
                        : __('filament.resources.categories.badges.inactive')),

                TextColumn::make('created_at')
                    ->label(__('filament.resources.categories.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-clock')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('filament.resources.categories.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.categories.fields.deleted_at'))
                    ->dateTime()
                    ->sortable()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make()
                    ->label(__('filament.resources.categories.filters.trashed')),

                SelectFilter::make('parent_id')
                    ->label(__('filament.resources.categories.fields.parent_id'))
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple(),

                TernaryFilter::make('is_active')
                    ->label(__('filament.resources.categories.fields.is_active'))
                    ->placeholder(__('filament.resources.categories.filters.active') . ' & ' . __('filament.resources.categories.filters.inactive'))
                    ->trueLabel(__('filament.resources.categories.filters.active'))
                    ->falseLabel(__('filament.resources.categories.filters.inactive'))
                    ->native(false),

                TernaryFilter::make('has_products')
                    ->label(__('filament.resources.categories.filters.has_products'))
                    ->queries(
                        true: fn ($query) => $query->has('products'),
                        false: fn ($query) => $query->doesntHave('products'),
                    )
                    ->native(false),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament.resources.categories.actions.view')),
                EditAction::make()
                    ->label(__('filament.resources.categories.actions.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament.resources.categories.actions.delete')),
                    ForceDeleteBulkAction::make()
                        ->label(__('filament.resources.categories.actions.force_delete')),
                    RestoreBulkAction::make()
                        ->label(__('filament.resources.categories.actions.restore')),
                ]),
            ]);
    }
}
