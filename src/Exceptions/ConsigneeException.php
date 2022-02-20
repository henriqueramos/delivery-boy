<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Exceptions;

use Throwable;

class ConsigneeException extends ValidatorException
{
    public const PREFIX = 'consigneeAddress';

    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            self::PREFIX . '.' . $message,
            $code,
            $previous
        );
    }
}
