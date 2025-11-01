<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Fieldset;
// use Filament\Infolists\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                // === ORDER OVERVIEW ===
                Fieldset::make(__('filament.resources.orders.sections.order_information'))
                    ->schema([
                        TextEntry::make('order_number')
                            ->label(__('filament.resources.orders.fields.order_number'))
                            ->icon('heroicon-o-hashtag')
                            ->copyable()
                            ->weight(FontWeight::Bold)
                            ->size('lg')
                            ->color('primary')
                            ->columnSpan(1),

                        TextEntry::make('status')
                            ->label(__('filament.resources.orders.fields.status'))
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'processing' => 'info',
                                'shipped' => 'primary',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => __('filament.resources.orders.status.' . $state))
                            ->icon(fn (string $state): string => match ($state) {
                                'pending' => 'heroicon-o-clock',
                                'processing' => 'heroicon-o-arrow-path',
                                'shipped' => 'heroicon-o-truck',
                                'delivered' => 'heroicon-o-check-circle',
                                'cancelled' => 'heroicon-o-x-circle',
                                default => 'heroicon-o-question-mark-circle',
                            })
                            ->columnSpan(1),

                        TextEntry::make('created_at')
                            ->label(__('filament.resources.orders.fields.order_date'))
                            ->dateTime('d/m/Y H:i')
                            ->icon('heroicon-o-calendar')
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                // === CUSTOMER INFORMATION ===
                Fieldset::make(__('filament.resources.orders.sections.customer_information'))
                    ->schema([
                        TextEntry::make('user.name')
                            ->label(__('filament.resources.orders.fields.customer_name'))
                            ->icon('heroicon-o-user')
                            ->weight(FontWeight::Bold)
                            ->size('md')
                            ->columnSpan(2),

                        TextEntry::make('shipping_address.phone')
                            ->label(__('filament.resources.orders.fields.customer_phone'))
                            ->icon('heroicon-o-phone')
                            ->default('-')
                            ->columnSpan(1),

                        TextEntry::make('user.email')
                            ->label(__('filament.resources.orders.fields.customer_email'))
                            ->icon('heroicon-o-envelope')
                            ->copyable()
                            ->columnSpan(3),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                // === ORDER ITEMS ===
                RepeatableEntry::make('items')
                    ->label(__('filament.resources.orders.sections.order_items'))
                    ->schema([
                        TextEntry::make('product_name')
                            ->label(__('filament.resources.orders.fields.product_name'))
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-cube')
                            ->columnSpan(2),

                        TextEntry::make('quantity')
                            ->label(__('filament.resources.orders.fields.quantity'))
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-o-hashtag')
                            ->columnSpan(1),

                        TextEntry::make('price')
                            ->label(__('filament.resources.orders.fields.price'))
                            ->money('SAR')
                            ->columnSpan(1),

                        TextEntry::make('total')
                            ->label(__('filament.resources.orders.fields.total'))
                            ->money('SAR')
                            ->weight(FontWeight::Bold)
                            ->color('success')
                            ->columnSpan(1),
                    ])
                    ->columns(5)
                    ->columnSpanFull(),

                // === ORDER TOTALS ===
                Fieldset::make(__('filament.resources.orders.sections.totals'))
                    ->schema([
                        TextEntry::make('subtotal')
                            ->label(__('filament.resources.orders.fields.subtotal'))
                            ->state(fn ($record) => $record->items->sum('total'))
                            ->money('SAR')
                            ->icon('heroicon-o-calculator')
                            ->columnSpan(1),

                        TextEntry::make('tax')
                            ->label(__('filament.resources.orders.fields.tax'))
                            ->money('SAR')
                            ->icon('heroicon-o-receipt-percent')
                            ->default(0)
                            ->columnSpan(1),

                        TextEntry::make('shipping_cost')
                            ->label(__('filament.resources.orders.fields.shipping_cost'))
                            ->money('SAR')
                            ->icon('heroicon-o-truck')
                            ->default(0)
                            ->columnSpan(1),

                        TextEntry::make('discount')
                            ->label(__('filament.resources.orders.fields.discount'))
                            ->money('SAR')
                            ->icon('heroicon-o-tag')
                            ->color('danger')
                            ->default(0)
                            ->columnSpan(1),

                        TextEntry::make('total_amount')
                            ->label(__('filament.resources.orders.fields.total_amount'))
                            ->money('SAR')
                            ->weight(FontWeight::Bold)
                            ->size('lg')
                            ->color('success')
                            ->icon('heroicon-o-banknotes')
                            ->columnSpan(2),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                // === PAYMENT INFORMATION ===
                Fieldset::make(__('filament.resources.orders.sections.payment_information'))
                    ->schema([
                        TextEntry::make('payment_status')
                            ->label(__('filament.resources.orders.fields.payment_status'))
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'paid' => 'success',
                                'failed' => 'danger',
                                'refunded' => 'info',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => __('filament.resources.orders.payment_status.' . $state))
                            ->icon(fn (string $state): string => match ($state) {
                                'pending' => 'heroicon-o-clock',
                                'paid' => 'heroicon-o-check-circle',
                                'failed' => 'heroicon-o-x-circle',
                                'refunded' => 'heroicon-o-arrow-uturn-left',
                                default => 'heroicon-o-question-mark-circle',
                            })
                            ->columnSpan(1),

                        TextEntry::make('payment_method')
                            ->label(__('filament.resources.orders.fields.payment_method'))
                            ->icon('heroicon-o-credit-card')
                            ->default('-')
                            ->columnSpan(2),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                // === SHIPPING ADDRESS ===
                Fieldset::make(__('filament.resources.orders.sections.shipping_address'))
                    ->schema([
                        TextEntry::make('shipping_address.name')
                            ->label(__('filament.resources.orders.fields.customer_name'))
                            ->icon('heroicon-o-user')
                            ->weight(FontWeight::SemiBold)
                            ->default('-')
                            ->columnSpan(2),

                        TextEntry::make('shipping_address.phone')
                            ->label(__('filament.resources.orders.fields.customer_phone'))
                            ->icon('heroicon-o-phone')
                            ->default('-')
                            ->columnSpan(1),

                        TextEntry::make('shipping_address.email')
                            ->label(__('filament.resources.orders.fields.customer_email'))
                            ->icon('heroicon-o-envelope')
                            ->default('-')
                            ->columnSpan(3),

                        TextEntry::make('shipping_address.address')
                            ->label(__('filament.resources.orders.fields.address'))
                            ->icon('heroicon-o-map')
                            ->default('-')
                            ->columnSpan(3),

                        TextEntry::make('shipping_address.city')
                            ->label(__('filament.resources.orders.fields.city'))
                            ->icon('heroicon-o-map-pin')
                            ->default('-')
                            ->columnSpan(1),

                        TextEntry::make('shipping_address.state')
                            ->label(__('filament.resources.orders.fields.state'))
                            ->default('-')
                            ->columnSpan(1),

                        TextEntry::make('shipping_address.postal_code')
                            ->label(__('filament.resources.orders.fields.postal_code'))
                            ->default('-')
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                // === BILLING ADDRESS ===
                Fieldset::make(__('filament.resources.orders.sections.billing_address'))
                    ->schema([
                        TextEntry::make('billing_address.name')
                            ->label(__('filament.resources.orders.fields.customer_name'))
                            ->icon('heroicon-o-user')
                            ->weight(FontWeight::SemiBold)
                            ->default('-')
                            ->columnSpan(2),

                        TextEntry::make('billing_address.phone')
                            ->label(__('filament.resources.orders.fields.customer_phone'))
                            ->icon('heroicon-o-phone')
                            ->default('-')
                            ->columnSpan(1),

                        TextEntry::make('billing_address.email')
                            ->label(__('filament.resources.orders.fields.customer_email'))
                            ->icon('heroicon-o-envelope')
                            ->default('-')
                            ->columnSpan(3),

                        TextEntry::make('billing_address.address')
                            ->label(__('filament.resources.orders.fields.address'))
                            ->icon('heroicon-o-map')
                            ->default('-')
                            ->columnSpan(3),

                        TextEntry::make('billing_address.city')
                            ->label(__('filament.resources.orders.fields.city'))
                            ->icon('heroicon-o-map-pin')
                            ->default('-')
                            ->columnSpan(1),

                        TextEntry::make('billing_address.state')
                            ->label(__('filament.resources.orders.fields.state'))
                            ->default('-')
                            ->columnSpan(1),

                        TextEntry::make('billing_address.postal_code')
                            ->label(__('filament.resources.orders.fields.postal_code'))
                            ->default('-')
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                // === ADDITIONAL INFORMATION ===
                Fieldset::make(__('filament.resources.orders.sections.additional_information'))
                    ->schema([
                        TextEntry::make('notes')
                            ->label(__('filament.resources.orders.fields.notes'))
                            ->icon('heroicon-o-document-text')
                            ->default('-')
                            ->columnSpan(3),

                        TextEntry::make('updated_at')
                            ->label(__('filament.resources.orders.fields.updated_at'))
                            ->dateTime('d/m/Y H:i')
                            ->icon('heroicon-o-clock')
                            ->columnSpan(1),

                        TextEntry::make('deleted_at')
                            ->label(__('filament.resources.orders.fields.deleted_at'))
                            ->dateTime('d/m/Y H:i')
                            ->icon('heroicon-o-trash')
                            ->color('danger')
                            ->visible(fn (Order $record): bool => $record->trashed())
                            ->columnSpan(2),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->hidden(fn ($record) => !$record->notes && !$record->trashed()),
            ]);
    }
}
