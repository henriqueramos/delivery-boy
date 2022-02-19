<?php

/**
 * There's more than 150 currencies recognized as legal tenders, I've chosen the stable ones.
 *
 * @see https://www.worldatlas.com/articles/how-many-currencies-are-in-the-world.html
 * @see https://taxsummaries.pwc.com/glossary/currency-codes
 */

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Enums;

enum Currency: string
{
    case BRAZILIAN_REAL = 'BRL';
    case BRITISH_POUND = 'GBP';
    case EURO = 'EUR';
    case JAPANESE_YEN = 'JPY';
    case USA_DOLLAR = 'USD';
}
