<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextEntry::make('name')
                    ->label(__('filament.resources.users.fields.name'))
                    ->weight('bold')
                    ->size('lg')
                    ->color('primary')
                    ->icon('heroicon-m-user')
                    ->columnSpan(2),

                IconEntry::make('email_verified_at')
                    ->label(__('filament.resources.users.badges.verified'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->columnSpan(1),

                TextEntry::make('email')
                    ->label(__('filament.resources.users.fields.email'))
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->color('gray')
                    ->columnSpan(2),

                TextEntry::make('email_verified_at')
                    ->label(__('filament.resources.users.fields.email_verified_at'))
                    ->dateTime()
                    ->since()
                    ->placeholder(__('filament.resources.users.badges.unverified'))
                    ->icon('heroicon-m-shield-check')
                    ->color(fn ($record) => $record->email_verified_at ? 'success' : 'danger')
                    ->columnSpan(1),

                TextEntry::make('created_at')
                    ->label(__('filament.resources.users.fields.created_at'))
                    ->dateTime()
                    ->since()
                    ->icon('heroicon-m-plus-circle')
                    ->color('success'),

                TextEntry::make('updated_at')
                    ->label(__('filament.resources.users.fields.updated_at'))
                    ->dateTime()
                    ->since()
                    ->icon('heroicon-m-pencil-square')
                    ->color('warning'),

                TextEntry::make('deleted_at')
                    ->label(__('filament.resources.users.fields.deleted_at'))
                    ->dateTime()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->visible(fn (User $record): bool => $record->trashed()),
            ]);
    }
}
