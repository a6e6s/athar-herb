<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            "all" => Tab::make(__('All Products'))
                ->label(__('filament.resources.orders.filters.all_orders'))
                ->badge(fn() => \App\Models\Order::count()),

            "pending" => Tab::make(__('All Products'))
                ->label(__('filament.resources.orders.status.pending'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'pending'))
                ->badge(fn() => \App\Models\Order::where('status', 'pending')->count())
                ->badgeColor('warning'),

            "processing" => Tab::make(__('All Products'))
                ->label(__('filament.resources.orders.status.processing'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'processing'))
                ->badge(fn() => \App\Models\Order::where('status', 'processing')->count())
                ->badgeColor('info'),

            "shipped" => Tab::make(__('All Products'))
                ->label(__('filament.resources.orders.status.shipped'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'shipped'))
                ->badge(fn() => \App\Models\Order::where('status', 'shipped')->count())
                ->badgeColor('primary'),

            "delivered" => Tab::make(__('All Products'))
                ->label(__('filament.resources.orders.status.delivered'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'delivered'))
                ->badge(fn() => \App\Models\Order::where('status', 'delivered')->count())
                ->badgeColor('success'),

            "cancelled" => Tab::make(__('All Products'))
                ->label(__('filament.resources.orders.status.cancelled'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'cancelled'))
                ->badge(fn() => \App\Models\Order::where('status', 'cancelled')->count())
                ->badgeColor('danger'),
        ];
    }
}
