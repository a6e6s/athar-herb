<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('filament.resources.posts.tabs.all_posts'))
                ->icon('heroicon-o-document-text')
                ->badge(fn () => \App\Models\Post::count()),

            'published' => Tab::make(__('filament.resources.posts.tabs.published'))
                ->icon('heroicon-o-check-circle')
                ->badge(fn () => \App\Models\Post::where('is_published', true)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_published', true)),

            'draft' => Tab::make(__('filament.resources.posts.tabs.draft'))
                ->icon('heroicon-o-document')
                ->badge(fn () => \App\Models\Post::where('is_published', false)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_published', false)),

            'this_week' => Tab::make(__('filament.resources.posts.tabs.this_week'))
                ->icon('heroicon-o-calendar')
                ->badge(fn () => \App\Models\Post::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count())
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])),

            'this_month' => Tab::make(__('filament.resources.posts.tabs.this_month'))
                ->icon('heroicon-o-calendar-days')
                ->badge(fn () => \App\Models\Post::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count())
                ->badgeColor('primary')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)),
        ];
    }
}
