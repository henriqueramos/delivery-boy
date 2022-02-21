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

class RM2448SValidator extends ShippingValidatorHandler implements CountryListValidator, StateListValidator
{
    use CountryValidator;
    use StateValidator;

    protected $object;

    public const INVALID_ADDRESS_OBJECT = 'address.is.not.a.valid.type.object';
    public const EXCEEDED_CONSIGNOR_COMPANY_NAME_SIZE = 'company.should.have.less.or.equal.than.25.characters';
    public const EXCEEDED_COMPANY_NAME_SIZE = 'company.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_ADDRESS_NAME_SIZE = 'name.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_ADDRESSLINE1_SIZE = 'addressLine1.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_ADDRESSLINE2_SIZE = 'addressLine2.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_ADDRESSLINE3_SIZE = 'addressLine3.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_CITY_SIZE = 'city.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_STATE_SIZE = 'state.should.have.less.or.equal.than.30.characters';
    public const EXCEEDED_ZIP_SIZE = 'zip.should.have.less.or.equal.than.20.characters';
    public const INVALID_STATE = 'address.state.is.not.valid.for.this.country';
    public const INVALID_COUNTRY = 'address.country.is.not.available.for.this.service';
    public const EXCEEDED_WEIGHT = 'exceeded.weight';
    public const INVALID_DISPLAY_ID = 'displayId.should.have.less.or.equal.than.15.characters';
    public const PRODUCT_EXCEEDED_DESCRIPTION_SIZE = 'description.should.have.less.or.equal.than.105.characteres';
    public const PRODUCT_EXCEEDED_HSCODE_SIZE = 'hs_code.should.have.less.or.equal.than.6.characteres';

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
            'GB' => 1,
        ];
    }

    protected function validateConsignorData(): void
    {
        $address = $this->object->getConsignorAddress();

        $this->assert(
            strlen((string) $address->getCompany()) > 25,
            new ConsignorException(self::EXCEEDED_CONSIGNOR_COMPANY_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getName()) > 30,
            new ConsignorException(self::EXCEEDED_ADDRESS_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine1()) > 30,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE1_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine2()) > 30,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE2_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine3()) > 30,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE3_SIZE)
        );

        $this->assert(
            strlen((string) $address->getCity()) > 30,
            new ConsignorException(self::EXCEEDED_CITY_SIZE)
        );

        $this->assert(
            strlen((string) $address->getState()) > 30,
            new ConsignorException(self::EXCEEDED_STATE_SIZE)
        );

        $this->assert(
            strlen((string) $address->getZip()) > 20,
            new ConsignorException(self::EXCEEDED_ZIP_SIZE)
        );
    }

    protected function validateConsigneeData(): void
    {
        $address = $this->object->getConsigneeAddress();

        $this->assert(
            strlen((string) $address->getCompany()) > 30,
            new ConsigneeException(self::EXCEEDED_COMPANY_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getName()) > 30,
            new ConsigneeException(self::EXCEEDED_ADDRESS_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine1()) > 30,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE1_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine2()) > 30,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE2_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine3()) > 30,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE3_SIZE)
        );

        $this->assert(
            strlen((string) $address->getCity()) > 30,
            new ConsigneeException(self::EXCEEDED_CITY_SIZE)
        );

        $this->assert(
            strlen((string) $address->getState()) > 30,
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

        $thresholdMaxWeight = '20'; // KG

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
