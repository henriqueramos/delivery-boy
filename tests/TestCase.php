<?php

declare(strict_types=1);

namespace HenriqueRamosTests;

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use ArraySubsetAsserts;
}
