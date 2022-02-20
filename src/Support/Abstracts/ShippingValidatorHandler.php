<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Abstracts;

use HenriqueRamos\DeliveryBoy\Support\Interfaces\{
    Shippable,
    ShippingValidator
};

abstract class ShippingValidatorHandler implements ShippingValidator
{
    protected $next;

    public function next(ShippingValidator $handler): ShippingValidator
    {
        $this->next = $handler;

        return $this->next;
    }

    public function handle(Shippable $object): ?Shippable
    {
        if (!$this->next) {
            return null;
        }

        return $this->next->handle($object);
    }
}
