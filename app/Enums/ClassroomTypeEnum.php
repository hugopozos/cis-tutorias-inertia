<?php

namespace App\Enums;

enum ClassroomTypeEnum: string
{
    case VIRTUAL = 'virtual';
    case IN_PERSON = 'presencial';

    public static function getValues(): array
    {
        return [
            self::VIRTUAL,
            self::IN_PERSON,
        ];
    }

}
