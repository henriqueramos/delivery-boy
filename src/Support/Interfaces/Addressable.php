<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface Addressable extends Arrayable
{
    public function getAddressLine1(): ?string;
    public function setAddressLine1(string $addressLine1): self;
    public function getAddressLine2(): ?string;
    public function setAddressLine2(?string $addressLine2 = null): self;
    public function getAddressLine3(): ?string;
    public function setAddressLine3(?string $addressLine3 = null): self;
    public function getCity(): ?string;
    public function setCity(?string $city = null): self;
    public function getCompany(): ?string;
    public function setCompany(?string $company = null): self;
    public function getCountry(): ?string;
    public function setCountry(?string $country = null): self;
    public function getEmail(): ?string;
    public function setEmail(?string $email = null): self;
    public function getName(): ?string;
    public function setName(?string $name = null): self;
    public function getPhone(): ?string;
    public function setPhone(?string $phone = null): self;
    public function getState(): ?string;
    public function setState(?string $state = null): self;
    public function getVat(): ?string;
    public function setVat(?string $vat = null): self;
    public function getZip(): ?string;
    public function setZip(?string $zip = null): self;
}
