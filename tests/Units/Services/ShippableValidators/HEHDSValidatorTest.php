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

final class HEHDSValidatorTest extends ShippableTestBase
{
    protected $validator = null;

    public function testHEHDSValidatorHappyPath(): void
    {
        $products = new ProductsBag([
            'products' => [
                $this->getProductItemFixture(
                    description: 'Product A',
                    sku: '5436812',
                    quantity: '2',
                    value: '20',
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getGermanyConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getSpainConsignorAddressFixture(),
            'Currency' => Currency::USA_DOLLAR,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::HEHDS,
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

    public function testHEHDSValidatorBadPath(): void
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
                ),
                $this->getProductItemFixture(
                    description: 'Product B',
                    quantity: '5',
                    sku: '981238',
                    value: '20',
                ),
            ],
        ]);

        $shipping = new Shipping([
            'ConsigneeAddress' => $this->getPortugalConsigneeAddressFixture(),
            'ConsignorAddress' => $this->getSpainConsignorAddressFixture(),
            'Currency' => Currency::BRAZILIAN_REAL,
            'CustomsDuty' => CustomsDuties::DDP,
            'DeclarationType' => ShippingDeclarationType::GIFT,
            'Description' => 'Hold on my beer',
            'DisplayId' => '123450000',
            'Height' => '50',
            'InvoiceNumber' => '678900000',
            'LabelFormat' => LabelFormats::PNG,
            'Length' => '20',
            'Service' => ShippingServices::HEHDS,
            'ShipperReference' => 'Reference_001',
            'Source' => 'NotDeliveryBoy',
            'Value' => '500',
            'Weight' => '234',
            'WeightUnit' => WeightUnits::KG,
            'Width' => '30',
            'Products' => $products,
        ]);

        $result = $this->validator->validate($shipping);
    }
}
