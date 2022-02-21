<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Interfaces;

interface ObjectableValidator
{
    public function handle(array $object): ?array;
    public function next(ObjectableValidator $validationChain): ObjectableValidator;
}
