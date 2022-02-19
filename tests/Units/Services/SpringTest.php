<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Services;

use HenriqueRamos\DeliveryBoy\Services\Spring;
use HenriqueRamosTests\TestCase;

final class SpringTest extends TestCase
{
    public function testServiceSpringUriGetter(): void
    {
        $service = new Spring();

        $this->assertEquals('http://localhost/', $service->getUri());
    }

    public function testServiceSpringPayloadGetter(): void
    {
        $service = new Spring();

        $message = json_encode(['message' => 'Luv donuts!']);
        $service->setPayload($message);

        $this->assertEquals($message, $service->getPayload());
    }
}
