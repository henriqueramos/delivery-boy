<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy;

use HenriqueRamos\DeliveryBoy\Adapters\SpringShippingEnvelope;
use HenriqueRamos\DeliveryBoy\Enums\ResourcesCommands;
use HenriqueRamos\DeliveryBoy\Objects\Label;
use HenriqueRamos\DeliveryBoy\Objects\SpringEnvelope;
use HenriqueRamos\DeliveryBoy\Services\Spring;
use HenriqueRamos\DeliveryBoy\Support\Env;
use HenriqueRamos\DeliveryBoy\Validators\Objects\{
    OrderValidator,
    PackageOptionsValidator
};
use Throwable;

class Package
{
    public function __construct()
    {
        $this->spring = new Spring();
    }

    public function newPackage(
        array $order,
        array $packageOptions
    ): bool|string {
        try {
            $object = [
                'order' => $order,
                'packageOptions' => $packageOptions,
            ];

            $orderValidator = new OrderValidator();
            $packageOptions = new PackageOptionsValidator();

            $orderValidator->next($packageOptions);
            $orderValidator->handle($object);

            $shippingEnvelope = new SpringShippingEnvelope($object);

            $order = new SpringEnvelope([
                'apiKey' => Env::string('API_KEY'),
                'command' => ResourcesCommands::ORDER_SHIPMENT,
                'shipping' => $shippingEnvelope->getEnvelope(),
            ]);

            $this->spring->setPayload(json_encode($order->toArray()));
            $this->spring->setCommand(ResourcesCommands::ORDER_SHIPMENT);

            return $this->spring->doPost();
        } catch (Throwable $e) {
            error_log($e->getTraceAsString());

            return false;
        }
    }

    public function packagePDF(
        string $trackingNumber
    ): bool|string {
        try {
            $labelEnvelope = new Label([
                'trackingNumber' => $trackingNumber
            ]);

            $order = new SpringEnvelope([
                'apiKey' => Env::string('API_KEY'),
                'command' => ResourcesCommands::GET_SHIPMENT_LABEL,
                'shipping' => $labelEnvelope,
            ]);

            $this->spring->setPayload(json_encode($order->toArray()));
            $this->spring->setCommand(ResourcesCommands::GET_SHIPMENT_LABEL);

            return $this->spring->doPost();
        } catch (Throwable $e) {
            error_log($e->getTraceAsString());

            return false;
        }
    }
}
