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
use HenriqueRamos\DeliveryBoy\Objects\Shipping;
use HenriqueRamosTests\TestCase;

final class ShippingTest extends TestCase
{
    public function testShippingObjectTestWithBasicData(): void
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
}
