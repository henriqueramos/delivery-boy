<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Support\Http;

use CurlHandle;
use HenriqueRamos\DeliveryBoy\Support\Env;
use InvalidArgumentException;
use RuntimeException;

class Client
{
    public const HTTP_OK = 200;

    protected $url = null;

    public function __construct()
    {
        if (($apiUri = Env::string('API_URL')) === '') {
            throw new InvalidArgumentException('fill.API_URL.environment.variable');
        }

        $this->url = $apiUri;
    }

    public function prepareRequest(): CurlHandle
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, $this->url);
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

    public function doPost(string $payload): string
    {
        $request = $this->prepareRequest();

        curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($request, CURLOPT_POSTFIELDS, $payload);

        return $this->doRequest($request);
    }

    public function doRequest(CurlHandle $request): string
    {
        $output = curl_exec($request);
        $httpCode = curl_getinfo($request, CURLINFO_HTTP_CODE);
        $error = curl_error($request);

        if ($httpCode !== self::HTTP_OK) {
            $message = 'Ouch! We got some wrong response from 3rd API: ' . PHP_EOL .
                'Error: ' . var_export($error, true) . PHP_EOL .
                'Http Code: ' . var_export($httpCode, true) . PHP_EOL .
                'Body: ' . var_export($output, true);

            error_log($message);

            throw new RuntimeException('api.response.differ.than.200.check.logs');
        }

        return $output;
    }
}
