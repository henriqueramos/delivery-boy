<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Exceptions;

use Exception;
use Throwable;

class ConsignorException extends Exception
{
    public const PREFIX = 'consignorAddress';

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
