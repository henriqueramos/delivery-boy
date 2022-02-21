<?php

declare(strict_types=1);

require dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php';

$package = new \HenriqueRamos\DeliveryBoy\Package();

$order = [
    'consigneeAddress' => [
        'name' => 'Homer Simpson',
        'addressLine1' => '742 Evergreen Terrace',
        'city' => 'Springfield',
        'state' => 'MO',
        'zip' => '24120',
        'country' => 'US',
        'phone' => '(939)-555-0113',
        'email' => 'homer.simpson@springfield.test',
    ],
    'consignorAddress' => [
        'name' => 'Ned Flanders',
        'addressLine1' => '740 Evergreen Terrace',
        'city' => 'Springfield',
        'state' => 'MO',
        'zip' => '24120',
        'country' => 'US',
        'phone' => '(939)-555-0581',
        'email' => 'nflanders@leftorium.test',
    ],
    'products' => [
        [
            'description' => 'LardLad Donuts box (8 donuts)',
            'hs_code' => '1234567',
            'quantity' => '1',
            'value' => '15',
        ],
    ],
];

$packageOptions = [
    'shipperReference' => 'order_' . mt_rand(),
    'service' => \HenriqueRamos\DeliveryBoy\Enums\ShippingServices::PPLEU->value,
    'weight' => '5',
    'value' => '15',
];

$result = $package->newPackage($order, $packageOptions);

if ($result === false) {
    echo 'We cannot send your package. Check the error_log please';
    exit;
}

echo 'Oorah! This is your assigned tracking number: "' . $result . '"' . PHP_EOL;
