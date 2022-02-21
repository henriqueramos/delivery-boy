<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Enums\LabelFormats;
use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;

final class Label extends Hydrate
{
    protected $labelFormat = LabelFormats::PDF;
    protected $shipperReference = null;
    protected $trackingNumber = null;

    public function toArray(): array
    {
        return [
            'LabelFormat' => $this->getLabelFormat(),
            'ShipperReference' => $this->getShipperReference(),
            'TrackingNumber' => $this->getTrackingNumber(),
        ];
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

    public function getShipperReference(): ?string
    {
        return $this->shipperReference;
    }

    public function setShipperReference(?string $shipperReference = null): self
    {
        $this->shipperReference = $shipperReference;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(?string $trackingNumber = null): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }
}
