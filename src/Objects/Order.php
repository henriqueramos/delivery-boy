<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Enums\ResourcesCommands;
use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;

final class Order extends Hydrate
{
    protected $apiKey = null;
    protected $command = null;
    protected $shipping = null;

    public function toArray(): array
    {
        $data = [
            'ApiKey' => $this->getApiKey(),
            'Command' => $this->getCommand(),
            'Shipping' => $this->getShipping(),
        ];

        if ($this->getShipping() instanceof Shipping) {
            $data['Shipping'] = $this->getShipping()
                ->toArray();
        }

        return $data;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(?string $apiKey = null): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function getCommand(): ?string
    {
        if ($this->command instanceof ResourcesCommands) {
            return $this->command->value;
        }

        return $this->command;
    }

    public function setCommand(?ResourcesCommands $command = null): self
    {
        $this->command = $command;

        return $this;
    }

    public function getShipping(): ?Shipping
    {
        return $this->shipping;
    }

    public function setShipping(?Shipping $shipping = null): self
    {
        $this->shipping = $shipping;

        return $this;
    }
}
