<?php declare(strict_types = 1);

namespace HenriqueRamos\DeliveryBoy;

class Package
{
    public function newPackage(
        array $order,
        array $packageOptions
    ): bool|string {
        return false;
    }

    public function packagePDF(
        string $trackingNumber
    ): bool|string {
        return false;
    }
}
