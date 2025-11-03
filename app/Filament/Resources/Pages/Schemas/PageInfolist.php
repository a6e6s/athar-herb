<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Page Overview Section
                Section::make(__('filament.resources.pages.sections.page_overview'))
                    ->description(__('filament.resources.pages.sections.page_overview_desc'))
                    ->icon('heroicon-o-document')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('title')
                            ->label(__('filament.resources.pages.fields.title'))
                            ->weight('bold')
                            ->size('lg')
                            ->color('primary')
                            ->icon('heroicon-m-document')
                            ->columnSpan(2),

                        IconEntry::make('is_published')
                            ->label(__('filament.resources.pages.fields.status'))
                            ->boolean()
                            ->trueIcon('heroicon-o-check-badge')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger')
                            ->columnSpan(1),

                        TextEntry::make('title_ar')
                            ->label(__('filament.resources.pages.fields.title_ar'))
                            ->icon('heroicon-m-language')
                            ->color('gray')
                            ->placeholder('-')
                            ->columnSpan(3),

                        TextEntry::make('slug')
                            ->label(__('filament.resources.pages.fields.slug'))
                            ->copyable()
                            ->copyMessage(__('filament.resources.pages.messages.copied'))
                            ->copyMessageDuration(1500)
                            ->icon('heroicon-m-link')
                            ->color('info')
                            ->columnSpan(3),
                    ]),

                // Content Section
                Section::make(__('filament.resources.pages.sections.content'))
                    ->description(__('filament.resources.pages.sections.content_desc'))
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('content')
                            ->label(__('filament.resources.pages.fields.content'))
                            ->html()
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('content_ar')
                            ->label(__('filament.resources.pages.fields.content_ar'))
                            ->html()
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                // SEO Information Section
                Section::make(__('filament.resources.pages.sections.seo_info'))
                    ->description(__('filament.resources.pages.sections.seo_info_desc'))
                    ->icon('heroicon-o-magnifying-glass')
                    ->columns(2)
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextEntry::make('meta_title')
                            ->label(__('filament.resources.pages.fields.meta_title'))
                            ->icon('heroicon-m-tag')
                            ->placeholder('-')
                            ->columnSpan(1),

                        TextEntry::make('meta_title_ar')
                            ->label(__('filament.resources.pages.fields.meta_title_ar'))
                            ->icon('heroicon-m-tag')
                            ->placeholder('-')
                            ->columnSpan(1),

                        TextEntry::make('meta_description')
                            ->label(__('filament.resources.pages.fields.meta_description'))
                            ->icon('heroicon-m-bars-3-bottom-left')
                            ->placeholder('-')
                            ->columnSpan(1),

                        TextEntry::make('meta_description_ar')
                            ->label(__('filament.resources.pages.fields.meta_description_ar'))
                            ->icon('heroicon-m-bars-3-bottom-left')
                            ->placeholder('-')
                            ->columnSpan(1),
                    ]),

                // Publishing Information Section
                Section::make(__('filament.resources.pages.sections.publish_info'))
                    ->description(__('filament.resources.pages.sections.publish_info_desc'))
                    ->icon('heroicon-o-rocket-launch')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('published_at')
                            ->label(__('filament.resources.pages.fields.published_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->since()
                            ->placeholder(__('filament.resources.pages.badges.not_published'))
                            ->icon('heroicon-m-calendar-days')
                            ->color(fn ($record) => $record->published_at ? 'success' : 'warning')
                            ->badge()
                            ->columnSpan(1),

                        IconEntry::make('is_published')
                            ->label(__('filament.resources.pages.fields.is_published'))
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger')
                            ->columnSpan(1),
                    ]),

                // System Information Section
                Section::make(__('filament.resources.pages.sections.system_info'))
                    ->description(__('filament.resources.pages.sections.system_info_desc'))
                    ->icon('heroicon-o-computer-desktop')
                    ->columns(3)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('id')
                            ->label(__('filament.resources.pages.fields.id'))
                            ->badge()
                            ->color('gray')
                            ->icon('heroicon-m-hashtag')
                            ->columnSpan(1),

                        TextEntry::make('created_at')
                            ->label(__('filament.resources.pages.fields.created_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->since()
                            ->icon('heroicon-m-calendar-days')
                            ->color('success')
                            ->badge()
                            ->columnSpan(1),

                        TextEntry::make('updated_at')
                            ->label(__('filament.resources.pages.fields.updated_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->since()
                            ->icon('heroicon-m-pencil-square')
                            ->color('warning')
                            ->badge()
                            ->columnSpan(1),

                        TextEntry::make('deleted_at')
                            ->label(__('filament.resources.pages.fields.deleted_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->icon('heroicon-m-trash')
                            ->color('danger')
                            ->badge()
                            ->visible(fn (Page $record): bool => $record->trashed())
                            ->columnSpan(3),
                    ]),
            ]);
    }
}
