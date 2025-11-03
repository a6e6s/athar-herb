<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum UserType: string implements HasLabel, HasColor, HasIcon
{
    case CUSTOMER = 'customer';
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case SUPPORT = 'support';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::CUSTOMER => __('filament.resources.users.user_types.customer'),
            self::ADMIN => __('filament.resources.users.user_types.admin'),
            self::MANAGER => __('filament.resources.users.user_types.manager'),
            self::SUPPORT => __('filament.resources.users.user_types.support'),
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::CUSTOMER => 'gray',
            self::ADMIN => 'danger',
            self::MANAGER => 'warning',
            self::SUPPORT => 'info',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::CUSTOMER => 'heroicon-o-user',
            self::ADMIN => 'heroicon-o-shield-check',
            self::MANAGER => 'heroicon-o-user-group',
            self::SUPPORT => 'heroicon-o-lifebuoy',
        };
    }
}
