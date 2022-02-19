<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;

final class Product extends Hydrate
{
    protected $description = null;
    protected $hsCode = null;
    protected $originCountry = null;
    protected $purchaseUrl = null;
    protected $quantity = null;
    protected $sku = null;
    protected $value = null;

    public function toArray(): array
    {
        return [
            'Description' => $this->getDescription(),
            'HSCode' => $this->getHsCode(),
            'OriginCountry' => $this->getOriginCountry(),
            'PurchaseUrl' => $this->getPurchaseUrl(),
            'Quantity' => $this->getQuantity(),
            'Sku' => $this->getSku(),
            'Value' => $this->getValue(),
        ];
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

    public function getHsCode(): ?string
    {
        return $this->hsCode;
    }

    public function setHsCode(?string $hsCode = null): self
    {
        $this->hsCode = $hsCode;

        return $this;
    }

    public function getOriginCountry(): ?string
    {
        return $this->originCountry;
    }

    public function setOriginCountry(?string $originCountry = null): self
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    public function getPurchaseUrl(): ?string
    {
        return $this->purchaseUrl;
    }

    public function setPurchaseUrl(?string $purchaseUrl = null): self
    {
        $this->purchaseUrl = $purchaseUrl;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(?string $quantity = null): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku = null): self
    {
        $this->sku = $sku;

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
}
