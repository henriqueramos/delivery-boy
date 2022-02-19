<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Enums\{
    Currency,
    CustomsDuties,
    DimUnits,
    LabelFormats,
    ShippingDeclarationType,
    ShippingServices,
    WeightUnits,
};
use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;

final class Shipping extends Hydrate
{
    protected $currency = Currency::EURO;
    protected $customsDuty = CustomsDuties::DDU;
    protected $declarationType = ShippingDeclarationType::SALE_OF_GOODS;
    protected $description = null;
    protected $dimUnit = DimUnits::CM;
    protected $displayId = null;
    protected $height = null;
    protected $invoiceNumber = null;
    protected $labelFormat = LabelFormats::PDF;
    protected $length = null;
    protected $service = null;
    protected $shipperReference = null;
    protected $value = null;
    protected $weight = null;
    protected $weightUnit = WeightUnits::KG;
    protected $width = null;

    public function toArray(): array
    {
        return [
            'Currency' => $this->getCurrency(),
            'CustomsDuty' => $this->getCustomsDuty(),
            'DeclarationType' => $this->getDeclarationType(),
            'Description' => $this->getDescription(),
            'DimUnit' => $this->getDimUnit(),
            'DisplayId' => $this->getDisplayId(),
            'Height' => $this->getHeight(),
            'InvoiceNumber' => $this->getInvoiceNumber(),
            'LabelFormat' => $this->getLabelFormat(),
            'Length' => $this->getLength(),
            'Service' => $this->getService(),
            'ShipperReference' => $this->getShipperReference(),
            'Value' => $this->getValue(),
            'Weight' => $this->getWeight(),
            'WeightUnit' => $this->getWeightUnit(),
            'Width' => $this->getWidth(),
        ];
    }

    public function getCurrency(): ?string
    {
        if ($this->currency instanceof Currency) {
            return $this->currency->value;
        }

        return $this->currency;
    }

    public function setCurrency(?Currency $currency = null): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCustomsDuty(): ?string
    {
        if ($this->customsDuty instanceof CustomsDuties) {
            return $this->customsDuty->value;
        }

        return $this->customsDuty;
    }

    public function setCustomsDuty(?CustomsDuties $customsDuty = null): self
    {
        $this->customsDuty = $customsDuty;

        return $this;
    }

    public function getDeclarationType(): ?string
    {
        if ($this->declarationType instanceof ShippingDeclarationType) {
            return $this->declarationType->value;
        }

        return $this->declarationType;
    }

    public function setDeclarationType(
        ?ShippingDeclarationType $declarationType = null
    ): self {
        $this->declarationType = $declarationType;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDimUnit(): ?string
    {
        if ($this->dimUnit instanceof DimUnits) {
            return $this->dimUnit->value;
        }

        return $this->dimUnit;
    }

    public function setDimUnit(?DimUnits $dimUnit = null): self
    {
        $this->dimUnit = $dimUnit;

        return $this;
    }

    public function getDisplayId(): ?string
    {
        return $this->displayId;
    }

    public function setDisplayId(?string $displayId = null): self
    {
        $this->displayId = $displayId;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(?string $height = null): self
    {
        $this->height = $height;

        return $this;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(?string $invoiceNumber = null): self
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getLabelFormat(): ?string
    {
        if ($this->labelFormat instanceof LabelFormats) {
            return $this->labelFormat->value;
        }

        return $this->labelFormat;
    }

    public function setLabelFormat(?LabelFormats $labelFormat = null): self
    {
        $this->labelFormat = $labelFormat;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(?string $length = null): self
    {
        $this->length = $length;

        return $this;
    }

    public function getService(): ?string
    {
        if ($this->service instanceof ShippingServices) {
            return $this->service->value;
        }

        return $this->service;
    }

    public function setService(?ShippingServices $service = null): self
    {
        $this->service = $service;

        return $this;
    }

    public function getShipperReference(): ?string
    {
        return $this->shipperReference;
    }

    public function setShipperReference(?string $shipperReference = null): self
    {
        $this->shipperReference = $shipperReference;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value = null): self
    {
        $this->value = $value;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeightUnit(): ?string
    {
        if ($this->weightUnit instanceof WeightUnits) {
            return $this->weightUnit->value;
        }

        return $this->weightUnit;
    }

    public function setWeightUnit(?WeightUnits $weightUnit = null): self
    {
        $this->weightUnit = $weightUnit;

        return $this;
    }

    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function setWidth(?string $width = null): self
    {
        $this->width = $width;

        return $this;
    }
}
