<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Traits;

trait StateValidator
{
    public function availableStatesList(): array
    {
        return [
            /**
             * Extracted from here @see https://www.iso.org/obp/ui/#iso:code:3166:US
             */
            'US' => [
                'AL' => 1,
                'AK' => 1,
                'AS' => 1,
                'AZ' => 1,
                'AR' => 1,
                'CA' => 1,
                'CO' => 1,
                'CT' => 1,
                'DE' => 1,
                'DC' => 1,
                'FM' => 1,
                'FL' => 1,
                'GA' => 1,
                'GU' => 1,
                'HI' => 1,
                'ID' => 1,
                'IL' => 1,
                'IN' => 1,
                'IA' => 1,
                'KS' => 1,
                'KY' => 1,
                'LA' => 1,
                'ME' => 1,
                'MH' => 1,
                'MD' => 1,
                'MA' => 1,
                'MI' => 1,
                'MN' => 1,
                'MS' => 1,
                'MO' => 1,
                'MT' => 1,
                'NE' => 1,
                'NV' => 1,
                'NH' => 1,
                'NJ' => 1,
                'NM' => 1,
                'NY' => 1,
                'NC' => 1,
                'ND' => 1,
                'MP' => 1,
                'OH' => 1,
                'OK' => 1,
                'OR' => 1,
                'PW' => 1,
                'PA' => 1,
                'PR' => 1,
                'RI' => 1,
                'SC' => 1,
                'SD' => 1,
                'TN' => 1,
                'TX' => 1,
                'UT' => 1,
                'VT' => 1,
                'VI' => 1,
                'VA' => 1,
                'WA' => 1,
                'WV' => 1,
                'WI' => 1,
                'WY' => 1,
            ],
            /**
             * Extracted from here @see https://www.iso.org/obp/ui/#iso:code:3166:CA
             */
            'CA' => [
                'AB' => 1,
                'BC' => 1,
                'MB' => 1,
                'NB' => 1,
                'NL' => 1,
                'NT' => 1,
                'NS' => 1,
                'NU' => 1,
                'ON' => 1,
                'PE' => 1,
                'QC' => 1,
                'SK' => 1,
                'YT' => 1,
            ],
            /**
             * Extracted from here @see https://www.iso.org/obp/ui/#iso:code:3166:AU
             */
            'AU' => [
                'ACT' => 1,
                'NSW' => 1,
                'NT' => 1,
                'QLD' => 1,
                'SA' => 1,
                'TAS' => 1,
                'VIC' => 1,
                'WA' => 1,
            ]
        ];
    }

    public function isStatePermitted(string $state, string $country): bool
    {
        $countryCapitalized = strtoupper($country);
        $stateCapitalized = strtoupper($state);

        // Only did validation against countries on $availableCountryStatesValidation
        if (!isset($this->availableCountryStatesValidation[$countryCapitalized])) {
            return true;
        }

        return isset($this->availableStatesList()[$countryCapitalized][$stateCapitalized]);
    }
}
