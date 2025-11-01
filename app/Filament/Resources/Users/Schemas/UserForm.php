<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.resources.users.fields.name'))
                    ->placeholder(__('filament.resources.users.placeholders.name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label(__('filament.resources.users.fields.email'))
                    ->placeholder(__('filament.resources.users.placeholders.email'))
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText(__('filament.resources.users.helpers.email')),

                DateTimePicker::make('email_verified_at')
                    ->label(__('filament.resources.users.fields.email_verified_at'))
                    ->helperText(__('filament.resources.users.helpers.email_verified_at'))
                    ->displayFormat('Y-m-d H:i:s')
                    ->native(false),

                TextInput::make('password')
                    ->label(__('filament.resources.users.fields.password'))
                    ->placeholder(__('filament.resources.users.placeholders.password'))
                    ->password()
                    ->revealable()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->minLength(8)
                    ->helperText(__('filament.resources.users.helpers.password'))
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
            ]);
    }
}
