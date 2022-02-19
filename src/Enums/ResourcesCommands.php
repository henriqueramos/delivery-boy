<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Enums;

enum ResourcesCommands: string
{
    case ORDER_SHIPMENT = 'OrderShipment';
    case GET_SHIPMENT_LABEL = 'GetShipmentLabel';
}
