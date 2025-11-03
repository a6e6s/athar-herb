<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('page_tabs')
                    ->tabs([
                        // Content Tab
                        Tab::make(__('filament.resources.pages.tabs.content'))
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make(__('filament.resources.pages.sections.basic_info'))
                                    ->description(__('filament.resources.pages.sections.basic_info_desc'))
                                    ->icon('heroicon-o-information-circle')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label(__('filament.resources.pages.fields.title'))
                                            ->placeholder(__('filament.resources.pages.placeholders.title'))
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                                            ->prefixIcon('heroicon-o-pencil')
                                            ->columnSpan(1),

                                        TextInput::make('title_ar')
                                            ->label(__('filament.resources.pages.fields.title_ar'))
                                            ->placeholder(__('filament.resources.pages.placeholders.title_ar'))
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-pencil')
                                            ->columnSpan(1),

                                        TextInput::make('slug')
                                            ->label(__('filament.resources.pages.fields.slug'))
                                            ->placeholder(__('filament.resources.pages.placeholders.slug'))
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->prefixIcon('heroicon-o-link')
                                            ->helperText(__('filament.resources.pages.helpers.slug'))
                                            ->columnSpan(2),
                                    ]),

                                Section::make(__('filament.resources.pages.sections.main_content'))
                                    ->description(__('filament.resources.pages.sections.main_content_desc'))
                                    ->icon('heroicon-o-document')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        RichEditor::make('content')
                                            ->label(__('filament.resources.pages.fields.content'))
                                            ->placeholder(__('filament.resources.pages.placeholders.content'))
                                            ->required()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strike',
                                                'link',
                                                'h1',
                                                'h2',
                                                'h3',
                                                'bulletList',
                                                'orderedList',
                                                'blockquote',
                                                'codeBlock',
                                            ])
                                            ->columnSpanFull(),

                                        RichEditor::make('content_ar')
                                            ->label(__('filament.resources.pages.fields.content_ar'))
                                            ->placeholder(__('filament.resources.pages.placeholders.content_ar'))
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strike',
                                                'link',
                                                'h1',
                                                'h2',
                                                'h3',
                                                'bulletList',
                                                'orderedList',
                                                'blockquote',
                                                'codeBlock',
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // SEO Tab
                        Tab::make(__('filament.resources.pages.tabs.seo'))
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Section::make(__('filament.resources.pages.sections.seo_settings'))
                                    ->description(__('filament.resources.pages.sections.seo_settings_desc'))
                                    ->icon('heroicon-o-globe-alt')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->label(__('filament.resources.pages.fields.meta_title'))
                                            ->placeholder(__('filament.resources.pages.placeholders.meta_title'))
                                            ->maxLength(60)
                                            ->helperText(__('filament.resources.pages.helpers.meta_title'))
                                            ->prefixIcon('heroicon-o-tag')
                                            ->columnSpan(1),

                                        TextInput::make('meta_title_ar')
                                            ->label(__('filament.resources.pages.fields.meta_title_ar'))
                                            ->placeholder(__('filament.resources.pages.placeholders.meta_title_ar'))
                                            ->maxLength(60)
                                            ->prefixIcon('heroicon-o-tag')
                                            ->columnSpan(1),

                                        Textarea::make('meta_description')
                                            ->label(__('filament.resources.pages.fields.meta_description'))
                                            ->placeholder(__('filament.resources.pages.placeholders.meta_description'))
                                            ->rows(3)
                                            ->maxLength(160)
                                            ->helperText(__('filament.resources.pages.helpers.meta_description'))
                                            ->columnSpan(1),

                                        Textarea::make('meta_description_ar')
                                            ->label(__('filament.resources.pages.fields.meta_description_ar'))
                                            ->placeholder(__('filament.resources.pages.placeholders.meta_description_ar'))
                                            ->rows(3)
                                            ->maxLength(160)
                                            ->columnSpan(1),
                                    ]),
                            ]),

                        // Publishing Tab
                        Tab::make(__('filament.resources.pages.tabs.publishing'))
                            ->icon('heroicon-o-rocket-launch')
                            ->schema([
                                Section::make(__('filament.resources.pages.sections.publish_settings'))
                                    ->description(__('filament.resources.pages.sections.publish_settings_desc'))
                                    ->icon('heroicon-o-calendar')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('is_published')
                                            ->label(__('filament.resources.pages.fields.is_published'))
                                            ->default(false)
                                            ->inline(false)
                                            ->helperText(__('filament.resources.pages.helpers.is_published'))
                                            ->columnSpan(1),

                                        DateTimePicker::make('published_at')
                                            ->label(__('filament.resources.pages.fields.published_at'))
                                            ->native(false)
                                            ->displayFormat('Y-m-d H:i:s')
                                            ->prefixIcon('heroicon-o-clock')
                                            ->helperText(__('filament.resources.pages.helpers.published_at'))
                                            ->columnSpan(1),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}
