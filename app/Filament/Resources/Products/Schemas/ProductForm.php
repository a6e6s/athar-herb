<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Details')
                    ->tabs([
                        // General Information Tab
                        Tab::make(__('filament.resources.products.tabs.general'))
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make(__('filament.resources.products.sections.basic_information'))
                                    ->description(__('filament.resources.products.sections.basic_information_desc'))
                                    ->icon('heroicon-o-document-text')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label(__('filament.resources.products.fields.name'))
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Get $get, $set, ?string $state) =>
                                                $set('slug', Str::slug($state))
                                            )
                                            ->placeholder(__('filament.resources.products.placeholders.name')),

                                        TextInput::make('slug')
                                            ->label(__('filament.resources.products.fields.slug'))
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->placeholder(__('filament.resources.products.placeholders.slug'))
                                            ->helperText(__('filament.resources.products.helpers.slug')),

                                        Select::make('category_id')
                                            ->label(__('filament.resources.products.fields.category_id'))
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255),
                                                TextInput::make('slug')
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->placeholder(__('filament.resources.products.placeholders.category')),

                                        TextInput::make('sku')
                                            ->label(__('filament.resources.products.fields.sku'))
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(100)
                                            ->placeholder(__('filament.resources.products.placeholders.sku'))
                                            ->helperText(__('filament.resources.products.helpers.sku')),
                                    ]),

                                Section::make(__('filament.resources.products.sections.description'))
                                    ->description(__('filament.resources.products.sections.description_desc'))
                                    ->icon('heroicon-o-document-text')
                                    ->collapsible()
                                    ->schema([
                                        Textarea::make('short_description')
                                            ->label(__('filament.resources.products.fields.short_description'))
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->placeholder(__('filament.resources.products.placeholders.short_description'))
                                            ->helperText(__('filament.resources.products.helpers.short_description'))
                                            ->columnSpanFull(),

                                        RichEditor::make('description')
                                            ->label(__('filament.resources.products.fields.description'))
                                            ->required()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strike',
                                                'bulletList',
                                                'orderedList',
                                                'h2',
                                                'h3',
                                                'undo',
                                                'redo',
                                            ])
                                            ->placeholder(__('filament.resources.products.placeholders.description'))
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Pricing Tab
                        Tab::make(__('filament.resources.products.tabs.pricing'))
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Section::make(__('filament.resources.products.sections.pricing'))
                                    ->description(__('filament.resources.products.sections.pricing_desc'))
                                    ->icon('heroicon-o-banknotes')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('price')
                                            ->label(__('filament.resources.products.fields.price'))
                                            ->required()
                                            ->numeric()
                                            ->prefix('$')
                                            ->minValue(0)
                                            ->step(0.01)
                                            ->placeholder('0.00')
                                            ->helperText(__('filament.resources.products.helpers.price')),

                                        TextInput::make('cost_price')
                                            ->label(__('filament.resources.products.fields.cost_price'))
                                            ->numeric()
                                            ->prefix('$')
                                            ->minValue(0)
                                            ->step(0.01)
                                            ->placeholder('0.00')
                                            ->helperText(__('filament.resources.products.helpers.cost_price')),
                                    ]),
                            ]),

                        // Inventory Tab
                        Tab::make(__('filament.resources.products.tabs.inventory'))
                            ->icon('heroicon-o-cube')
                            ->schema([
                                Section::make(__('filament.resources.products.sections.stock'))
                                    ->description(__('filament.resources.products.sections.stock_desc'))
                                    ->icon('heroicon-o-archive-box')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('stock_quantity')
                                            ->label(__('filament.resources.products.fields.stock_quantity'))
                                            ->required()
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->step(1)
                                            ->placeholder('0')
                                            ->helperText(__('filament.resources.products.helpers.stock_quantity')),

                                        TextInput::make('low_stock_threshold')
                                            ->label(__('filament.resources.products.fields.low_stock_threshold'))
                                            ->required()
                                            ->numeric()
                                            ->default(5)
                                            ->minValue(0)
                                            ->step(1)
                                            ->placeholder('5')
                                            ->helperText(__('filament.resources.products.helpers.low_stock_threshold')),

                                        TextInput::make('weight')
                                            ->label(__('filament.resources.products.fields.weight'))
                                            ->numeric()
                                            ->step(0.01)
                                            ->minValue(0)
                                            ->placeholder('0.00')
                                            ->suffix('kg')
                                            ->helperText(__('filament.resources.products.helpers.weight')),

                                        TextInput::make('unit_of_measure')
                                            ->label(__('filament.resources.products.fields.unit_of_measure'))
                                            ->maxLength(50)
                                            ->placeholder(__('filament.resources.products.placeholders.unit_of_measure'))
                                            ->helperText(__('filament.resources.products.helpers.unit_of_measure')),

                                        DatePicker::make('expiration_date')
                                            ->label(__('filament.resources.products.fields.expiration_date'))
                                            ->native(false)
                                            ->displayFormat('Y-m-d')
                                            ->placeholder(__('filament.resources.products.placeholders.expiration_date'))
                                            ->helperText(__('filament.resources.products.helpers.expiration_date'))
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Media Tab
                        Tab::make(__('filament.resources.products.tabs.media'))
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make(__('filament.resources.products.sections.images'))
                                    ->description(__('filament.resources.products.sections.images_desc'))
                                    ->icon('heroicon-o-camera')
                                    ->schema([
                                        FileUpload::make('image_path')
                                            ->label(__('filament.resources.products.fields.image_path'))
                                            ->image()
                                            ->disk('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                                '4:3',
                                                '16:9',
                                            ])
                                            ->directory('products/images')
                                            ->visibility('public')
                                            ->maxSize(2048)
                                            ->helperText(__('filament.resources.products.helpers.image_path'))
                                            ->columnSpanFull(),

                                        FileUpload::make('secondary_images')
                                            ->label(__('filament.resources.products.fields.secondary_images'))
                                            ->image()
                                            ->multiple()
                                            ->disk('public')
                                            ->reorderable()
                                            ->imageEditor()
                                            ->directory('products/gallery')
                                            ->visibility('public')
                                            ->maxSize(2048)
                                            ->maxFiles(5)
                                            ->helperText(__('filament.resources.products.helpers.secondary_images'))
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Settings Tab
                        Tab::make(__('filament.resources.products.tabs.settings'))
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Section::make(__('filament.resources.products.sections.visibility'))
                                    ->description(__('filament.resources.products.sections.visibility_desc'))
                                    ->icon('heroicon-o-eye')
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label(__('filament.resources.products.fields.is_active'))
                                            ->default(true)
                                            ->inline(false)
                                            ->helperText(__('filament.resources.products.helpers.is_active')),

                                        Toggle::make('is_featured')
                                            ->label(__('filament.resources.products.fields.is_featured'))
                                            ->default(false)
                                            ->inline(false)
                                            ->helperText(__('filament.resources.products.helpers.is_featured')),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}
