<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('filament.resources.orders.fields.user_id'))
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('order_number')
                    ->label(__('filament.resources.orders.fields.order_number'))
                    ->required(),
                TextInput::make('total_amount')
                    ->label(__('filament.resources.orders.fields.total_amount'))
                    ->required()
                    ->numeric(),
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
                    ->required(),
                Textarea::make('shipping_address')
                    ->label(__('filament.resources.orders.fields.shipping_address'))
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('billing_address')
                    ->label(__('filament.resources.orders.fields.billing_address'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
