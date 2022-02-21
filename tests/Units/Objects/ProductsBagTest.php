<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Objects;

use HenriqueRamos\DeliveryBoy\Objects\Product;
use HenriqueRamos\DeliveryBoy\Objects\ProductsBag;
use HenriqueRamosTests\TestCase;

final class ProductsBagTest extends TestCase
{
    public function testProductsBagTestWithBasicData(): void
    {
        $productsBag = new ProductsBag([
            'products' => [
                new Product([
                    'Description' => 'Product A',
                ]),
                new Product([
                    'Description' => 'Product B',
                ]),
            ],
        ]);

        $actual = $productsBag->toArray();

        $expected = [
            [
                'Description' => 'Product A',
                'HSCode' => null,
                'OriginCountry' => null,
                'PurchaseUrl' => null,
                'Quantity' => null,
                'Sku' => null,
                'Value' => null,
            ],
            [
                'Description' => 'Product B',
                'HSCode' => null,
                'OriginCountry' => null,
                'PurchaseUrl' => null,
                'Quantity' => null,
                'Sku' => null,
                'Value' => null
            ]
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testProductsBagWithEmptyInput(): void
    {
        $productsBag = new ProductsBag([]);

        $this->assertEquals([], $productsBag->toArray());
    }

    public function testProductsBagIsEmpty(): void
    {
        $productsBag = new ProductsBag([]);

        $this->assertTrue($productsBag->isEmpty());
    }

    public function testProductsBagIsNotEmpty(): void
    {
        $productsBag = new ProductsBag([
            'products' => [
                new Product([
                    'Description' => 'Product A',
                ]),
                new Product([
                    'Description' => 'Product B',
                ]),
            ],
        ]);

        $this->assertTrue($productsBag->isNotEmpty());
    }

    public function testProductsBagAddProductUsingSetter(): void
    {
        $productsBag = new ProductsBag();
        $productsBag->setProducts([
            new Product([
                'Description' => 'Product A',
            ])
        ]);

        $this->assertTrue($productsBag->isNotEmpty());
    }

    public function testProductsBagClearUsingSetters(): void
    {
        $productsBag = new ProductsBag();
        $productsBag->setProducts([]);

        $this->assertFalse($productsBag->isNotEmpty());
    }

    public function testProductsBagClearIt(): void
    {
        $productsBag = new ProductsBag([
            'products' => [
                new Product([
                    'Description' => 'Product A',
                ]),
                new Product([
                    'Description' => 'Product B',
                ]),
            ],
        ]);

        $productsBag->clearProducts();

        $this->assertTrue($productsBag->isEmpty());
    }
}
