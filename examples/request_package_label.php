<?php

declare(strict_types=1);

require dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php';

$package = new \HenriqueRamos\DeliveryBoy\Package();

$trackingNumber = 'TEMP0032116072';

$result = $package->packagePDF($trackingNumber);

if ($result === false) {
    echo 'We cannot send your package. Check the error_log please';
    exit;
}

echo 'Oorah! This is your package label encoded as base64 string: "' . $result . '"' . PHP_EOL;
