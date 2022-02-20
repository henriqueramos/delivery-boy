<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface StateListValidator
{
    public function availableStatesList(): array;
    public function isStatePermitted(string $state, string $country): bool;
}
