<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Models\Testimonial;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Testimonial Overview Section
                Section::make(__('filament.resources.testimonials.sections.testimonial_overview'))
                    ->description(__('filament.resources.testimonials.sections.testimonial_overview_desc'))
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->columns(3)
                    ->schema([
                        ImageEntry::make('avatar')
                            ->label(__('filament.resources.testimonials.fields.avatar'))
                            ->disk('public')
                            ->defaultImageUrl(fn($record) => $record->avatar ? asset('storage/' . $record->avatar) : url('/images/placeholder.png'))
                            ->circular()
                            ->size(100)
                            ->columnSpan(1),

                        TextEntry::make('name')
                            ->label(__('filament.resources.testimonials.fields.name'))
                            ->weight('bold')
                            ->size('lg')
                            ->color('primary')
                            ->icon('heroicon-m-user')
                            ->columnSpan(2),

                        TextEntry::make('role')
                            ->label(__('filament.resources.testimonials.fields.role'))
                            ->icon('heroicon-m-briefcase')
                            ->color('gray')
                            ->placeholder('-')
                            ->columnSpan(2),

                        TextEntry::make('name_ar')
                            ->label(__('filament.resources.testimonials.fields.name_ar'))
                            ->icon('heroicon-m-language')
                            ->color('gray')
                            ->placeholder('-')
                            ->columnSpan(3),

                        TextEntry::make('role_ar')
                            ->label(__('filament.resources.testimonials.fields.role_ar'))
                            ->icon('heroicon-m-briefcase')
                            ->color('gray')
                            ->placeholder('-')
                            ->columnSpan(3),
                    ]),

                // Content Section
                Section::make(__('filament.resources.testimonials.sections.content'))
                    ->description(__('filament.resources.testimonials.sections.content_desc'))
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('content')
                            ->label(__('filament.resources.testimonials.fields.content'))
                            ->icon('heroicon-m-chat-bubble-left')
                            ->placeholder('-')
                            ->columnSpan(1),

                        TextEntry::make('content_ar')
                            ->label(__('filament.resources.testimonials.fields.content_ar'))
                            ->icon('heroicon-m-chat-bubble-left')
                            ->placeholder('-')
                            ->columnSpan(1),
                    ]),

                // Rating & Status Section
                Section::make(__('filament.resources.testimonials.sections.rating_status'))
                    ->description(__('filament.resources.testimonials.sections.rating_status_desc'))
                    ->icon('heroicon-o-star')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('rating')
                            ->label(__('filament.resources.testimonials.fields.rating'))
                            ->numeric()
                            ->icon('heroicon-m-star')
                            ->color(fn ($state) => match (true) {
                                $state >= 4 => 'success',
                                $state >= 3 => 'warning',
                                default => 'danger',
                            })
                            ->badge()
                            ->suffix(' / 5')
                            ->columnSpan(1),

                        IconEntry::make('is_approved')
                            ->label(__('filament.resources.testimonials.fields.is_approved'))
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger')
                            ->columnSpan(1),

                        TextEntry::make('sort_order')
                            ->label(__('filament.resources.testimonials.fields.sort_order'))
                            ->numeric()
                            ->icon('heroicon-m-bars-3-bottom-left')
                            ->badge()
                            ->color('info')
                            ->columnSpan(1),
                    ]),

                // System Information Section
                Section::make(__('filament.resources.testimonials.sections.system_info'))
                    ->description(__('filament.resources.testimonials.sections.system_info_desc'))
                    ->icon('heroicon-o-computer-desktop')
                    ->columns(3)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('id')
                            ->label(__('filament.resources.testimonials.fields.id'))
                            ->badge()
                            ->color('gray')
                            ->icon('heroicon-m-hashtag')
                            ->columnSpan(1),

                        TextEntry::make('created_at')
                            ->label(__('filament.resources.testimonials.fields.created_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->since()
                            ->icon('heroicon-m-calendar-days')
                            ->color('success')
                            ->badge()
                            ->columnSpan(1),

                        TextEntry::make('updated_at')
                            ->label(__('filament.resources.testimonials.fields.updated_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->since()
                            ->icon('heroicon-m-pencil-square')
                            ->color('warning')
                            ->badge()
                            ->columnSpan(1),

                        TextEntry::make('deleted_at')
                            ->label(__('filament.resources.testimonials.fields.deleted_at'))
                            ->dateTime('Y-m-d H:i:s')
                            ->icon('heroicon-m-trash')
                            ->color('danger')
                            ->badge()
                            ->visible(fn (Testimonial $record): bool => $record->trashed())
                            ->columnSpan(3),
                    ]),
            ]);
    }
}
