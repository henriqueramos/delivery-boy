<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface ShippingValidator
{
    public function handle(Shippable $object): ?Shippable;
    public function next(ShippingValidator $validationChain): ShippingValidator;
}
