<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Services;

use HenriqueRamos\DeliveryBoy\Objects\{
    Address,
    Product,
    SenderAddress,
};
use HenriqueRamos\DeliveryBoy\Services\ShippableValidator;
use HenriqueRamosTests\TestCase;

class ShippableTestBase extends TestCase
{
    protected $validator = null;

    public function setUp(): void
    {
        $this->validator = new ShippableValidator();
    }

    protected function getProductItemFixture(
        string $description,
        string $sku,
        string $value = '10',
        string $quantity = '1',
        string $originCountry = 'US',
        ?string $purchaseUrl = null,
        ?string $hsCode = null,
    ): Product {
        return new Product([
            'Description' => $description,
            'HSCode' => $hsCode,
            'OriginCountry' => $originCountry,
            'PurchaseUrl' => $purchaseUrl,
            'Quantity' => $quantity,
            'Sku' => $sku,
            'Value' => $value,
        ]);
    }

    protected function getFranceConsigneeAddressFixture(): Address
    {
        return new Address([
            'Name' => 'Bartholomew Jojo Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'City' => 'Paris',
            'State' => 'IDF',
            'Country' => 'FR',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'bart.eat.my.shorts@springfieldelementaryschool.test',
        ]);
    }

    protected function getBritainConsigneeAddressFixture(): Address
    {
        return new Address([
            'Name' => 'Bartholomew Jojo Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'City' => 'Westminster',
            'State' => 'WSM',
            'Country' => 'GB',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'bart.eat.my.shorts@springfieldelementaryschool.test',
        ]);
    }

    protected function getGermanyConsigneeAddressFixture(): Address
    {
        return new Address([
            'Name' => 'Bart Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'City' => 'Paris',
            'State' => 'BE',
            'Country' => 'DE',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'bart.eat.my.shorts@springfieldelementaryschool.test',
        ]);
    }

    protected function getPortugalConsigneeAddressFixture(): Address
    {
        return new Address([
            'Name' => 'Bart Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'City' => 'Lisboa',
            'State' => '11',
            'Country' => 'PT',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'bart.eat.my.shorts@springfieldelementaryschool.test',
        ]);
    }

    protected function getUSAConsigneeAddressFixture(): Address
    {
        return new Address([
            'Name' => 'Bart Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'City' => 'Springfield',
            'State' => 'MO',
            'Country' => 'US',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'bart.eat.my.shorts@springfieldelementaryschool.test',
        ]);
    }

    protected function getNetherlandsConsigneeAddressFixture(): Address
    {
        return new Address([
            'Name' => 'Bart Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'City' => 'Springfield',
            'State' => 'ZH',
            'Country' => 'NL',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'bart.eat.my.shorts@springfieldelementaryschool.test',
        ]);
    }

    protected function getItalyConsigneeAddressFixture(): Address
    {
        return new Address([
            'Name' => 'Bart Simpson',
            'AddressLine1' => '742 Evergreen Terrace',
            'AddressLine2' => 'Residential Zone',
            'City' => 'Milano',
            'State' => 'MI',
            'Country' => 'IT',
            'Zip' => '65619',
            'Phone' => '(939)-555-0113',
            'Email' => 'bart.eat.my.shorts@springfieldelementaryschool.test',
        ]);
    }

    protected function getCanadaConsignorAddressFixture(): Address
    {
        return new SenderAddress([
            'Name' => 'Homer J. Simpson',
            'AddressLine1' => 'Walnut Street',
            'AddressLine2' => 'Moe\'s Tavern',
            'City' => 'Springfield',
            'Company' => 'Moe\'s Tavern',
            'Country' => 'CA',
            'Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test',
            'Eori' => '12345678',
            'Phone' => '(939)-555-1743',
            'State' => 'BC',
            'Zip' => '65619',
        ]);
    }

    protected function getBritainConsignorAddressFixture(): Address
    {
        return new SenderAddress([
            'Name' => 'Homer J. Simpson',
            'AddressLine1' => 'Walnut Street',
            'AddressLine2' => 'Moe\'s Tavern',
            'City' => 'Westminster',
            'Company' => 'Moe\'s Tavern',
            'Country' => 'GB',
            'Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test',
            'Eori' => '12345678',
            'Phone' => '(939)-555-1743',
            'State' => 'WSM',
            'Zip' => '65619',
        ]);
    }

    protected function getSpainConsignorAddressFixture(): Address
    {
        return new SenderAddress([
            'Name' => 'Homer J. Simpson',
            'AddressLine1' => 'Walnut Street',
            'AddressLine2' => 'Moe\'s Tavern',
            'City' => 'Barcelona',
            'Company' => 'Moe\'s Tavern',
            'Country' => 'ES',
            'Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test',
            'Eori' => '12345678',
            'Phone' => '(939)-555-1743',
            'State' => 'B',
            'Zip' => '65619',
        ]);
    }
}
