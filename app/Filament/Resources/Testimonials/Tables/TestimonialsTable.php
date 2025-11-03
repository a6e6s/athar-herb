<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label(__('filament.resources.testimonials.fields.avatar'))
                    ->disk('public')
                    ->defaultImageUrl(fn($record) => $record->avatar ? asset('storage/' . $record->avatar) : url('/images/placeholder.png'))
                    ->size(50)
                    ->circular(),

                TextColumn::make('name')
                    ->label(__('filament.resources.testimonials.fields.name'))
                    ->searchable(['name', 'name_ar'])
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-m-user')
                    ->description(fn ($record) => $record->role ?? $record->role_ar)
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('content')
                    ->label(__('filament.resources.testimonials.fields.content'))
                    ->limit(100)
                    ->wrap()
                    ->searchable(['content', 'content_ar'])
                    ->toggleable(),

                TextColumn::make('rating')
                    ->label(__('filament.resources.testimonials.fields.rating'))
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-m-star')
                    ->color(fn ($state) => match (true) {
                        $state >= 4 => 'success',
                        $state >= 3 => 'warning',
                        default => 'danger',
                    })
                    ->badge(),

                IconColumn::make('is_approved')
                    ->label(__('filament.resources.testimonials.fields.is_approved'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('sort_order')
                    ->label(__('filament.resources.testimonials.fields.sort_order'))
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-m-bars-3-bottom-left')
                    ->badge()
                    ->color('info')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label(__('filament.resources.testimonials.fields.created_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-clock')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('filament.resources.testimonials.fields.updated_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label(__('filament.resources.testimonials.fields.deleted_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_approved')
                    ->label(__('filament.resources.testimonials.filters.approval_status'))
                    ->options([
                        '1' => __('filament.resources.testimonials.badges.approved'),
                        '0' => __('filament.resources.testimonials.badges.pending'),
                    ])
                    ->native(false),

                SelectFilter::make('rating')
                    ->label(__('filament.resources.testimonials.filters.rating'))
                    ->options([
                        '5' => '5 ' . __('filament.resources.testimonials.badges.stars'),
                        '4' => '4 ' . __('filament.resources.testimonials.badges.stars'),
                        '3' => '3 ' . __('filament.resources.testimonials.badges.stars'),
                        '2' => '2 ' . __('filament.resources.testimonials.badges.stars'),
                        '1' => '1 ' . __('filament.resources.testimonials.badges.star'),
                    ])
                    ->native(false),

                Filter::make('created_this_month')
                    ->label(__('filament.resources.testimonials.filters.created_this_month'))
                    ->query(fn (Builder $query): Builder => $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year))
                    ->toggle(),

                Filter::make('created_this_week')
                    ->label(__('filament.resources.testimonials.filters.created_this_week'))
                    ->query(fn (Builder $query): Builder => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]))
                    ->toggle(),

                TrashedFilter::make()
                    ->label(__('filament.resources.testimonials.filters.trashed')),
            ], layout: FiltersLayout::Dropdown)
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament.resources.testimonials.actions.view'))
                    ->icon('heroicon-m-eye'),
                EditAction::make()
                    ->label(__('filament.resources.testimonials.actions.edit'))
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament.resources.testimonials.actions.delete'))
                        ->icon('heroicon-m-trash'),
                    ForceDeleteBulkAction::make()
                        ->label(__('filament.resources.testimonials.actions.force_delete'))
                        ->icon('heroicon-m-trash'),
                    RestoreBulkAction::make()
                        ->label(__('filament.resources.testimonials.actions.restore'))
                        ->icon('heroicon-m-arrow-path'),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->striped()
            ->emptyStateHeading(__('filament.resources.testimonials.empty_state.heading'))
            ->emptyStateDescription(__('filament.resources.testimonials.empty_state.description'))
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right');
    }
}
