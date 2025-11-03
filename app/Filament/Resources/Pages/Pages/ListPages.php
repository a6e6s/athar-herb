<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('filament.resources.pages.tabs.all_pages'))
                ->icon('heroicon-o-document')
                ->badge(fn () => \App\Models\Page::count()),

            'published' => Tab::make(__('filament.resources.pages.tabs.published'))
                ->icon('heroicon-o-check-circle')
                ->badge(fn () => \App\Models\Page::where('is_published', true)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_published', true)),

            'draft' => Tab::make(__('filament.resources.pages.tabs.draft'))
                ->icon('heroicon-o-document-text')
                ->badge(fn () => \App\Models\Page::where('is_published', false)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_published', false)),

            'this_week' => Tab::make(__('filament.resources.pages.tabs.this_week'))
                ->icon('heroicon-o-calendar')
                ->badge(fn () => \App\Models\Page::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count())
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])),

            'this_month' => Tab::make(__('filament.resources.pages.tabs.this_month'))
                ->icon('heroicon-o-calendar-days')
                ->badge(fn () => \App\Models\Page::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count())
                ->badgeColor('primary')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)),
        ];
    }
}
