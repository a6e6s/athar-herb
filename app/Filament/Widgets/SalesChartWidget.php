<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class SalesChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 2;

    public ?string $filter = 'week';

    public function getHeading(): string | \Illuminate\Contracts\Support\Htmlable | null
    {
        return __('filament.widgets.sales_chart.heading');
    }

    protected function getData(): array
    {
        $data = match ($this->filter) {
            'today' => $this->getDataForToday(),
            'week' => $this->getDataForWeek(),
            'month' => $this->getDataForMonth(),
            'year' => $this->getDataForYear(),
            default => $this->getDataForWeek(),
        };

        return [
            'datasets' => [
                [
                    'label' => __('filament.widgets.sales_chart.revenue'),
                    'data' => $data['values'],
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => __('filament.widgets.sales_chart.filters.today'),
            'week' => __('filament.widgets.sales_chart.filters.week'),
            'month' => __('filament.widgets.sales_chart.filters.month'),
            'year' => __('filament.widgets.sales_chart.filters.year'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getDataForToday(): array
    {
        $labels = [];
        $values = [];

        for ($hour = 0; $hour < 24; $hour++) {
            $labels[] = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
            $revenue = Order::where('status', 'completed')
                ->whereDate('created_at', today())
                ->whereRaw('HOUR(created_at) = ?', [$hour])
                ->sum('total_amount');
            $values[] = round($revenue, 2);
        }

        return compact('labels', 'values');
    }

    private function getDataForWeek(): array
    {
        $labels = [];
        $values = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('D');
            $revenue = Order::where('status', 'completed')
                ->whereDate('created_at', $date)
                ->sum('total_amount');
            $values[] = round($revenue, 2);
        }

        return compact('labels', 'values');
    }

    private function getDataForMonth(): array
    {
        $labels = [];
        $values = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('M d');
            $revenue = Order::where('status', 'completed')
                ->whereDate('created_at', $date)
                ->sum('total_amount');
            $values[] = round($revenue, 2);
        }

        return compact('labels', 'values');
    }

    private function getDataForYear(): array
    {
        $labels = [];
        $values = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->format('M Y');
            $revenue = Order::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_amount');
            $values[] = round($revenue, 2);
        }

        return compact('labels', 'values');
    }
}
