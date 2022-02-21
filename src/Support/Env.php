<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support;

final class Env
{
    public const DOUBLE_QUOTES = '"';

    public static function string(
        string $key,
        string $default = ''
    ): string {
        $envVar = (string) filter_var(getenv($key));

        if (isset($_ENV[$key])) {
            $envVar = (string) filter_var($_ENV[$key]);
        }

        if ($envVar === '') {
            $envVar = $default;
        }

        return trim($envVar, self::DOUBLE_QUOTES);
    }
}
