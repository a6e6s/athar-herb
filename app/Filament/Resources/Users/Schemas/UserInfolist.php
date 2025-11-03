<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // User Overview Section
                Section::make(__('filament.resources.users.sections.user_overview'))
                    ->description(__('filament.resources.users.sections.user_overview_desc'))
                    ->icon('heroicon-o-user-circle')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('filament.resources.users.fields.name'))
                            ->weight('bold')
                            ->size('lg')
                            ->color('primary')
                            ->icon('heroicon-m-user')
                            ->columnSpan(2),

                        IconEntry::make('email_verified_at')
                            ->label(__('filament.resources.users.fields.status'))
                            ->boolean()
                            ->trueIcon('heroicon-o-check-badge')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger')
                            ->columnSpan(1),

                        TextEntry::make('email')
                            ->label(__('filament.resources.users.fields.email'))
                            ->copyable()
                            ->copyMessage(__('filament.resources.users.messages.email_copied'))
                            ->copyMessageDuration(1500)
                            ->icon('heroicon-m-envelope')
                            ->color('gray')
                            ->columnSpan(3),
                    ]),

                // Account Information Section
                Section::make(__('filament.resources.users.sections.account_info'))
                    ->description(__('filament.resources.users.sections.account_info_desc'))
                    ->icon('heroicon-o-shield-check')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('email_verified_at')
                            ->label(__('filament.resources.users.fields.email_verified_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->since()
                            ->placeholder(__('filament.resources.users.badges.unverified'))
                            ->icon('heroicon-m-check-badge')
                            ->color(fn ($record) => $record->email_verified_at ? 'success' : 'danger')
                            ->badge()
                            ->columnSpan(1),

                        TextEntry::make('created_at')
                            ->label(__('filament.resources.users.fields.created_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->since()
                            ->icon('heroicon-m-calendar-days')
                            ->color('success')
                            ->badge()
                            ->columnSpan(1),

                        TextEntry::make('updated_at')
                            ->label(__('filament.resources.users.fields.updated_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->since()
                            ->icon('heroicon-m-pencil-square')
                            ->color('warning')
                            ->badge()
                            ->columnSpan(1),
                    ]),

                // System Information Section  
                Section::make(__('filament.resources.users.sections.system_info'))
                    ->description(__('filament.resources.users.sections.system_info_desc'))
                    ->icon('heroicon-o-computer-desktop')
                    ->columns(3)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('id')
                            ->label(__('filament.resources.users.fields.id'))
                            ->badge()
                            ->color('gray')
                            ->icon('heroicon-m-hashtag')
                            ->columnSpan(1),

                        TextEntry::make('deleted_at')
                            ->label(__('filament.resources.users.fields.deleted_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->icon('heroicon-m-trash')
                            ->color('danger')
                            ->badge()
                            ->visible(fn (User $record): bool => $record->trashed())
                            ->columnSpan(2),
                    ]),
            ]);
    }
}
