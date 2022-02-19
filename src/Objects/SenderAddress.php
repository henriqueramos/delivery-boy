<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Objects;

final class SenderAddress extends Address
{
    protected $eori = null;

    public function toArray(): array
    {
        $data = parent::toArray();

        $data['Eori'] = $this->getEori();

        return $data;
    }

    public function getEori(): ?string
    {
        return $this->eori;
    }

    public function setEori(?string $eori = null): self
    {
        $this->eori = $eori;

        return $this;
    }
}
