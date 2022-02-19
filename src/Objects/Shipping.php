<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Enums\{
    Currency,
    CustomsDuties,
    DimUnits,
    ShippingDeclarationType,
    WeightUnits,
    LabelFormats,
    ShippingServices,
};
use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;

final class Shipping extends Hydrate
{
    protected $labelFormat = LabelFormats::PDF;
    protected $shipperReference = null;
    protected $displayId = null;
    protected $invoiceNumber = null;
    protected $service = null;
    protected $weight = null;
    protected $weightUnit = WeightUnits::KG;
    protected $length = null;
    protected $width = null;
    protected $height = null;
    protected $dimUnit = DimUnits::CM;
    protected $value = null;
    protected $currency = Currency::EURO;
    protected $customsDuty = CustomsDuties::DDU;
    protected $description = null;
    protected $declarationType = ShippingDeclarationType::SALE_OF_GOODS;

    public function toArray(): array
    {
        return [];
    }
}
