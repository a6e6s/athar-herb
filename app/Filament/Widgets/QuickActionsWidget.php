<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected string $view = 'filament.widgets.quick-actions';
    protected static ?int $sort = 7;
    protected int | string | array $columnSpan = 2;

    public function getViewData(): array
    {
        return [
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'lowStockProducts' => Product::where('stock_quantity', '<=', 10)->count(),
            'newCustomersToday' => User::where('user_type', 'customer')
                ->whereDate('created_at', today())
                ->count(),
            'completedOrdersToday' => Order::where('status', 'completed')
                ->whereDate('created_at', today())
                ->count(),
        ];
    }
}
