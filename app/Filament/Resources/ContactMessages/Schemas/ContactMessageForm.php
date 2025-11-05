<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('filament.resources.contact_messages.sections.contact_information'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('filament.resources.contact_messages.fields.name'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label(__('filament.resources.contact_messages.fields.email'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label(__('filament.resources.contact_messages.fields.phone'))
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        TextInput::make('subject')
                            ->label(__('filament.resources.contact_messages.fields.subject'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('message')
                            ->label(__('filament.resources.contact_messages.fields.message'))
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make(__('filament.resources.contact_messages.sections.status_response'))
                    ->schema([
                        Select::make('status')
                            ->label(__('filament.resources.contact_messages.fields.status'))
                            ->options([
                                'pending' => __('filament.resources.contact_messages.status_options.pending'),
                                'read' => __('filament.resources.contact_messages.status_options.read'),
                                'replied' => __('filament.resources.contact_messages.status_options.replied'),
                            ])
                            ->default('pending')
                            ->required(),
                        TextInput::make('ip_address')
                            ->label(__('filament.resources.contact_messages.fields.ip_address'))
                            ->disabled(),
                        Textarea::make('user_agent')
                            ->label(__('filament.resources.contact_messages.fields.user_agent'))
                            ->disabled()
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

            ]);
    }
}
