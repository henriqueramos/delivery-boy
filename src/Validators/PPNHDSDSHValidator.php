<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Validators;

use HenriqueRamos\DeliveryBoy\Enums\WeightUnits;
use HenriqueRamos\DeliveryBoy\Exceptions\{
    ConsigneeException,
    ConsignorException,
    ValidatorException
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

class PPNHDSDSHValidator extends ShippingValidatorHandler implements CountryListValidator, StateListValidator
{
    use CountryValidator;
    use StateValidator;

    protected $object;

    public const INVALID_ADDRESS_OBJECT = 'address.is.not.a.valid.type.object';
    public const EXCEEDED_COMPANY_NAME_SIZE = 'company.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_CONSIGNOR_COMPANY_NAME_SIZE = 'company.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_ADDRESS_NAME_SIZE = 'name.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_ADDRESSLINE1_SIZE = 'addressLine1.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_ADDRESSLINE2_SIZE = 'addressLine2.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_ADDRESSLINE3_SIZE = 'addressLine3.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_CITY_SIZE = 'city.should.have.less.or.equal.than.35.characters';
    public const EXCEEDED_STATE_SIZE = 'state.should.have.2.characters';
    public const EXCEEDED_ZIP_SIZE = 'zip.should.have.less.or.equal.than.20.characters';
    public const INVALID_STATE = 'address.state.is.not.valid.for.this.country';
    public const INVALID_COUNTRY = 'address.country.is.not.available.for.this.service';
    public const EXCEEDED_WEIGHT = 'exceeded.weight';
    public const INVALID_DISPLAY_ID = 'displayId.should.have.less.or.equal.than.15.characters';
    public const INVALID_PHONE = 'address.phone.should.have.less.or.equal.than.15.characters';

    public function handle(Shippable $object): ?Shippable
    {
        $this->object = $object;

        $this->validateConsignorData();
        $this->validateConsigneeData();
        $this->validateWeight();
        $this->assert(
            strlen((string) $this->object->getDisplayId()) > 15,
            new ValidatorException(self::INVALID_DISPLAY_ID)
        );

        return parent::handle($object);
    }

    public function availableCountriesList(): array
    {
        return [
            'BE' => 1,
            'NL' => 1,
        ];
    }

    protected function validateConsignorData(): void
    {
        $address = $this->object->getConsignorAddress();

        $this->assert(
            strlen((string) $address->getCompany()) > 30,
            new ConsignorException(self::EXCEEDED_CONSIGNOR_COMPANY_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getName()) > 35,
            new ConsignorException(self::EXCEEDED_ADDRESS_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine1()) > 35,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE1_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine2()) > 35,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE2_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine3()) > 35,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE3_SIZE)
        );

        $this->assert(
            strlen((string) $address->getCity()) > 35,
            new ConsignorException(self::EXCEEDED_CITY_SIZE)
        );

        $this->assert(
            strlen((string) $address->getState()) > 35,
            new ConsignorException(self::EXCEEDED_CITY_SIZE)
        );

        $this->assert(
            strlen((string) $address->getZip()) > 20,
            new ConsignorException(self::EXCEEDED_ZIP_SIZE)
        );

        $this->assert(
            strlen((string) $address->getPhone()) > 15,
            new ConsignorException(self::INVALID_PHONE)
        );
    }

    protected function validateConsigneeData(): void
    {
        $address = $this->object->getConsigneeAddress();

        $this->assert(
            strlen((string) $address->getCompany()) > 35,
            new ConsignorException(self::EXCEEDED_COMPANY_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getName()) > 35,
            new ConsigneeException(self::EXCEEDED_ADDRESS_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine1()) > 35,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE1_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine2()) > 35,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE2_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine3()) > 35,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE3_SIZE)
        );

        $this->assert(
            strlen((string) $address->getCity()) > 35,
            new ConsigneeException(self::EXCEEDED_CITY_SIZE)
        );

        $this->assert(
            strlen((string) $address->getState()) > 35,
            new ConsigneeException(self::EXCEEDED_STATE_SIZE)
        );

        $this->assert(
            strlen((string) $address->getZip()) > 20,
            new ConsigneeException(self::EXCEEDED_ZIP_SIZE)
        );

        $this->assert(
            $this->isCountryPermitted($address->getCountry()) === false,
            new ConsigneeException(self::INVALID_COUNTRY)
        );

        $this->assert(
            strlen((string) $address->getPhone()) > 15,
            new ConsigneeException(self::INVALID_PHONE)
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

        $this->assert(
            (int) $currentWeight > (int) $maxWeight,
            new ValidatorException(self::EXCEEDED_WEIGHT)
        );
    }
}
