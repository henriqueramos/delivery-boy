<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface CountryListValidator
{
    public function availableCountriesList(): array;
    public function isCountryPermitted(string $country): bool;
}
