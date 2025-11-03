<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('user_tabs')
                    ->tabs([
                        // Basic Information Tab
                        Tab::make(__('filament.resources.users.tabs.basic_info'))
                            ->icon('heroicon-o-user')
                            ->schema([
                                Section::make(__('filament.resources.users.sections.account_details'))
                                    ->description(__('filament.resources.users.sections.account_details_desc'))
                                    ->icon('heroicon-o-identification')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label(__('filament.resources.users.fields.name'))
                                            ->placeholder(__('filament.resources.users.placeholders.name'))
                                            ->required()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-user')
                                            ->columnSpan(2),

                                        TextInput::make('email')
                                            ->label(__('filament.resources.users.fields.email'))
                                            ->placeholder(__('filament.resources.users.placeholders.email'))
                                            ->email()
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->prefixIcon('heroicon-o-envelope')
                                            ->helperText(__('filament.resources.users.helpers.email'))
                                            ->columnSpan(2),

                                        DateTimePicker::make('email_verified_at')
                                            ->label(__('filament.resources.users.fields.email_verified_at'))
                                            ->helperText(__('filament.resources.users.helpers.email_verified_at'))
                                            ->displayFormat('Y-m-d H:i:s')
                                            ->native(false)
                                            ->prefixIcon('heroicon-o-shield-check')
                                            ->columnSpan(2),

                                        Select::make('user_type')
                                            ->label(__('filament.resources.users.fields.user_type'))
                                            ->options(UserType::class)
                                            ->default(UserType::CUSTOMER->value)
                                            ->required()
                                            ->native(false)
                                            ->prefixIcon('heroicon-o-user-group')
                                            ->helperText(__('filament.resources.users.helpers.user_type'))
                                            ->columnSpan(1),

                                        Toggle::make('is_active')
                                            ->label(__('filament.resources.users.fields.is_active'))
                                            ->default(true)
                                            ->inline(false)
                                            ->helperText(__('filament.resources.users.helpers.is_active'))
                                            ->columnSpan(1),
                                    ]),
                                Section::make(__('filament.resources.users.sections.password_security'))
                                    ->description(__('filament.resources.users.sections.password_security_desc'))
                                    ->icon('heroicon-o-key')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('password')
                                            ->label(__('filament.resources.users.fields.password'))
                                            ->placeholder(__('filament.resources.users.placeholders.password'))
                                            ->password()
                                            ->revealable()
                                            ->required(fn(string $context): bool => $context === 'create')
                                            ->minLength(8)
                                            ->prefixIcon('heroicon-o-lock-closed')
                                            ->helperText(__('filament.resources.users.helpers.password'))
                                            ->dehydrated(fn($state) => filled($state))
                                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                            ->columnSpan(1),

                                        TextInput::make('password_confirmation')
                                            ->label(__('filament.resources.users.fields.password_confirmation'))
                                            ->placeholder(__('filament.resources.users.placeholders.password_confirmation'))
                                            ->password()
                                            ->revealable()
                                            ->required(fn(string $context): bool => $context === 'create')
                                            ->minLength(8)
                                            ->prefixIcon('heroicon-o-lock-closed')
                                            ->same('password')
                                            ->dehydrated(false)
                                            ->columnSpan(1),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}
