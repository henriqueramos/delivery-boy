<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Objects;

use HenriqueRamos\DeliveryBoy\Enums\{
    Currency,
    CustomsDuties,
    DimUnits,
    LabelFormats,
    ShippingDeclarationType,
    ShippingServices,
    WeightUnits,
};
use HenriqueRamos\DeliveryBoy\Objects\Address;
use HenriqueRamos\DeliveryBoy\Objects\SenderAddress;
use HenriqueRamos\DeliveryBoy\Objects\Shipping;
use HenriqueRamosTests\TestCase;

final class ShippingTest extends TestCase
{
    public function testShippingObjectTestWithBasicData(): void
    {
        $shipping = new Shipping([
            'Description' => 'A gift for you, Margie! S2',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::PPTT,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '200',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
        ]);

        $actual = $shipping->toArray();

        $expected = [
            'Description' => 'A gift for you, Margie! S2',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG->value,
            'Length' => '20',
            'Service' => ShippingServices::PPTT->value,
            'ShipperReference' => 'Reference_001',
            'Value' => '500',
            'Weight' => '200',
            'WeightUnit' => WeightUnits::KG->value,
            'Width' => '30',
            'Source' => 'NotDeliveryBoy',
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testShippingObjectTestWithAddresses(): void
    {
        $consigor = new SenderAddress([
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

        $consigee = new Address([
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

        $shipping = new Shipping([
            'ConsigneeAddress' => $consigee,
            'ConsignorAddress' => $consigor,
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'A gift for you, Margie! S2',
            'DimUnit' => DimUnits::CM,
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::PPTT,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '200',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
        ]);

        $actual = $shipping->toArray();

        $expected = [
            'Currency' => Currency::BRAZILIAN_REAL->value,
            'CustomsDuty' => CustomsDuties::DDP->value,
            'DeclarationType' => ShippingDeclarationType::GIFT->value,
            'Description' => 'A gift for you, Margie! S2',
            'DimUnit' => DimUnits::CM->value,
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG->value,
            'Length' => '20',
            'Service' => ShippingServices::PPTT->value,
            'ShipperReference' => 'Reference_001',
            'Value' => '500',
            'Weight' => '200',
            'WeightUnit' => WeightUnits::KG->value,
            'Width' => '30',
            'Source' => 'NotDeliveryBoy',
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testShippingIsShippable(): void
    {
        $shipping = new Shipping([
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'A gift for you, Margie! S2',
            'DimUnit' => DimUnits::CM,
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::PPTT,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '200',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
        ]);

        $this->assertEquals(
            true,
            $shipping->isShippable()
        );
    }

    public function testShippingIsNotShippable(): void
    {
        $shipping = new Shipping([
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'A gift for you, Margie! S2',
            'DimUnit' => DimUnits::CM,
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::PPTT,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
        ]);

        $this->assertEquals(
            true,
            $shipping->isNotShippable()
        );
    }

    public function testShippingWithEmptyInput(): void
    {
        $shipping = new Shipping([]);

        $actual = $shipping->toArray();
        $expected = [
            'ConsigneeAddress' => null,
            'ConsignorAddress' => null,
            'Currency' => Currency::EURO->value,
            'CustomsDuty' => CustomsDuties::DDU->value,
            'DeclarationType' => ShippingDeclarationType::SALE_OF_GOODS->value,
            'Description' => null,
            'DimUnit' => DimUnits::CM->value,
            'DisplayId' => null,
            'Height' => null,
            'InvoiceNumber' => null,
            'LabelFormat' => LabelFormats::PDF->value,
            'Length' => null,
            'Products' => null,
            'Service' => null,
            'ShipperReference' => null,
            'Value' => null,
            'Weight' => null,
            'WeightUnit' => WeightUnits::KG->value,
            'Width' => null,
            'Source' => Shipping::SOURCE_DEFAULT
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testShippingWithNullableParameters(): void
    {
        $shipping = new Shipping([
            'Currency' => null,
            'CustomsDuty' => null,
            'DeclarationType' => null,
            'Description' => null,
            'DimUnit' => null,
            'DisplayId' => null,
            'Height' => null,
            'InvoiceNumber' => null,
            'LabelFormat' => null,
            'Length' => null,
            'Service' => null,
            'ShipperReference' => null,
            'Source' => null,
            'Value' => null,
            'WeightUnit' => null,
            'Width' => null,
        ]);

        $expected = [
            'Currency' => null,
            'CustomsDuty' => null,
            'DeclarationType' => null,
            'Description' => null,
            'DimUnit' => null,
            'DisplayId' => null,
            'Height' => null,
            'InvoiceNumber' => null,
            'LabelFormat' => null,
            'Length' => null,
            'Service' => null,
            'ShipperReference' => null,
            'Value' => null,
            'Weight' => null,
            'WeightUnit' => null,
            'Width' => null,
            'Source' => null,
        ];

        $this->assertArraySubset(
            $expected,
            $shipping->toArray()
        );
    }
}
