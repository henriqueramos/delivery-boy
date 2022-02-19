<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Http;

use CurlHandle;

class Client
{
    protected $url = null;

    public function __construct(
        string $url
    ) {
        $this->url = $url;
    }

    public function prepareRequest(): CurlHandle
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

    public function doRequest(CurlHandle $request): array
    {
        $error = curl_error($request);
        $httpCode = curl_getinfo($request, CURLINFO_HTTP_CODE);
        $output = curl_exec($request);

        return [];
    }
}
