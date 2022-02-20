<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Exceptions;

use Exception;
use Throwable;

class ConsigneeException extends Exception
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
