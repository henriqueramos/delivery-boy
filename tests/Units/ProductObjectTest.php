<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units;

use HenriqueRamos\DeliveryBoy\Objects\Product;
use HenriqueRamosTests\TestCase;

final class ProductObjectTest extends TestCase
{
    public function testProductObjectTestWithBasicData(): void
    {
        $product = new Product([
            'Description' => 'A Donut Pack',
            'HSCode' => '12345678',
            'OriginCountry' => 'US',
            'PurchaseUrl' => 'http://www.lardladdonuts.test',
            'Quantity' => '5',
            'Sku' => '123456',
            'Value' => '200',
        ]);

        $actual = $product->toArray();

        $expected = [
            'Description' => 'A Donut Pack',
            'HSCode' => '12345678',
            'OriginCountry' => 'US',
            'PurchaseUrl' => 'http://www.lardladdonuts.test',
            'Quantity' => '5',
            'Sku' => '123456',
            'Value' => '200',
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testProductWithEmptyInput(): void
    {
        $product = new Product([]);

        $actual = $product->toArray();
        $expected = [
            'Description' => null,
            'HSCode' => null,
            'OriginCountry' => null,
            'PurchaseUrl' => null,
            'Quantity' => null,
            'Sku' => null,
            'Value' => null,
        ];

        $this->assertEquals($expected, $actual);
    }
}
