<?php

namespace App\Enums;

enum ScheduleStatusEnum:string
{
    case AVAILABLE = 'disponible';
    case FULL = 'lleno';
    case CANCELLED = 'cancelado';
    case COMPLETED = 'finalizado';

    public static function getValues(): array
    {
        return [
            self::AVAILABLE,
            self::FULL,
            self::CANCELLED,
            self::COMPLETED,
        ];
    }

}
