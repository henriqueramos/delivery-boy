<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Objects;

use HenriqueRamos\DeliveryBoy\Enums\{
    Currency,
    CustomsDuties,
    DimUnits,
    LabelFormats,
    ResourcesCommands,
    ShippingDeclarationType,
    ShippingServices,
    WeightUnits,
};
use HenriqueRamos\DeliveryBoy\Objects\{
    Address,
    Order,
    ProductsBag,
    Product,
    Shipping,
};
use HenriqueRamosTests\TestCase;

final class OrderTest extends TestCase
{
    public function testOrderObjectTestWithBasicData(): void
    {
        $products = new ProductsBag([
            'products' => [
                $this->getProductItem(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20'
                ),
                $this->getProductItem(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getConsigneeAddress('Bartholomew Jojo Simpson'),
            'ConsignorAddress' => $this->getConsignorAddress('Homer J. Simpson'),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Enjoy your miserable life kiddo!',
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
            'Products' => $products,
        ]);

        $product = new Order([
            'apiKey' => 'ABC',
            'command' => ResourcesCommands::ORDER_SHIPMENT,
            'shipping' => $shipping,
        ]);

        $actual = $product->toArray();

        $expected = [
            'ApiKey' => 'ABC',
            'Command' => ResourcesCommands::ORDER_SHIPMENT->value,
            'Shipping' => [
                'ConsigneeAddress' => [
                    'Name' => 'Bartholomew Jojo Simpson',
                    'AddressLine1' => '742 Evergreen Terrace',
                    'AddressLine2' => 'Residential Zone',
                    'City' => 'Springfield',
                    'State' => 'MO',
                    'Country' => 'US',
                    'Zip' => '65619',
                    'Phone' => '(939)-555-0113',
                    'Email' => 'bart.eat.my.shorts@springfieldelementaryschool.test',
                    'Vat' => null,
                ],
                'ConsignorAddress' => [
                    'Name' => 'Homer J. Simpson',
                    'AddressLine1' => 'Walnut Street',
                    'AddressLine2' => 'Moe\'s Tavern',
                    'City' => 'Springfield',
                    'State' => 'MO',
                    'Country' => 'US',
                    'Zip' => '65619',
                    'Phone' => '(939)-555-1743',
                    'Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test',
                    'Eori' => '12345678',
                    'Vat' => null,
                ],
                'Currency' => Currency::BRAZILIAN_REAL->value,
                'CustomsDuty' => CustomsDuties::DDP->value,
                'DeclarationType' => ShippingDeclarationType::GIFT->value,
                'Description' => 'Enjoy your miserable life kiddo!',
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
                'Products' => [
                    [
                        'Description' => 'Product A',
                        'HSCode' => null,
                        'OriginCountry' => 'US',
                        'PurchaseUrl' => null,
                        'Quantity' => '2',
                        'Sku' => '5436812',
                        'Value' => '20',
                    ],
                    [
                        'Description' => 'Product B',
                        'HSCode' => null,
                        'OriginCountry' => 'US',
                        'PurchaseUrl' => null,
                        'Quantity' => '5',
                        'Sku' => '981238',
                        'Value' => '20',
                    ],
                ],
            ],
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testOrderWithEmptyInput(): void
    {
        $product = new Order([]);

        $actual = $product->toArray();
        $expected = [
            'ApiKey' => null,
            'Command' => null,
            'Shipping' => null,
        ];

        $this->assertEquals($expected, $actual);
    }

    protected function getProductItem(
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

    protected function getConsigneeAddress(string $name): Address
    {
        return new Address([
            'Name' => $name,
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

    protected function getConsignorAddress(string $name): Address
    {
        return new Address([
            'Name' => $name,
            'AddressLine1' => 'Walnut Street',
            'AddressLine2' => 'Moe\'s Tavern',
            'City' => 'Springfield',
            'State' => 'MO',
            'Country' => 'US',
            'Zip' => '65619',
            'Phone' => '(939)-555-1743',
            'Email' => 'homer.da.best.simpson@springfieldnuclearpowerplant.test',
            'Eori' => '12345678',
        ]);
    }
}
