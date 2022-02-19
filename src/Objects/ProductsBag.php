<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;
use HenriqueRamos\DeliveryBoy\Support\Interfaces\Enumerable;

final class ProductsBag extends Hydrate implements Enumerable
{
    protected $products = [];

    public function isEmpty(): bool
    {
        return count($this->getProducts()) === 0;
    }

    public function isNotEmpty(): bool
    {
        return $this->isEmpty() === false;
    }

    public function toArray(): array
    {
        $data = [];

        foreach ($this->getProducts() as $product) {
            $data[] = $product->toArray();
        }

        return $data;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function clearProducts(): self
    {
        $this->products = [];

        return $this;
    }

    public function addProduct(Product $product = null): self
    {
        $this->products[] = $product;

        return $this;
    }
}
