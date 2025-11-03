<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('filament.widgets.quick_actions.heading') }}
        </x-slot>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            {{-- Pending Orders --}}
            <a href="{{ route('filament.admin.resources.orders.index', ['tableFilters[status][value]' => 'pending']) }}"
               class="relative overflow-hidden rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 p-6 text-white shadow-lg transition hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">{{ __('filament.widgets.quick_actions.pending_orders') }}</p>
                        <p class="mt-2 text-3xl font-bold">{{ $pendingOrders }}</p>
                    </div>
                    <div class="rounded-full bg-white/20 p-3">
                        {{-- @svg('heroicon-o-clock', 'h-1 w-1') --}}
                    </div>
                </div>
            </a>

            {{-- Low Stock Products --}}
            <a href="{{ route('filament.admin.resources.products.index', ['tableFilters[stock_status][value]' => 'low']) }}"
               class="relative overflow-hidden rounded-lg bg-gradient-to-br from-red-500 to-red-600 p-6 text-white shadow-lg transition hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">{{ __('filament.widgets.quick_actions.low_stock') }}</p>
                        <p class="mt-2 text-3xl font-bold">{{ $lowStockProducts }}</p>
                    </div>
                    <div class="rounded-full bg-white/20 p-3">
                        {{-- @svg('heroicon-o-exclamation-triangle', 'h-1 w-1') --}}
                    </div>
                </div>
            </a>

            {{-- New Customers Today --}}
            <a href="{{ route('filament.admin.resources.users.index') }}"
               class="relative overflow-hidden rounded-lg bg-gradient-to-br from-green-500 to-green-600 p-6 text-white shadow-lg transition hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">{{ __('filament.widgets.quick_actions.new_customers') }}</p>
                        <p class="mt-2 text-3xl font-bold">{{ $newCustomersToday }}</p>
                    </div>
                    <div class="rounded-full bg-white/20 p-3">
                        {{-- @svg('heroicon-o-user-plus', 'h-1 w-1') --}}
                    </div>
                </div>
            </a>

            {{-- Completed Orders Today --}}
            <a href="{{ route('filament.admin.resources.orders.index', ['tableFilters[status][value]' => 'completed']) }}"
               class="relative overflow-hidden rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white shadow-lg transition hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium opacity-90">{{ __('filament.widgets.quick_actions.completed_today') }}</p>
                        <p class="mt-2 text-3xl font-bold">{{ $completedOrdersToday }}</p>
                    </div>
                    <div class="rounded-full bg-white/20 p-3">
                        {{-- @svg('heroicon-o-check-circle', 'h-1 w-1') --}}
                    </div>
                </div>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
