<?php

namespace App\Filament\Resources\Pages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament.resources.pages.fields.title'))
                    ->searchable(['title', 'title_ar'])
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-m-document')
                    ->description(fn ($record) => $record->slug)
                    ->limit(50)
                    ->wrap(),

                ToggleColumn::make('is_published')
                    ->label(__('filament.resources.pages.fields.is_published'))
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('published_at')
                    ->label(__('filament.resources.pages.fields.published_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-calendar')
                    ->description(fn ($record) => $record->published_at?->format('Y-m-d H:i'))
                    ->placeholder(__('filament.resources.pages.badges.not_published'))
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label(__('filament.resources.pages.fields.created_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-clock')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('filament.resources.pages.fields.updated_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.pages.fields.deleted_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_published')
                    ->label(__('filament.resources.pages.filters.publish_status'))
                    ->options([
                        '1' => __('filament.resources.pages.badges.published'),
                        '0' => __('filament.resources.pages.badges.draft'),
                    ])
                    ->native(false),

                Filter::make('published_this_month')
                    ->label(__('filament.resources.pages.filters.published_this_month'))
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('published_at')
                              ->whereMonth('published_at', now()->month)
                              ->whereYear('published_at', now()->year)
                    )
                    ->toggle(),

                Filter::make('published_this_week')
                    ->label(__('filament.resources.pages.filters.published_this_week'))
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('published_at')
                              ->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()])
                    )
                    ->toggle(),

                TrashedFilter::make()
                    ->label(__('filament.resources.pages.filters.trashed')),
            ], layout: FiltersLayout::Dropdown)
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament.resources.pages.actions.view'))
                    ->icon('heroicon-m-eye'),
                EditAction::make()
                    ->label(__('filament.resources.pages.actions.edit'))
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament.resources.pages.actions.delete'))
                        ->icon('heroicon-m-trash'),
                    ForceDeleteBulkAction::make()
                        ->label(__('filament.resources.pages.actions.force_delete'))
                        ->icon('heroicon-m-trash'),
                    RestoreBulkAction::make()
                        ->label(__('filament.resources.pages.actions.restore'))
                        ->icon('heroicon-m-arrow-path'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->emptyStateHeading(__('filament.resources.pages.empty_state.heading'))
            ->emptyStateDescription(__('filament.resources.pages.empty_state.description'))
            ->emptyStateIcon('heroicon-o-document');
    }
}
