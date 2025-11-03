<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderItem;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Calculate revenue statistics
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $todayRevenue = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');
        $lastMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_amount');
        $thisMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $revenueChange = $lastMonthRevenue > 0
            ? (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;

        // Calculate order statistics
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', today())->count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Calculate customer statistics
        $totalCustomers = User::where('user_type', 'customer')->count();
        $newCustomersThisMonth = User::where('user_type', 'customer')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonthCustomers = User::where('user_type', 'customer')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $customerChange = $lastMonthCustomers > 0
            ? (($newCustomersThisMonth - $lastMonthCustomers) / $lastMonthCustomers) * 100
            : 0;

        // Calculate product statistics
        $totalProducts = Product::where('is_active', true)->count();
        $lowStockProducts = Product::where('stock_quantity', '<=', 10)
            ->where('stock_quantity', '>', 0)
            ->count();
        $outOfStockProducts = Product::where('stock_quantity', 0)->count();

        return [
            Stat::make(__('filament.widgets.stats.total_revenue'), number_format($totalRevenue, 2) . ' ' . __('filament.widgets.stats.currency'))
                ->description(__('filament.widgets.stats.today') . ': ' . number_format($todayRevenue, 2) . ' ' . __('filament.widgets.stats.currency'))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make(__('filament.widgets.stats.total_orders'), $totalOrders)
                ->description(__('filament.widgets.stats.pending') . ': ' . $pendingOrders)
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary')
                ->chart([15, 4, 10, 2, 12, 4, 12]),

            Stat::make(__('filament.widgets.stats.total_customers'), $totalCustomers)
                ->description(
                    ($customerChange >= 0 ? '+' : '') .
                    number_format($customerChange, 1) . '% ' .
                    __('filament.widgets.stats.from_last_month')
                )
                ->descriptionIcon($customerChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($customerChange >= 0 ? 'success' : 'danger'),

            Stat::make(__('filament.widgets.stats.active_products'), $totalProducts)
                ->description(__('filament.widgets.stats.low_stock') . ': ' . $lowStockProducts)
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}
