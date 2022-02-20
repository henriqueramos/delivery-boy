<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Enums;

use InvalidArgumentException;

enum WeightUnits: string
{
    case KG = 'kg';
    case LB = 'lb';

    public static function reversed(string $from): string
    {
        return match ($from) {
            self::KG->value => self::LB->value,
            self::LB->value => self::KG->value,
            default => throw new InvalidArgumentException('invalid.\$from.value'),
        };
    }
}
