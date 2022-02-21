<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Services;

use HenriqueRamos\DeliveryBoy\Enums\ResourcesCommands;
use HenriqueRamos\DeliveryBoy\Exceptions\SpringException;
use HenriqueRamos\DeliveryBoy\Support\Http\Client;

final class Spring
{
    protected $client = null;
    protected $command = null;
    protected $payload = null;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function doPost(): string
    {
        $response = $this->client->doPost($this->getPayload());

        return $this->parseResponse($response);
    }

    public function parseResponse(string $response): string
    {
        $parsed = json_decode($response, true);

        if (
            !isset($parsed['ErrorLevel']) ||
            !isset($parsed['Error'])
        ) {
            throw new SpringException('invalid.response.from.3rd.party');
        }

        $errorLevel = $parsed['ErrorLevel'];
        $errorMessage = $parsed['Error'];

        if (
            $errorLevel === 10 ||
            ($errorLevel !== 1 && $errorLevel !== 0)
        ) {
            throw new SpringException($errorMessage, $errorLevel);
        }

        $result = match ($this->command) {
            ResourcesCommands::ORDER_SHIPMENT => $this->parseTrackingNumber($parsed),
            ResourcesCommands::GET_SHIPMENT_LABEL => $this->parseLabel($parsed),
            default => $this->parseTrackingNumber($parsed),
        };

        return $result;
    }

    public function parseTrackingNumber(array $parsed): string
    {
        if (
            !isset($parsed['Shipment']) ||
            !isset($parsed['Shipment']['TrackingNumber'])
        ) {
            throw new SpringException('could.not.found.tracking.number');
        }

        return (string) $parsed['Shipment']['TrackingNumber'];
    }

    public function parseLabel(array $parsed): string
    {
        if (
            !isset($parsed['Shipment']) ||
            !isset($parsed['Shipment']['LabelImage'])
        ) {
            throw new SpringException('could.not.found.label');
        }

        return (string) $parsed['Shipment']['LabelImage'];
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function setPayload(?string $payload = null): self
    {
        $this->payload = $payload;

        return $this;
    }

    public function setCommand(?ResourcesCommands $command = null): self
    {
        $this->command = $command;

        return $this;
    }
}
