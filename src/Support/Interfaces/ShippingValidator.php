<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface ShippingValidator
{
    public function next(ShippingValidator $validationChain): ShippingValidator;

    public function handle(Shippable $object): ?Shippable;
}
