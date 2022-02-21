<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Services;

use HenriqueRamos\DeliveryBoy\Enums\ShippingServices;
use HenriqueRamos\DeliveryBoy\Exceptions\UndefinedValidator;
use HenriqueRamos\DeliveryBoy\Support\Interfaces\Shippable;
use HenriqueRamos\DeliveryBoy\Validators\{
    HEHDSValidator,
    ITCRValidator,
    PPLEUValidator,
    PPLGEGUValidator,
    PPNHDSDSHValidator,
    PPTRNTValidator,
    PPTTValidator,
    RM2448SValidator,
    SCSTSEXSValidator,
    SENDSValidator,
};

class ShippableValidator
{
    public const CANNOT_FIND_VALIDATOR_FOR_SHIPPABLE = 'cannot.find.a.validator.for.this.shippable';

    public function validate(Shippable $object): ?Shippable
    {
        $service = $object->getService();

        $validator = match ($service) {
            ShippingServices::PPLEU->value => new PPLEUValidator(),
            ShippingServices::PPLGE->value => new PPLGEGUValidator(),
            ShippingServices::PPLGU->value => new PPLGEGUValidator(),
            ShippingServices::RM24->value => new RM2448SValidator(),
            ShippingServices::RM24S->value => new RM2448SValidator(),
            ShippingServices::RM48->value => new RM2448SValidator(),
            ShippingServices::RM48S->value => new RM2448SValidator(),
            ShippingServices::PPTT->value => new PPTTValidator(),
            ShippingServices::PPTR->value => new PPTRNTValidator(),
            ShippingServices::PPNT->value => new PPTRNTValidator(),
            ShippingServices::SEND->value => new SENDSValidator(),
            ShippingServices::SEND2->value => new SENDSValidator(),
            ShippingServices::ITCR->value => new ITCRValidator(),
            ShippingServices::HEHDS->value => new HEHDSValidator(),
            ShippingServices::SCST->value => new SCSTSEXSValidator(),
            ShippingServices::SCSTS->value => new SCSTSEXSValidator(),
            ShippingServices::SCEX->value => new SCSTSEXSValidator(),
            ShippingServices::SCEXS->value => new SCSTSEXSValidator(),
            ShippingServices::PPND->value => new PPNHDSDSHValidator(),
            ShippingServices::PPNDS->value => new PPNHDSDSHValidator(),
            ShippingServices::PPHD->value => new PPNHDSDSHValidator(),
            ShippingServices::PPHDS->value => new PPNHDSDSHValidator(),
            default => throw new UndefinedValidator(self::CANNOT_FIND_VALIDATOR_FOR_SHIPPABLE),
        };

        return $validator->handle($object);
    }
}
