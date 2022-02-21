<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

use Throwable;

interface BaseValidator
{
    public function assert(bool $assertion, Throwable $e): void;
}
