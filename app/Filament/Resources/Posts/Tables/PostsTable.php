<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label(__('filament.resources.posts.fields.featured_image'))
                    ->disk('public')
                    ->defaultImageUrl(fn($record) => $record->featured_image ? asset('storage/' . $record->featured_image) : url('/images/placeholder.png'))
                    ->size(60)
                    ->circular(),

                TextColumn::make('title')
                    ->label(__('filament.resources.posts.fields.title'))
                    ->searchable(['title', 'title_ar'])
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-m-document-text')
                    ->description(fn ($record) => $record->excerpt ?? $record->excerpt_ar)
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('user.name')
                    ->label(__('filament.resources.posts.fields.author'))
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-user')
                    ->badge()
                    ->color('info')
                    ->toggleable(),

                ToggleColumn::make('is_published')
                    ->label(__('filament.resources.posts.fields.is_published'))
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('published_at')
                    ->label(__('filament.resources.posts.fields.published_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-calendar')
                    ->description(fn ($record) => $record->published_at?->format('Y-m-d H:i'))
                    ->placeholder(__('filament.resources.posts.badges.not_published'))
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label(__('filament.resources.posts.fields.created_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-clock')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('filament.resources.posts.fields.updated_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.posts.fields.deleted_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label(__('filament.resources.posts.filters.author'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false),

                SelectFilter::make('is_published')
                    ->label(__('filament.resources.posts.filters.publish_status'))
                    ->options([
                        '1' => __('filament.resources.posts.badges.published'),
                        '0' => __('filament.resources.posts.badges.draft'),
                    ])
                    ->native(false),

                Filter::make('published_this_month')
                    ->label(__('filament.resources.posts.filters.published_this_month'))
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('published_at')
                              ->whereMonth('published_at', now()->month)
                              ->whereYear('published_at', now()->year)
                    )
                    ->toggle(),

                Filter::make('published_this_week')
                    ->label(__('filament.resources.posts.filters.published_this_week'))
                    ->query(fn (Builder $query): Builder =>
                        $query->whereNotNull('published_at')
                              ->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()])
                    )
                    ->toggle(),

                TrashedFilter::make()
                    ->label(__('filament.resources.posts.filters.trashed')),
            ], layout: FiltersLayout::Dropdown)
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament.resources.posts.actions.view'))
                    ->icon('heroicon-m-eye'),
                EditAction::make()
                    ->label(__('filament.resources.posts.actions.edit'))
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament.resources.posts.actions.delete'))
                        ->icon('heroicon-m-trash'),
                    ForceDeleteBulkAction::make()
                        ->label(__('filament.resources.posts.actions.force_delete'))
                        ->icon('heroicon-m-trash'),
                    RestoreBulkAction::make()
                        ->label(__('filament.resources.posts.actions.restore'))
                        ->icon('heroicon-m-arrow-path'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->emptyStateHeading(__('filament.resources.posts.empty_state.heading'))
            ->emptyStateDescription(__('filament.resources.posts.empty_state.description'))
            ->emptyStateIcon('heroicon-o-document-text');
    }
}
