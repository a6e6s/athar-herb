<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('testimonial_tabs')
                    ->tabs([
                        // Basic Information Tab
                        Tab::make(__('filament.resources.testimonials.tabs.basic_info'))
                            ->icon('heroicon-o-user')
                            ->schema([
                                Section::make(__('filament.resources.testimonials.sections.person_info'))
                                    ->description(__('filament.resources.testimonials.sections.person_info_desc'))
                                    ->icon('heroicon-o-identification')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label(__('filament.resources.testimonials.fields.name'))
                                            ->placeholder(__('filament.resources.testimonials.placeholders.name'))
                                            ->required()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-user')
                                            ->columnSpan(1),

                                        TextInput::make('name_ar')
                                            ->label(__('filament.resources.testimonials.fields.name_ar'))
                                            ->placeholder(__('filament.resources.testimonials.placeholders.name_ar'))
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-user')
                                            ->columnSpan(1),

                                        TextInput::make('role')
                                            ->label(__('filament.resources.testimonials.fields.role'))
                                            ->placeholder(__('filament.resources.testimonials.placeholders.role'))
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-briefcase')
                                            ->helperText(__('filament.resources.testimonials.helpers.role'))
                                            ->columnSpan(1),

                                        TextInput::make('role_ar')
                                            ->label(__('filament.resources.testimonials.fields.role_ar'))
                                            ->placeholder(__('filament.resources.testimonials.placeholders.role_ar'))
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-briefcase')
                                            ->columnSpan(1),
                                    ]),

                                Section::make(__('filament.resources.testimonials.sections.testimonial_content'))
                                    ->description(__('filament.resources.testimonials.sections.testimonial_content_desc'))
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        Textarea::make('content')
                                            ->label(__('filament.resources.testimonials.fields.content'))
                                            ->placeholder(__('filament.resources.testimonials.placeholders.content'))
                                            ->required()
                                            ->rows(5)
                                            ->maxLength(1000)
                                            ->helperText(__('filament.resources.testimonials.helpers.content'))
                                            ->columnSpan(1),

                                        Textarea::make('content_ar')
                                            ->label(__('filament.resources.testimonials.fields.content_ar'))
                                            ->placeholder(__('filament.resources.testimonials.placeholders.content_ar'))
                                            ->rows(5)
                                            ->maxLength(1000)
                                            ->columnSpan(1),

                                        TextInput::make('rating')
                                            ->label(__('filament.resources.testimonials.fields.rating'))
                                            ->required()
                                            ->numeric()
                                            ->minValue(1)
                                            ->maxValue(5)
                                            ->default(5)
                                            ->prefixIcon('heroicon-o-star')
                                            ->helperText(__('filament.resources.testimonials.helpers.rating'))
                                            ->columnSpan(2),
                                    ]),
                            ]),

                        // Media Tab
                        Tab::make(__('filament.resources.testimonials.tabs.media'))
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make(__('filament.resources.testimonials.sections.avatar'))
                                    ->description(__('filament.resources.testimonials.sections.avatar_desc'))
                                    ->icon('heroicon-o-camera')
                                    ->collapsible()
                                    ->schema([
                                        FileUpload::make('avatar')
                                            ->label(__('filament.resources.testimonials.fields.avatar'))
                                            ->disk('public')
                                            ->directory('testimonials')
                                            ->image()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                            ])
                                            ->maxSize(1024)
                                            ->helperText(__('filament.resources.testimonials.helpers.avatar'))
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Settings Tab
                        Tab::make(__('filament.resources.testimonials.tabs.settings'))
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Section::make(__('filament.resources.testimonials.sections.display_settings'))
                                    ->description(__('filament.resources.testimonials.sections.display_settings_desc'))
                                    ->icon('heroicon-o-adjustments-horizontal')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('is_approved')
                                            ->label(__('filament.resources.testimonials.fields.is_approved'))
                                            ->default(false)
                                            ->inline(false)
                                            ->helperText(__('filament.resources.testimonials.helpers.is_approved'))
                                            ->columnSpan(1),

                                        TextInput::make('sort_order')
                                            ->label(__('filament.resources.testimonials.fields.sort_order'))
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->prefixIcon('heroicon-o-bars-3-bottom-left')
                                            ->helperText(__('filament.resources.testimonials.helpers.sort_order'))
                                            ->columnSpan(1),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}
