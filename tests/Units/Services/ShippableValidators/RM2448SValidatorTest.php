<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Services\ShippableValidators;

use HenriqueRamos\DeliveryBoy\Enums\{
    Currency,
    CustomsDuties,
    LabelFormats,
    ShippingDeclarationType,
    ShippingServices,
    WeightUnits,
};
use HenriqueRamos\DeliveryBoy\Exceptions\ValidatorException;
use HenriqueRamos\DeliveryBoy\Objects\{
    ProductsBag,
    Shipping,
};
use HenriqueRamosTests\Units\Services\ShippableTestBase;

final class RM2448SValidatorTest extends ShippableTestBase
{
    public function testRM24ValidatorHappyPath(): void
    {
        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                    hsCode: '1243'
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                    hsCode: '41209'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getBritainConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getBritainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::RM24,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '10',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $result = $this->validator->validate($shipping);

        $this->assertNull($result);
    }

    public function testRM24ValidatorBadPath(): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessageMatches('/exceeded.weight/');

        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                    hsCode: '1243'
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                    hsCode: '41209'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getBritainConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getBritainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::RM24,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '1000',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $this->validator->validate($shipping);
    }

    public function testRM24SValidatorHappyPath(): void
    {
        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                    hsCode: '1243'
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                    hsCode: '41209'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getBritainConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getBritainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::RM24S,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '10',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $result = $this->validator->validate($shipping);

        $this->assertNull($result);
    }

    public function testRM24SValidatorBadPath(): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessageMatches('/exceeded.weight/');

        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                    hsCode: '1243'
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                    hsCode: '41209'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getBritainConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getBritainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::RM24S,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '1000',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $this->validator->validate($shipping);
    }

    public function testRM48ValidatorHappyPath(): void
    {
        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                    hsCode: '1243'
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                    hsCode: '41209'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getBritainConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getBritainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::RM48,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '10',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $result = $this->validator->validate($shipping);

        $this->assertNull($result);
    }

    public function testRM48ValidatorBadPath(): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessageMatches('/exceeded.weight/');

        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                    hsCode: '1243'
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                    hsCode: '41209'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getBritainConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getBritainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::RM48,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '1000',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $this->validator->validate($shipping);
    }

    public function testRM48SValidatorHappyPath(): void
    {
        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                    hsCode: '1243'
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                    hsCode: '41209'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getBritainConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getBritainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::RM48S,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '10',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $result = $this->validator->validate($shipping);

        $this->assertNull($result);
    }

    public function testRM48SValidatorBadPath(): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessageMatches('/consigneeAddress.address.country.is.not.available.for.this.service/');

        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                    hsCode: '1243'
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                    hsCode: '41209'
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getFranceConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getBritainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::RM48S,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '1000',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $this->validator->validate($shipping);
    }
}
