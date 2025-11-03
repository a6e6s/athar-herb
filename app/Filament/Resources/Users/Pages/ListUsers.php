<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('filament.resources.users.tabs.all_users'))
                ->icon('heroicon-o-user-group')
                ->badge(fn () => \App\Models\User::count()),

            'verified' => Tab::make(__('filament.resources.users.tabs.verified'))
                ->icon('heroicon-o-check-badge')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('email_verified_at'))
                ->badge(fn () => \App\Models\User::whereNotNull('email_verified_at')->count())
                ->badgeColor('success'),

            'unverified' => Tab::make(__('filament.resources.users.tabs.unverified'))
                ->icon('heroicon-o-x-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('email_verified_at'))
                ->badge(fn () => \App\Models\User::whereNull('email_verified_at')->count())
                ->badgeColor('danger'),

            'this_week' => Tab::make(__('filament.resources.users.tabs.this_week'))
                ->icon('heroicon-o-calendar')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]))
                ->badge(fn () => \App\Models\User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count())
                ->badgeColor('info'),

            'this_month' => Tab::make(__('filament.resources.users.tabs.this_month'))
                ->icon('heroicon-o-calendar-days')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereMonth('created_at', now()->month))
                ->badge(fn () => \App\Models\User::whereMonth('created_at', now()->month)->count())
                ->badgeColor('warning'),
        ];
    }
}
