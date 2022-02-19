<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;

final class Order extends Hydrate
{
    public function toArray(): array
    {
        return [];
    }
}
