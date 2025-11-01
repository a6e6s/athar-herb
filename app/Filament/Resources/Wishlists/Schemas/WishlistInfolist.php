<?php

namespace App\Filament\Resources\Wishlists\Schemas;

use App\Models\Wishlist;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WishlistInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('product.name')
                    ->label('Product'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Wishlist $record): bool => $record->trashed()),
            ]);
    }
}
