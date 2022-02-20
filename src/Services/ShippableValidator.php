<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Services;

use HenriqueRamos\DeliveryBoy\Enums\ShippingServices;
use HenriqueRamos\DeliveryBoy\Support\Interfaces\Shippable;
use HenriqueRamos\DeliveryBoy\Validators\PPLEUValidator;
use InvalidArgumentException;

class ShippableValidator
{
    public const CANNOT_FIND_VALIDATOR_FOR_SHIPPABLE = 'cannot.find.a.validator.for.this.shippable';

    public function validate(Shippable $object): ?Shippable
    {
        $service = $object->getService();

        $validator = match ($service) {
            ShippingServices::PPLEU->value => new PPLEUValidator(),
            default => throw new InvalidArgumentException(self::CANNOT_FIND_VALIDATOR_FOR_SHIPPABLE),
        };

        return $validator->handle($object);
    }
}
