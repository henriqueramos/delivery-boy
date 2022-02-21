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

class ITCRValidator extends ShippingValidatorHandler implements CountryListValidator, StateListValidator
{
    use CountryValidator;
    use StateValidator;

    protected $object;

    public const INVALID_ADDRESS_OBJECT = 'address.is.not.a.valid.type.object';
    public const EXCEEDED_COMPANY_NAME_SIZE = 'company.should.have.less.or.equal.than.60.characters';
    public const EXCEEDED_ADDRESS_NAME_SIZE = 'name.should.have.less.or.equal.than.60.characters';
    public const EXCEEDED_ADDRESSLINE1_SIZE = 'addressLine1.should.have.less.or.equal.than.60.characters';
    public const EXCEEDED_ADDRESSLINE2_SIZE = 'addressLine2.should.have.less.or.equal.than.60.characters';
    public const EXCEEDED_ADDRESSLINE3_SIZE = 'addressLine3.should.have.less.or.equal.than.60.characters';
    public const EXCEEDED_CITY_SIZE = 'city.should.have.less.or.equal.than.60.characters';
    public const EXCEEDED_STATE_SIZE = 'state.should.have.less.or.equal.than.50.characters';
    public const EXCEEDED_ZIP_SIZE = 'zip.should.have.less.or.equal.than.5.characters';
    public const INVALID_COUNTRY = 'address.country.is.not.available.for.this.service';
    public const EXCEEDED_WEIGHT = 'exceeded.weight';
    public const INVALID_DISPLAY_ID = 'displayId.should.have.less.or.equal.than.15.characters';
    public const INVALID_PHONE = 'address.phone.should.have.less.or.equal.than.15.characters';
    public const PRODUCT_EXCEEDED_DESCRIPTION_SIZE = 'description.should.have.less.or.equal.than.60.characteres';

    public function handle(Shippable $object): ?Shippable
    {
        $this->object = $object;

        $this->validateConsignorData();
        $this->validateConsigneeData();
        $this->validateWeight();
        $this->validateProducts();

        $this->assert(
            strlen((string) $this->object->getDisplayId()) > 15,
            new ValidatorException(self::INVALID_DISPLAY_ID)
        );

        return parent::handle($object);
    }

    public function availableCountriesList(): array
    {
        return [
            'IT' => 1,
        ];
    }

    protected function validateConsignorData(): void
    {
        $address = $this->object->getConsignorAddress();

        $this->assert(
            strlen((string) $address->getName()) > 60,
            new ConsignorException(self::EXCEEDED_ADDRESS_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine1()) > 60,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE1_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine2()) > 60,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE2_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine3()) > 60,
            new ConsignorException(self::EXCEEDED_ADDRESSLINE3_SIZE)
        );

        $this->assert(
            strlen((string) $address->getCity()) > 60,
            new ConsignorException(self::EXCEEDED_CITY_SIZE)
        );

        $this->assert(
            strlen((string) $address->getState()) > 35,
            new ConsignorException(self::EXCEEDED_STATE_SIZE)
        );

        $this->assert(
            strlen((string) $address->getZip()) > 6,
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
            strlen((string) $address->getCompany()) > 60,
            new ConsigneeException(self::EXCEEDED_COMPANY_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getName()) > 60,
            new ConsigneeException(self::EXCEEDED_ADDRESS_NAME_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine1()) > 60,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE1_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine2()) > 60,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE2_SIZE)
        );

        $this->assert(
            strlen((string) $address->getAddressLine3()) > 60,
            new ConsigneeException(self::EXCEEDED_ADDRESSLINE3_SIZE)
        );

        $this->assert(
            strlen((string) $address->getCity()) > 60,
            new ConsigneeException(self::EXCEEDED_CITY_SIZE)
        );

        $this->assert(
            strlen((string) $address->getState()) > 50,
            new ConsigneeException(self::EXCEEDED_STATE_SIZE)
        );

        $this->assert(
            strlen((string) $address->getZip()) > 5,
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

    protected function validateProducts(): void
    {
        $products = $this->object->getProducts();

        foreach ($products as $key => $product) {
            $productKey = 'product.' . $key;
            $this->assert(
                strlen((string) $product->getDescription()) > 60,
                new ValidatorException($productKey . '.' . self::PRODUCT_EXCEEDED_DESCRIPTION_SIZE)
            );
        }
    }
}
