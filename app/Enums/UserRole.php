<?php

namespace App\Enums;

enum UserRole: string
{
    case admin = 'admin';
    case organizer = 'organizer';
    case participant = 'participant';

    // Tüm değerleri array olarak almak için
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

}
