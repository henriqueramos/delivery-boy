<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Objects;

use HenriqueRamos\DeliveryBoy\Objects\Address;
use HenriqueRamosTests\TestCase;

final class AddressTest extends TestCase
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

        $expected = [
            'Name' => 'Homer J. Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'AddressLine3' => null,
            'City' => 'Springfield',
            'State' => 'MO',
            'Country' => 'US',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test',
            'Vat' => null,
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testAddressWithEoriData(): void
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
            'Eori' => 'GB205672212000',
        ]);

        $actual = $address->toArray();

        $expected = [
            'Name' => 'Homer J. Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'AddressLine3' => null,
            'City' => 'Springfield',
            'State' => 'MO',
            'Country' => 'US',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test',
            'Vat' => null,
            'Eori' => 'GB205672212000',
        ];

        $this->assertArraySubset($expected, $actual);
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
