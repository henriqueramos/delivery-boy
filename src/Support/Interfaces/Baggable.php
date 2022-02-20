<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface Baggable extends Enumerable, Arrayable
{
    public function getProducts(): array;
    public function setProducts(?array $products = null): self;
    public function clearProducts(): self;
    public function addProduct(Inventoriable $product = null): self;
}
