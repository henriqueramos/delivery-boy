<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Abstracts;

use HenriqueRamos\DeliveryBoy\Support\Interfaces\{
    Shippable,
    ShippingValidator
};
use Throwable;

abstract class ShippingValidatorHandler implements ShippingValidator
{
    protected $next;

    public $availableCountryStatesValidation = [
        'AU' => 1,
        'CA' => 1,
        'US' => 1,
    ];

    public function assert(
        bool $assertion,
        Throwable $e
    ): void {
        if (!$assertion) {
            return;
        }

        throw $e;
    }

    public function handle(Shippable $object): ?Shippable
    {
        if (!$this->next) {
            return null;
        }

        return $this->next->handle($object);
    }

    public function next(ShippingValidator $handler): ShippingValidator
    {
        $this->next = $handler;

        return $this->next;
    }
}
