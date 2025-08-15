<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case ORGANIZER = 'organizer';
    case PARTICIPANT = 'participant';

    // Tüm değerleri array olarak almak için
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }



}
