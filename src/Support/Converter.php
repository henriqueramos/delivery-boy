<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support;

use InvalidArgumentException;
use HenriqueRamos\DeliveryBoy\Enums\WeightUnits;

class Converter
{
    public static function weight(
        int|float $value,
        string $from,
        string $to
    ): float {
        if ($from === $to) {
            throw new InvalidArgumentException('\$from.and.\$to.should.be.different');
        }

        $result = match (true) {
            ($from === WeightUnits::KG->value && $to === WeightUnits::LB->value) => ceil($value * 2.20462),
            ($from === WeightUnits::LB->value && $to === WeightUnits::KG->value) => ceil($value / 2.20462),
            default => throw new InvalidArgumentException('choose.a.valid.\$from.and.\$to')
        };

        return $result;
    }
}
