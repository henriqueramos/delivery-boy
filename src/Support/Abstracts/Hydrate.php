<?php declare(strict_types = 1);

namespace HenriqueRamos\DeliveryBoy\Support\Abstracts;

use HenriqueRamos\DeliveryBoy\Support\Interfaces\Arrayable;
use HenriqueRamos\DeliveryBoy\Support\Str;

abstract class Hydrate implements Arrayable
{
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    abstract public function toArray(): array;

    public function hydrate(array $data = []): self
    {
        foreach ($data as $key => $value) {
            $convertedKey = ucwords(Str::camel($key));
            $method = 'set' . $convertedKey;

            if (!method_exists($this, $method)) {
                continue;
            }

            $this->$method($value);
        }

        return $this;
    }
}
