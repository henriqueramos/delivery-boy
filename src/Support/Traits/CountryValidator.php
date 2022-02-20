<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Traits;

trait CountryValidator
{
    public function availableCountriesList(): array
    {
        return [
            'AU' => 1,
            'AT' => 1,
            'BE' => 1,
            'BR' => 1,
            'BY' => 1,
            'CA' => 1,
            'CH' => 1,
            'HR' => 1,
            'CY' => 1,
            'DK' => 1,
            'EE' => 1,
            'FI' => 1,
            'FR' => 1,
            'DE' => 1,
            'GB' => 1,
            'GR' => 1,
            'HK' => 1,
            'HU' => 1,
            'ID' => 1,
            'IE' => 1,
            'IL' => 1,
            'IT' => 1,
            'LV' => 1,
            'LB' => 1,
            'LT' => 1,
            'LU' => 1,
            'MT' => 1,
            'MY' => 1,
            'NZ' => 1,
            'NO' => 1,
            'NL' => 1,
            'PL' => 1,
            'PT' => 1,
            'RS' => 1,
            'RU' => 1,
            'SG' => 1,
            'SK' => 1,
            'SI' => 1,
            'KR' => 1,
            'ES' => 1,
            'SE' => 1,
            'TR' => 1,
            'US' => 1,
            'IS' => 1,
            'JP' => 1,
            'SA' => 1,
            'TH' => 1,
        ];
    }

    public function isCountryPermitted(string $country): bool
    {
        return isset($this->availableCountriesList()[strtoupper($country)]);
    }
}
