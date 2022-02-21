<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Validators;

use HenriqueRamos\DeliveryBoy\Exceptions\{
    ConsigneeException,
    ConsignorException,
};
use HenriqueRamos\DeliveryBoy\Objects\{
    Address,
    SenderAddress
};
use HenriqueRamos\DeliveryBoy\Support\Abstracts\ShippingValidatorHandler;
use HenriqueRamos\DeliveryBoy\Support\Interfaces\Shippable;

class BaseValidator extends ShippingValidatorHandler
{
    protected $object;

    public const INVALID_ADDRESS_OBJECT = 'address.is.not.a.valid.type.object';

    public function handle(Shippable $object): ?Shippable
    {
        $this->object = $object;

        $this->assert(
            !($this->object->getConsigneeAddress() instanceof Address),
            new ConsigneeException(self::INVALID_ADDRESS_OBJECT)
        );

        $this->assert(
            !($this->object->getConsignorAddress() instanceof SenderAddress),
            new ConsignorException(self::INVALID_ADDRESS_OBJECT)
        );

        return parent::handle($object);
    }
}
