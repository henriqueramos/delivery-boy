<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface Inventoriable
{
    public function getDescription(): ?string;
    public function setDescription(?string $description = null): self;
    public function getHsCode(): ?string;
    public function setHsCode(?string $hsCode = null): self;
    public function getOriginCountry(): ?string;
    public function setOriginCountry(?string $originCountry = null): self;
    public function getPurchaseUrl(): ?string;
    public function setPurchaseUrl(?string $purchaseUrl = null): self;
    public function getQuantity(): ?string;
    public function setQuantity(?string $quantity = null): self;
    public function getSku(): ?string;
    public function setSku(?string $sku = null): self;
    public function getValue(): ?string;
    public function setValue(?string $value = null): self;
}
