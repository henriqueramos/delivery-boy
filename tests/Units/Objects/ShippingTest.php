<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Objects;

use HenriqueRamos\DeliveryBoy\Enums\Currency;
use HenriqueRamos\DeliveryBoy\Enums\CustomsDuties;
use HenriqueRamos\DeliveryBoy\Enums\DimUnits;
use HenriqueRamos\DeliveryBoy\Enums\LabelFormats;
use HenriqueRamos\DeliveryBoy\Enums\ShippingDeclarationType;
use HenriqueRamos\DeliveryBoy\Enums\ShippingServices;
use HenriqueRamos\DeliveryBoy\Enums\WeightUnits;
use HenriqueRamos\DeliveryBoy\Objects\Shipping;
use HenriqueRamosTests\TestCase;

final class ShippingTest extends TestCase
{
    public function testProductObjectTestWithBasicData(): void
    {
        $product = new Shipping([
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
            'Value' => '500',
            'Weight' => '200',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
        ]);

        $actual = $product->toArray();

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
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testProductWithEmptyInput(): void
    {
        $product = new Shipping([]);

        $actual = $product->toArray();
        $expected = [
            'ConsigneeAddress' => null,
            'ConsignorAddress' => null,
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
        ];

        $this->assertEquals($expected, $actual);
    }
}
