<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Abstracts;

use HenriqueRamos\DeliveryBoy\Support\Interfaces\ObjectableValidator;

abstract class ObjectValidatorHandler extends BaseValidatorHandler implements ObjectableValidator
{
    public function handle(array $object): ?array
    {
        if (!$this->next) {
            return null;
        }

        return $this->next->handle($object);
    }

    public function next(ObjectableValidator $handler): ObjectableValidator
    {
        $this->next = $handler;

        return $this->next;
    }
}
