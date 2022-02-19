<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface Enumerable
{
    /**
     * Determine if the collection is empty or not.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Determine if the collection is not empty.
     *
     * @return bool
     */
    public function isNotEmpty(): bool;
}
