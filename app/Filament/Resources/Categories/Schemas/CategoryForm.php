<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make(__('filament.resources.categories.sections.basic_information'))
                    ->description(__('filament.resources.categories.sections.basic_information_desc'))
                    ->icon('heroicon-o-tag')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('name')
                            ->label(__('filament.resources.categories.fields.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn(Get $get, $set, ?string $state) =>
                                $set('slug', Str::slug($state))
                            )
                            ->placeholder(__('filament.resources.categories.placeholders.name'))
                            ->helperText(__('filament.resources.categories.helpers.name')),

                        TextInput::make('name_ar')
                            ->label(__('filament.resources.categories.fields.name_ar'))
                            ->maxLength(255)
                            ->placeholder(__('filament.resources.categories.placeholders.name_ar')),

                        TextInput::make('slug')
                            ->label(__('filament.resources.categories.fields.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder(__('filament.resources.categories.placeholders.slug'))
                            ->helperText(__('filament.resources.categories.helpers.slug'))
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label(__('filament.resources.categories.fields.description'))
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'undo',
                                'redo',
                            ])
                            ->placeholder(__('filament.resources.categories.placeholders.description'))
                            ->helperText(__('filament.resources.categories.helpers.description'))
                            ->columnSpanFull(),

                        RichEditor::make('description_ar')
                            ->label(__('filament.resources.categories.fields.description_ar'))
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'undo',
                                'redo',
                            ])
                            ->placeholder(__('filament.resources.categories.placeholders.description_ar'))
                            ->columnSpanFull(),
                    ]),
                Section::make(__('filament.resources.categories.sections.hierarchy'))
                    ->description(__('filament.resources.categories.sections.hierarchy_desc'))
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        Select::make('parent_id')
                            ->label(__('filament.resources.categories.fields.parent_id'))
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder(__('filament.resources.categories.placeholders.parent_id'))
                            ->helperText(__('filament.resources.categories.helpers.parent_id'))
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label(__('filament.resources.categories.fields.is_active'))
                            ->default(true)
                            ->inline(false)
                            ->helperText(__('filament.resources.categories.helpers.is_active')),
                    ]),
            ])->columns(4);
    }
}
