<?php

require dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use HenriqueRamos\DeliveryBoy\Support\DotEnv;

(new DotEnv(dirname(__FILE__, 2) . '/.env'))->load();
