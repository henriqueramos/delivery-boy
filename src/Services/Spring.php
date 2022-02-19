<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Services;

use CurlHandle;
use HenriqueRamos\DeliveryBoy\Support\Http\Client;
use InvalidArgumentException;

final class Spring
{
    protected $client = null;
    protected $payload = null;
    protected $uri = null;

    public function __construct()
    {
        if (($apiUri = getenv('API_URL')) === false) {
            throw new InvalidArgumentException('fill.API_URL.env');
        }

        $this->setUri($apiUri);
        $this->client = new Client($this->getUri());
    }

    public function post(): array
    {
        $request = $this->client->prepareRequest();

        curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($request, CURLOPT_POSTFIELDS, $this->getPayload());

        $result = $this->client->doRequest($request);

        return $result;
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

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(?string $uri = null): self
    {
        $this->uri = $uri;

        return $this;
    }
}
