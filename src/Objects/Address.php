<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;
use HenriqueRamos\DeliveryBoy\Support\Interfaces\Addressable;

class Address extends Hydrate implements Addressable
{
    protected $addressLine1 = null;
    protected $addressLine2 = null;
    protected $addressLine3 = null;
    protected $city = null;
    protected $company = null;
    protected $country = null;
    protected $email = null;
    protected $name = null;
    protected $phone = null;
    protected $state = null;
    protected $vat = null;
    protected $zip = null;

    public function toArray(): array
    {
        return [
            'AddressLine1' => $this->getAddressLine1(),
            'AddressLine2' => $this->getAddressLine2(),
            'AddressLine3' => $this->getAddressLine3(),
            'City' => $this->getCity(),
            'Company' => $this->getCompany(),
            'Country' => $this->getCountry(),
            'Email' => $this->getEmail(),
            'Name' => $this->getName(),
            'Phone' => $this->getPhone(),
            'State' => $this->getState(),
            'Vat' => $this->getVat(),
            'Zip' => $this->getZip(),
        ];
    }

    public function getAddressLine1(): ?string
    {
        return $this->addressLine1;
    }

    public function setAddressLine1(string $addressLine1): self
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    public function setAddressLine2(?string $addressLine2 = null): self
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    public function getAddressLine3(): ?string
    {
        return $this->addressLine3;
    }

    public function setAddressLine3(?string $addressLine3 = null): self
    {
        $this->addressLine3 = $addressLine3;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city = null): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country = null): self
    {
        $this->country = $country;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name = null): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone = null): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state = null): self
    {
        $this->state = $state;

        return $this;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(?string $vat = null): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip = null): self
    {
        $this->zip = $zip;

        return $this;
    }
}
