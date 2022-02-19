<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Enums;

enum ShippingDeclarationType: string
{
    case COMMERCIAL_SAMPLE = 'ComercialSample';
    case DOCUMENTS = 'Documents';
    case GIFT = 'Gift';
    case RETURNED_GOODS = 'ReturnedGoods';
    case SALE_OF_GOODS = 'SaleOfGoods';
}
