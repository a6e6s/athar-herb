<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Checkbox;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([
                        // Order Details Tab
                        Tab::make(__('filament.resources.orders.tabs.order_details'))
                            ->icon('heroicon-o-shopping-cart')
                            ->schema([
                                Section::make(__('filament.resources.orders.sections.order_information'))
                                    ->description(__('filament.resources.orders.sections.order_information_description'))
                                    ->icon('heroicon-o-information-circle')
                                    ->collapsible()
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('order_number')
                                            ->label(__('filament.resources.orders.fields.order_number'))
                                            ->default(fn () => 'ORD-' . strtoupper(uniqid()))
                                            ->unique(ignoreRecord: true)
                                            ->disabled()
                                            ->dehydrated()
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpan(1),

                                        Select::make('user_id')
                                            ->label(__('filament.resources.orders.fields.customer'))
                                            ->relationship('user', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                if ($state) {
                                                    $user = \App\Models\User::find($state);
                                                    if ($user) {
                                                        // Auto-fill shipping address with user info
                                                        $set('shipping_address.name', $user->name);
                                                        $set('shipping_address.email', $user->email);
                                                        $set('shipping_address.phone', $user->phone ?? '');
                                                    }
                                                }
                                            })
                                            ->columnSpan(1),

                                        Select::make('status')
                                            ->label(__('filament.resources.orders.fields.status'))
                                            ->options([
                                                'pending' => __('filament.resources.orders.status.pending'),
                                                'processing' => __('filament.resources.orders.status.processing'),
                                                'shipped' => __('filament.resources.orders.status.shipped'),
                                                'delivered' => __('filament.resources.orders.status.delivered'),
                                                'cancelled' => __('filament.resources.orders.status.cancelled'),
                                            ])
                                            ->default('pending')
                                            ->required()
                                            ->native(false)
                                            ->columnSpan(1),

                                        TextEntry::make('created_at')
                                            ->label(__('filament.resources.orders.fields.order_date'))
                                            ->state(fn ($record) => $record ? $record->created_at->format('d/m/Y H:i') : '-')
                                            ->columnSpan(1),

                                        TextEntry::make('items_count')
                                            ->label(__('filament.resources.orders.fields.items_count'))
                                            ->state(fn ($record) => $record ? $record->items()->count() : 0)
                                            ->columnSpan(1),

                                        Textarea::make('notes')
                                            ->label(__('filament.resources.orders.fields.notes'))
                                            ->placeholder(__('filament.resources.orders.placeholders.notes'))
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make(__('filament.resources.orders.sections.order_items'))
                                    ->description(__('filament.resources.orders.sections.order_items_description'))
                                    ->icon('heroicon-o-shopping-bag')
                                    ->collapsible()
                                    ->schema([
                                        Repeater::make('items')
                                            ->label('')
                                            ->relationship('items')
                                            ->columns(6)
                                            ->defaultItems(1)
                                            ->addActionLabel(__('filament.resources.orders.actions.add_item'))
                                            ->schema([
                                                Select::make('product_id')
                                                    ->label(__('filament.resources.orders.fields.product'))
                                                    ->relationship('product', 'name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->required()
                                                    ->live()
                                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                        if ($state) {
                                                            $product = \App\Models\Product::find($state);
                                                            if ($product) {
                                                                $set('product_name', $product->name);
                                                                $set('price', $product->selling_price);
                                                                $quantity = $get('quantity') ?? 1;
                                                                $set('total', $product->selling_price * $quantity);
                                                            }
                                                        }
                                                    })
                                                    ->columnSpan(1),

                                                TextInput::make('product_name')
                                                    ->label(__('filament.resources.orders.fields.product_name'))
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->columnSpan(2),

                                                TextInput::make('price')
                                                    ->label(__('filament.resources.orders.fields.price'))
                                                    ->numeric()
                                                    ->prefix('SAR')
                                                    ->required()
                                                    ->live()
                                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                        $quantity = $get('quantity') ?? 1;
                                                        $set('total', $state * $quantity);
                                                    })
                                                    ->columnSpan(1),

                                                TextInput::make('quantity')
                                                    ->label(__('filament.resources.orders.fields.quantity'))
                                                    ->numeric()
                                                    ->default(1)
                                                    ->minValue(1)
                                                    ->required()
                                                    ->live()
                                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                        $price = $get('price') ?? 0;
                                                        $set('total', $price * $state);
                                                    })
                                                    ->columnSpan(1),

                                                TextInput::make('total')
                                                    ->label(__('filament.resources.orders.fields.total'))
                                                    ->numeric()
                                                    ->prefix('SAR')
                                                    ->required()
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->columnSpan(1),
                                            ])
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                $total = collect($state)->sum('total');
                                                $set('total_amount', $total);

                                                // Update tax, shipping, discount to recalculate total
                                                $tax = $get('tax') ?? 0;
                                                $shipping = $get('shipping_cost') ?? 0;
                                                $discount = $get('discount') ?? 0;
                                                $finalTotal = $total + $tax + $shipping - $discount;
                                                $set('total_amount', $finalTotal);
                                            })
                                            ->deleteAction(
                                                fn ($action) => $action->after(function (callable $get, callable $set) {
                                                    $items = $get('items');
                                                    $total = collect($items)->sum('total');

                                                    // Recalculate total with tax, shipping, discount
                                                    $tax = $get('tax') ?? 0;
                                                    $shipping = $get('shipping_cost') ?? 0;
                                                    $discount = $get('discount') ?? 0;
                                                    $finalTotal = $total + $tax + $shipping - $discount;
                                                    $set('total_amount', $finalTotal);
                                                })
                                            )
                                    ]),

                                Section::make(__('filament.resources.orders.sections.totals'))
                                    ->description(__('filament.resources.orders.sections.totals_description'))
                                    ->icon('heroicon-o-calculator')
                                    ->collapsible()
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('subtotal')
                                            ->label(__('filament.resources.orders.fields.subtotal'))
                                            ->numeric()
                                            ->prefix('SAR')
                                            ->disabled()
                                            ->default(0)
                                            ->dehydrated(false)
                                            ->columnSpan(1),

                                        TextInput::make('tax')
                                            ->label(__('filament.resources.orders.fields.tax'))
                                            ->numeric()
                                            ->prefix('SAR')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                $items = $get('items') ?? [];
                                                $subtotal = collect($items)->sum('total');
                                                $shipping = $get('shipping_cost') ?? 0;
                                                $discount = $get('discount') ?? 0;
                                                $finalTotal = $subtotal + $state + $shipping - $discount;
                                                $set('total_amount', $finalTotal);
                                            })
                                            ->columnSpan(1),

                                        TextInput::make('shipping_cost')
                                            ->label(__('filament.resources.orders.fields.shipping_cost'))
                                            ->numeric()
                                            ->prefix('SAR')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                $items = $get('items') ?? [];
                                                $subtotal = collect($items)->sum('total');
                                                $tax = $get('tax') ?? 0;
                                                $discount = $get('discount') ?? 0;
                                                $finalTotal = $subtotal + $tax + $state - $discount;
                                                $set('total_amount', $finalTotal);
                                            })
                                            ->columnSpan(1),

                                        TextInput::make('discount')
                                            ->label(__('filament.resources.orders.fields.discount'))
                                            ->numeric()
                                            ->prefix('SAR')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                $items = $get('items') ?? [];
                                                $subtotal = collect($items)->sum('total');
                                                $tax = $get('tax') ?? 0;
                                                $shipping = $get('shipping_cost') ?? 0;
                                                $finalTotal = $subtotal + $tax + $shipping - $state;
                                                $set('total_amount', $finalTotal);
                                            })
                                            ->columnSpan(1),

                                        TextInput::make('total_amount')
                                            ->label(__('filament.resources.orders.fields.total_amount'))
                                            ->numeric()
                                            ->prefix('SAR')
                                            ->required()
                                            ->disabled()
                                            ->dehydrated()
                                            ->default(0)
                                            ->columnSpan(2),
                                    ]),
                            ]),

                        // Customer Info Tab
                        Tab::make(__('filament.resources.orders.tabs.customer_info'))
                            ->icon('heroicon-o-user')
                            ->schema([
                                Section::make(__('filament.resources.orders.sections.shipping_address'))
                                    ->description(__('filament.resources.orders.sections.shipping_address_description'))
                                    ->icon('heroicon-o-truck')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('shipping_address.name')
                                            ->label(__('filament.resources.orders.fields.customer_name'))
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('shipping_address.phone')
                                            ->label(__('filament.resources.orders.fields.customer_phone'))
                                            ->tel()
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('shipping_address.email')
                                            ->label(__('filament.resources.orders.fields.customer_email'))
                                            ->email()
                                            ->maxLength(255),

                                        TextInput::make('shipping_address.city')
                                            ->label(__('filament.resources.orders.fields.city'))
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('shipping_address.state')
                                            ->label(__('filament.resources.orders.fields.state'))
                                            ->maxLength(255),

                                        TextInput::make('shipping_address.postal_code')
                                            ->label(__('filament.resources.orders.fields.postal_code'))
                                            ->maxLength(255),

                                        Textarea::make('shipping_address.address')
                                            ->label(__('filament.resources.orders.fields.shipping_address'))
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make(__('filament.resources.orders.sections.billing_address'))
                                    ->description(__('filament.resources.orders.sections.billing_address_description'))
                                    ->icon('heroicon-o-credit-card')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        Checkbox::make('same_as_shipping')
                                            ->label(__('filament.resources.orders.fields.same_as_shipping'))
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                if ($state) {
                                                    $set('billing_address.name', $get('shipping_address.name'));
                                                    $set('billing_address.phone', $get('shipping_address.phone'));
                                                    $set('billing_address.email', $get('shipping_address.email'));
                                                    $set('billing_address.city', $get('shipping_address.city'));
                                                    $set('billing_address.state', $get('shipping_address.state'));
                                                    $set('billing_address.postal_code', $get('shipping_address.postal_code'));
                                                    $set('billing_address.address', $get('shipping_address.address'));
                                                }
                                            })
                                            ->dehydrated(false)
                                            ->columnSpanFull(),

                                        TextInput::make('billing_address.name')
                                            ->label(__('filament.resources.orders.fields.customer_name'))
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('billing_address.phone')
                                            ->label(__('filament.resources.orders.fields.customer_phone'))
                                            ->tel()
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('billing_address.email')
                                            ->label(__('filament.resources.orders.fields.customer_email'))
                                            ->email()
                                            ->maxLength(255),

                                        TextInput::make('billing_address.city')
                                            ->label(__('filament.resources.orders.fields.city'))
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('billing_address.state')
                                            ->label(__('filament.resources.orders.fields.state'))
                                            ->maxLength(255),

                                        TextInput::make('billing_address.postal_code')
                                            ->label(__('filament.resources.orders.fields.postal_code'))
                                            ->maxLength(255),

                                        Textarea::make('billing_address.address')
                                            ->label(__('filament.resources.orders.fields.billing_address'))
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make(__('filament.resources.orders.sections.payment_information'))
                                    ->description(__('filament.resources.orders.sections.payment_information_description'))
                                    ->icon('heroicon-o-banknotes')
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        Select::make('payment_status')
                                            ->label(__('filament.resources.orders.fields.payment_status'))
                                            ->options([
                                                'pending' => __('filament.resources.orders.payment_status.pending'),
                                                'paid' => __('filament.resources.orders.payment_status.paid'),
                                                'failed' => __('filament.resources.orders.payment_status.failed'),
                                                'refunded' => __('filament.resources.orders.payment_status.refunded'),
                                            ])
                                            ->default('pending')
                                            ->native(false),

                                        TextInput::make('payment_method')
                                            ->label(__('filament.resources.orders.fields.payment_method'))
                                            ->maxLength(255),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
