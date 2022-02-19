<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Services;

use CurlHandle;

final class Spring
{
    protected $payload = null;
    protected $uri = null;

    protected function prepareRequest(): CurlHandle
    {
        $request = curl_init();
        curl_setopt(
            $request,
            CURLOPT_HTTPHEADER,
            ['Content-Type: application/json']
        );
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($request, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

        return $request;
    }

    protected function sendRequest(CurlHandle $request): array
    {
        $error = curl_error($request);
        $httpCode = curl_getinfo($request, CURLINFO_HTTP_CODE);
        $output = curl_exec($request);

        return [];
    }

    public function post(array $data = []): array
    {
        $request = $this->prepareRequest();

        curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($request, CURLOPT_POSTFIELDS, json_encode($data));

        $result = $this->sendRequest($request);

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
