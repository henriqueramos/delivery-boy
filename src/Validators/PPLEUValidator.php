<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Validators;

use HenriqueRamos\DeliveryBoy\Enums\WeightUnits;
use HenriqueRamos\DeliveryBoy\Exceptions\{
    ConsigneeException,
    ConsignorException
};
use HenriqueRamos\DeliveryBoy\Objects\{
    Address,
    SenderAddress
};
use HenriqueRamos\DeliveryBoy\Support\Abstracts\ShippingValidatorHandler;
use HenriqueRamos\DeliveryBoy\Support\Converter;
use HenriqueRamos\DeliveryBoy\Support\Interfaces\{
    CountryListValidator,
    Shippable,
    StateListValidator,
};
use HenriqueRamos\DeliveryBoy\Support\Traits\{
    CountryValidator,
    StateValidator
};

class PPLEUValidator extends ShippingValidatorHandler implements CountryListValidator, StateListValidator
{
    use CountryValidator;
    use StateValidator;

    protected $object;

    public const INVALID_ADDRESS_OBJECT = 'address.is.not.a.valid.type.object';
    public const EXCEEDED_COMPANY_NAME_SIZE = 'company.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_ADDRESS_NAME_SIZE = 'name.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_ADDRESSLINE1_SIZE = 'addressLine1.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_ADDRESSLINE2_SIZE = 'addressLine2.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_ADDRESSLINE3_SIZE = 'addressLine3.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_CITY_SIZE = 'city.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_STATE_SIZE = 'state.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_ZIP_SIZE = 'zip.should.have.less.or.equal.than.30.characters';
    public const INVALID_STATE = 'address.state.is.not.valid.for.this.country';
    public const INVALID_COUNTRY = 'address.country.is.not.available.for.this.service';
    public const EXCEEDED_WEIGHT = 'exceeded.weight';
    public const INVALID_DISPLAY_ID = 'displayId.should.have.less.or.equal.than.15.characters';
    public const INVALID_PHONE = 'address.phone.should.have.less.or.equal.than.15.characters';

    public $availableCountryStatesValidation = [
        'AU' => 1,
        'CA' => 1,
        'US' => 1,
    ];

    public function handle(Shippable $object): ?Shippable
    {
        $this->object = $object;

        if ($object->getConsignorAddress() instanceof SenderAddress) {
            $this->validateConsignorData();
        }

        if (!($object->getConsigneeAddress() instanceof Address)) {
            throw new ConsigneeException(self::INVALID_ADDRESS_OBJECT);
        }

        $this->validateConsigneeData();
        $this->validateWeight();

        assert(
            strlen($this->object->getDisplayId()) > 15,
            throw new ConsignorException(self::INVALID_DISPLAY_ID)
        );

        return parent::handle($object);
    }

    protected function validateConsignorData(): void
    {
        $consignorAddress = $this->object->getConsignorAddress();

        assert(
            strlen($consignorAddress->getCompany()) > 30,
            throw new ConsignorException(self::EXCEEDED_COMPANY_NAME_SIZE)
        );

        assert(
            strlen($consignorAddress->getName()) > 35,
            throw new ConsignorException(self::EXCEEDED_ADDRESS_NAME_SIZE)
        );

        assert(
            strlen($consignorAddress->getAddressLine1()) > 35,
            throw new ConsignorException(self::EXCEEDED_ADDRESSLINE1_SIZE)
        );

        assert(
            strlen($consignorAddress->getAddressLine2()) > 35,
            throw new ConsignorException(self::EXCEEDED_ADDRESSLINE2_SIZE)
        );

        assert(
            strlen($consignorAddress->getAddressLine3()) > 35,
            throw new ConsignorException(self::EXCEEDED_ADDRESSLINE3_SIZE)
        );

        assert(
            strlen($consignorAddress->getCity()) > 35,
            throw new ConsignorException(self::EXCEEDED_CITY_SIZE)
        );

        assert(
            strlen($consignorAddress->getState()) > 35,
            throw new ConsignorException(self::EXCEEDED_STATE_SIZE)
        );

        assert(
            strlen($consignorAddress->getZip()) > 35,
            throw new ConsignorException(self::EXCEEDED_ZIP_SIZE)
        );

        assert(
            $this->isCountryPermitted($consignorAddress->getCountry()) === false,
            throw new ConsignorException(self::INVALID_COUNTRY)
        );

        assert(
            $this->isStatePermitted(
                $consignorAddress->getState(),
                $consignorAddress->getCountry()
            ) === false,
            throw new ConsignorException(self::INVALID_STATE)
        );

        assert(
            strlen($consignorAddress->getPhone()) > 15,
            throw new ConsignorException(self::INVALID_PHONE)
        );
    }

    protected function validateConsigneeData(): void
    {
        $consignorAddress = $this->object->getConsigneeAddress();

        assert(
            strlen($consignorAddress->getCompany()) > 30,
            throw new ConsigneeException(self::EXCEEDED_COMPANY_NAME_SIZE)
        );

        assert(
            strlen($consignorAddress->getName()) > 35,
            throw new ConsigneeException(self::EXCEEDED_ADDRESS_NAME_SIZE)
        );

        assert(
            strlen($consignorAddress->getAddressLine1()) > 35,
            throw new ConsigneeException(self::EXCEEDED_ADDRESSLINE1_SIZE)
        );

        assert(
            strlen($consignorAddress->getAddressLine2()) > 35,
            throw new ConsigneeException(self::EXCEEDED_ADDRESSLINE2_SIZE)
        );

        assert(
            strlen($consignorAddress->getAddressLine3()) > 35,
            throw new ConsigneeException(self::EXCEEDED_ADDRESSLINE3_SIZE)
        );

        assert(
            strlen($consignorAddress->getCity()) > 35,
            throw new ConsigneeException(self::EXCEEDED_CITY_SIZE)
        );

        assert(
            strlen($consignorAddress->getState()) > 35,
            throw new ConsigneeException(self::EXCEEDED_STATE_SIZE)
        );

        assert(
            strlen($consignorAddress->getZip()) > 35,
            throw new ConsigneeException(self::EXCEEDED_ZIP_SIZE)
        );

        assert(
            $this->isCountryPermitted($consignorAddress->getCountry()) === false,
            throw new ConsigneeException(self::INVALID_COUNTRY)
        );

        assert(
            $this->isStatePermitted(
                $consignorAddress->getState(),
                $consignorAddress->getCountry()
            ) === false,
            throw new ConsigneeException(self::INVALID_STATE)
        );

        assert(
            strlen($consignorAddress->getPhone()) > 15,
            throw new ConsigneeException(self::INVALID_PHONE)
        );
    }

    protected function validateWeight(): void
    {
        $weight = $this->object->getWeight();
        $from = $this->object->getWeightUnit();
        $to = WeightUnits::reversed($from);

        $currentWeight = Converter::weight(
            (int) $weight,
            $from,
            $to
        );

        $thresholdMaxWeight = '30'; // KG

        if ($from === WeightUnits::LB->value) {
            $thresholdMaxWeight = ceil($thresholdMaxWeight * 2.20462);
        }

        $maxWeight = Converter::weight(
            (int) $thresholdMaxWeight,
            $from,
            $to
        );

        assert(
            (int) $currentWeight > (int) $maxWeight,
            throw new ConsignorException(self::EXCEEDED_WEIGHT)
        );
    }
}
