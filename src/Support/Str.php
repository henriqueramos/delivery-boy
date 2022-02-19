<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support;

final class Str
{
    public static function camel(string $value): string
    {
        return lcfirst(static::studly($value));
    }

    public static function studly(string $value): string
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }
}
