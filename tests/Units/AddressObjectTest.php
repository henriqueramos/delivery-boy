<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units;

use HenriqueRamos\DeliveryBoy\Objects\Address;
use HenriqueRamosTests\TestCase;

final class AddressObjectTest extends TestCase
{
    public function testAddressWithBasicData(): void
    {
        $address = new Address([
            'Name' => 'Homer J. Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'City' => 'Springfield',
            'State' => 'MO',
            'Country' => 'US',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test',
        ]);

        $actual = $address->toArray();

        $this->assertArraySubset(['Name' => 'Homer J. Simpson'], $actual);
        $this->assertArraySubset(['AddressLine1' => '742 Evergreen Terrace'], $actual);
        $this->assertArraySubset(['AddressLine2' => 'Residential Zone'], $actual);
        $this->assertArraySubset(['AddressLine3' => null], $actual);
        $this->assertArraySubset(['City' => 'Springfield'], $actual);
        $this->assertArraySubset(['State' => 'MO'], $actual);
        $this->assertArraySubset(['Country' => 'US'], $actual);
        $this->assertArraySubset(['Zip' => '65619'], $actual);
        $this->assertArraySubset(['Phone' => '(939)-555-0113'], $actual);
        $this->assertArraySubset(['Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test'], $actual);
        $this->assertArraySubset(['Vat' => null], $actual);
    }

    public function testAddressWithEmptyInput(): void
    {
        $address = new Address([]);

        $actual = $address->toArray();
        $expected = [
            'AddressLine1' => null,
            'AddressLine2' => null,
            'AddressLine3' => null,
            'City' => null,
            'Company' => null,
            'Country' => null,
            'Email' => null,
            'Name' => null,
            'Phone' => null,
            'State' => null,
            'Vat' => null,
            'Zip' => null,
        ];

        $this->assertEquals($expected, $actual);
    }
}
