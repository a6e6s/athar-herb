<?php

namespace App\Filament\Resources\Testimonials\Pages;

use App\Filament\Resources\Testimonials\TestimonialResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('filament.resources.testimonials.tabs.all_testimonials'))
                ->icon('heroicon-o-chat-bubble-left-right')
                ->badge(fn () => \App\Models\Testimonial::count()),

            'approved' => Tab::make(__('filament.resources.testimonials.tabs.approved'))
                ->icon('heroicon-o-check-circle')
                ->badge(fn () => \App\Models\Testimonial::where('is_approved', true)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', true)),

            'pending' => Tab::make(__('filament.resources.testimonials.tabs.pending'))
                ->icon('heroicon-o-clock')
                ->badge(fn () => \App\Models\Testimonial::where('is_approved', false)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', false)),

            'high_rated' => Tab::make(__('filament.resources.testimonials.tabs.high_rated'))
                ->icon('heroicon-o-star')
                ->badge(fn () => \App\Models\Testimonial::where('rating', '>=', 4)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('rating', '>=', 4)),

            'this_week' => Tab::make(__('filament.resources.testimonials.tabs.this_week'))
                ->icon('heroicon-o-calendar')
                ->badge(fn () => \App\Models\Testimonial::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count())
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])),

            'this_month' => Tab::make(__('filament.resources.testimonials.tabs.this_month'))
                ->icon('heroicon-o-calendar-days')
                ->badge(fn () => \App\Models\Testimonial::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count())
                ->badgeColor('primary')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)),
        ];
    }
}
