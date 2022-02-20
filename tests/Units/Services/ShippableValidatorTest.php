<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Services;

use HenriqueRamos\DeliveryBoy\Enums\{
    Currency,
    CustomsDuties,
    LabelFormats,
    ShippingDeclarationType,
    ShippingServices,
    WeightUnits,
};
use HenriqueRamos\DeliveryBoy\Objects\{
    Address,
    SenderAddress,
    Shipping,
};
use HenriqueRamos\DeliveryBoy\Services\ShippableValidator;
use HenriqueRamosTests\TestCase;

final class ShippableValidatorTest extends TestCase
{
    protected $validator = null;

    public function setUp(): void
    {
        $this->validator = new ShippableValidator();
    }

    public function testPPLEUValidator(): void
    {
        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::PPLEU,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '10',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
        ]);

        $result = $this->validator->validate($shipping);

        $this->assertNull($result);
    }

    protected function getConsigneeAddressFixture(): Address
    {
        return new Address([
            'Name' => 'Bartholomew Jojo Simpson',
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

    protected function getConsignorAddressFixture(): Address
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
}
