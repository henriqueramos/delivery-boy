<?php

declare(strict_types=1);

namespace HenriqueRamosTests\Units\Objects;

use HenriqueRamos\DeliveryBoy\Enums\LabelFormats;
use HenriqueRamos\DeliveryBoy\Objects\Label;
use HenriqueRamosTests\TestCase;

final class LabelTest extends TestCase
{
    public function testLabelObjectTestWithBasicData(): void
    {
        $label = new Label([
            'LabelFormat' => LabelFormats::PNG,
            'ShipperReference' => 'Ref_001',
            'TrackingNumber' => '001',
        ]);

        $actual = $label->toArray();

        $expected = [
            'LabelFormat' => LabelFormats::PNG->value,
            'ShipperReference' => 'Ref_001',
            'TrackingNumber' => '001',
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testLabelWithEmptyInput(): void
    {
        $label = new Label([]);

        $actual = $label->toArray();
        $expected = [
            'LabelFormat' => LabelFormats::PDF->value,
            'ShipperReference' => null,
            'TrackingNumber' => null,
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testLabelWithEmptyLabelFormat(): void
    {
        $label = new Label([
            'labelFormat' => null,
        ]);

        $actual = $label->toArray();
        $expected = [
            'LabelFormat' => null,
            'ShipperReference' => null,
            'TrackingNumber' => null,
        ];

        $this->assertEquals($expected, $actual);
    }
}
