<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Enums;

enum LabelFormats: string
{
    case EPL = 'EPL';
    case PDF = 'PDF';
    case PNG = 'PNG';
    case ZPL = 'ZPL';
    case ZPL200 = 'ZPL200';
    case ZPL300 = 'ZPL300';
}
