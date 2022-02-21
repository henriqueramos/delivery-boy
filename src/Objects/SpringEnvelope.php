<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

use HenriqueRamos\DeliveryBoy\Enums\ResourcesCommands;
use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;
use HenriqueRamos\DeliveryBoy\Support\Interfaces\Arrayable;

final class SpringEnvelope extends Hydrate
{
    protected $apiKey = null;
    protected $command = null;
    protected $shipping = null;

    public function toArray(): array
    {
        return [
            'Apikey' => $this->getApiKey(),
            'Command' => $this->getCommand(),
            'Shipment' => $this->getShippingRepresentation(),
        ];
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

    public function getShipping(): ?Arrayable
    {
        return $this->shipping;
    }

    public function setShipping(?Arrayable $shipping = null): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    protected function getShippingRepresentation(): ?array
    {
        if ($this->getShipping() instanceof Arrayable) {
            return $this->getShipping()->toArray();
        }

        return $this->getShipping();
    }
}
