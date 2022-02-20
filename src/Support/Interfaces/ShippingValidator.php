<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

use Throwable;

interface ShippingValidator
{
    public function assert(bool $assertion, Throwable $e): void;
    public function handle(Shippable $object): ?Shippable;
    public function next(ShippingValidator $validationChain): ShippingValidator;
}
