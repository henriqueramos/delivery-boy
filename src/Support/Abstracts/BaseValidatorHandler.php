<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Abstracts;

use HenriqueRamos\DeliveryBoy\Support\Interfaces\BaseValidator;
use Throwable;

abstract class BaseValidatorHandler implements BaseValidator
{
    protected $next;

    public function assert(
        bool $assertion,
        Throwable $e
    ): void {
        if ($assertion) {
            return;
        }

        throw $e;
    }
}
