<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Validators\Objects;

use HenriqueRamos\DeliveryBoy\Enums\ShippingServices;
use HenriqueRamos\DeliveryBoy\Exceptions\ObjectException;
use HenriqueRamos\DeliveryBoy\Support\Abstracts\ObjectValidatorHandler;

class PackageOptionsValidator extends ObjectValidatorHandler
{
    protected $object;

    public const UNDEFINED_PACKAGE_OPTIONS_REFERENCE = 'packageOptions.should.be.filled.as.an.array';
    public const UNDEFINED_SHIPPER_REFERENCE = 'shipperReference.should.be.filled';
    public const UNDEFINED_SERVICE_REFERENCE = 'service.should.be.filled';
    public const UNDEFINED_WEIGHT_REFERENCE = 'weight.should.be.filled';
    public const UNDEFINED_VALUE_REFERENCE = 'value.should.be.filled';

    public function handle(array $object): ?array
    {
        $this->object = $object;

        $this->assert(
            isset($this->object['packageOptions']) && is_array($this->object['packageOptions']) && $this->object['packageOptions'] !== [],
            new ObjectException(self::UNDEFINED_PACKAGE_OPTIONS_REFERENCE)
        );

        $this->validateShippingData();

        return parent::handle($object);
    }

    protected function validateShippingData(): void
    {
        $this->assert(
            isset($this->object['packageOptions']['shipperReference']) && $this->object['packageOptions']['shipperReference'] !== null,
            new ObjectException(self::UNDEFINED_SHIPPER_REFERENCE)
        );

        $this->assert(
            isset($this->object['packageOptions']['service']) && ShippingServices::from($this->object['packageOptions']['service']) !== null,
            new ObjectException(self::UNDEFINED_SERVICE_REFERENCE)
        );

        $this->assert(
            isset($this->object['packageOptions']['weight']) && $this->object['packageOptions']['weight'] !== null,
            new ObjectException(self::UNDEFINED_WEIGHT_REFERENCE)
        );

        $this->assert(
            isset($this->object['packageOptions']['value']) && $this->object['packageOptions']['value'] !== null,
            new ObjectException(self::UNDEFINED_VALUE_REFERENCE)
        );
    }
}
