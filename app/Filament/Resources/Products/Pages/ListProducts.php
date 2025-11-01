<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
     {
        return [
            'all' => Tab::make(__('All Products'))
                ->icon('heroicon-m-squares-2x2')
                ->badge(fn () => ProductResource::getModel()::count()),

            'active' => Tab::make(__('Active'))
                ->icon('heroicon-m-check-circle')
                ->badge(fn () => ProductResource::getModel()::where('is_active', true)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true)),

            'inactive' => Tab::make(__('Inactive'))
                ->icon('heroicon-m-x-circle')
                ->badge(fn () => ProductResource::getModel()::where('is_active', false)->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false)),

            'featured' => Tab::make(__('Featured'))
                ->icon('heroicon-m-star')
                ->badge(fn () => ProductResource::getModel()::where('is_featured', true)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_featured', true)),

            'low_stock' => Tab::make(__('Low Stock'))
                ->icon('heroicon-m-exclamation-triangle')
                ->badge(fn () => ProductResource::getModel()::whereColumn('stock_quantity', '<=', 'low_stock_threshold')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->whereColumn('stock_quantity', '<=', 'low_stock_threshold')
                ),

            'out_of_stock' => Tab::make(__('Out of Stock'))
                ->icon('heroicon-m-x-circle')
                ->badge(fn () => ProductResource::getModel()::where('stock_quantity', 0)->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('stock_quantity', 0)),

            'expired' => Tab::make(__('Expired'))
                ->icon('heroicon-m-calendar-days')
                ->badge(fn () => ProductResource::getModel()::whereNotNull('expiration_date')
                    ->where('expiration_date', '<', now())->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->whereNotNull('expiration_date')
                        ->where('expiration_date', '<', now())
                ),
        ];
    }
}
