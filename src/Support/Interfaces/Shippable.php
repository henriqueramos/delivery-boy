<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

use HenriqueRamos\DeliveryBoy\Enums\{
    Currency,
    CustomsDuties,
    DimUnits,
    LabelFormats,
    ShippingDeclarationType,
    ShippingServices,
    WeightUnits
};

interface Shippable
{
    public function isShippable(): bool;
    public function isNotShippable(): bool;
    public function getConsignorAddress(): ?Addressable;
    public function setConsignorAddress(?Addressable $consignorAddress = null): self;
    public function getConsigneeAddress(): ?Addressable;
    public function setConsigneeAddress(?Addressable $consigneeAddress = null): self;
    public function getCurrency(): ?string;
    public function setCurrency(?Currency $currency = null): self;
    public function getCustomsDuty(): ?string;
    public function setCustomsDuty(?CustomsDuties $customsDuty = null): self;
    public function getDeclarationType(): ?string;
    public function setDeclarationType(
        ?ShippingDeclarationType $declarationType = null
    ): self;
    public function getDescription(): ?string;
    public function setDescription(?string $description = null): self;
    public function getDimUnit(): ?string;
    public function setDimUnit(?DimUnits $dimUnit = null): self;
    public function getDisplayId(): ?string;
    public function setDisplayId(?string $displayId = null): self;
    public function getHeight(): ?string;
    public function setHeight(?string $height = null): self;
    public function getInvoiceNumber(): ?string;
    public function setInvoiceNumber(?string $invoiceNumber = null): self;
    public function getLabelFormat(): ?string;
    public function setLabelFormat(?LabelFormats $labelFormat = null): self;
    public function getLength(): ?string;
    public function setLength(?string $length = null): self;
    public function getProducts(): ?Baggable;
    public function setProducts(?Baggable $products = null): self;
    public function getService(): ?string;
    public function setService(?ShippingServices $service = null): self;
    public function getShipperReference(): ?string;
    public function setShipperReference(?string $shipperReference = null): self;
    public function getSource(): ?string;
    public function setSource(?string $source = null): self;
    public function getValue(): ?string;
    public function setValue(?string $value = null): self;
    public function getWeight(): ?string;
    public function setWeight(?string $weight = null): self;
    public function getWeightUnit(): ?string;
    public function setWeightUnit(?WeightUnits $weightUnit = null): self;
    public function getWidth(): ?string;
    public function setWidth(?string $width = null): self;
}
