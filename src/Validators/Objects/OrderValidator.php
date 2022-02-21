<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Validators\Objects;

use HenriqueRamos\DeliveryBoy\Exceptions\ObjectException;
use HenriqueRamos\DeliveryBoy\Support\Abstracts\ObjectValidatorHandler;

class OrderValidator extends ObjectValidatorHandler
{
    protected $object;

    public const UNDEFINED_ORDER_REFERENCE = 'order.should.be.filled.as.an.array';
    public const UNDEFINED_CONSIGNEE_OBJECT_REFERENCE = 'consigneeAddress.should.be.filled.as.an.array';
    public const UNDEFINED_CONSIGNOR_OBJECT_REFERENCE = 'consignorAddress.should.be.filled.as.an.array';
    public const UNDEFINED_CONSIGNEE_ADDRESS_NAME_REFERENCE = 'consigneeAddress.name.should.be.filled';
    public const UNDEFINED_CONSIGNEE_ADDRESS_LINE_1_REFERENCE = 'consigneeAddress.addressLine1.should.be.filled';
    public const UNDEFINED_CONSIGNEE_CITY_REFERENCE = 'consigneeAddress.city.should.be.filled';
    public const UNDEFINED_CONSIGNEE_STATE_REFERENCE = 'consigneeAddress.state.should.be.filled';
    public const UNDEFINED_CONSIGNEE_ZIP_REFERENCE = 'consigneeAddress.zip.should.be.filled';
    public const UNDEFINED_CONSIGNEE_COUNTRY_REFERENCE = 'consigneeAddress.country.should.be.filled';
    public const UNDEFINED_CONSIGNEE_PHONE_REFERENCE = 'consigneeAddress.phone.should.be.filled';
    public const UNDEFINED_CONSIGNEE_EMAIL_REFERENCE = 'consigneeAddress.email.should.be.filled';
    public const UNDEFINED_PRODUCTS_REFERENCE = 'products.should.be.filled.as.array.of.products';
    public const UNDEFINED_PRODUCT_DESCRIPTION_REFERENCE = '.description.should.be.filled';
    public const UNDEFINED_PRODUCT_HS_CODE_REFERENCE = '.hs_code.should.be.filled';
    public const UNDEFINED_PRODUCT_QUANTITY_REFERENCE = '.quantity.should.be.filled';
    public const UNDEFINED_PRODUCT_VALUE_REFERENCE = '.value.should.be.filled';

    public function handle(array $object): ?array
    {
        $this->object = $object;

        $this->assert(
            isset($this->object['order']) && is_array($this->object['order']) && $this->object['order'] !== [],
            new ObjectException(self::UNDEFINED_ORDER_REFERENCE)
        );

        $this->validateConsignorData();
        $this->validateConsigneeData();
        $this->validateProductsData();

        return parent::handle($object);
    }

    protected function validateConsignorData(): void
    {
        $this->assert(
            isset($this->object['order']['consignorAddress']) && is_array($this->object['order']['consignorAddress']) && $this->object['order']['consignorAddress'] !== [],
            new ObjectException(self::UNDEFINED_CONSIGNEE_OBJECT_REFERENCE)
        );

        $address = $this->object['order']['consignorAddress'];

        $this->assert(
            isset($address['name']) && $address['name'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ADDRESS_NAME_REFERENCE)
        );

        $this->assert(
            isset($address['addressLine1']) && $address['addressLine1'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ADDRESS_LINE_1_REFERENCE)
        );

        $this->assert(
            isset($address['city']) && $address['city'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_CITY_REFERENCE)
        );

        $this->assert(
            isset($address['state']) && $address['state'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_STATE_REFERENCE)
        );

        $this->assert(
            isset($address['zip']) && $address['zip'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ZIP_REFERENCE)
        );

        $this->assert(
            isset($address['country']) && $address['country'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_COUNTRY_REFERENCE)
        );

        $this->assert(
            isset($address['phone']) && $address['phone'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_PHONE_REFERENCE)
        );

        $this->assert(
            isset($address['email']) && $address['email'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_EMAIL_REFERENCE)
        );
    }

    protected function validateConsigneeData(): void
    {
        $this->assert(
            isset($this->object['order']['consigneeAddress']) && is_array($this->object['order']['consigneeAddress']) && $this->object['order']['consigneeAddress'] !== [],
            new ObjectException(self::UNDEFINED_CONSIGNEE_OBJECT_REFERENCE)
        );

        $address = $this->object['order']['consigneeAddress'];

        $this->assert(
            isset($address['name']) && $address['name'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ADDRESS_NAME_REFERENCE)
        );

        $this->assert(
            isset($address['addressLine1']) && $address['addressLine1'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ADDRESS_LINE_1_REFERENCE)
        );

        $this->assert(
            isset($address['city']) && $address['city'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_CITY_REFERENCE)
        );

        $this->assert(
            isset($address['state']) && $address['state'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_STATE_REFERENCE)
        );

        $this->assert(
            isset($address['zip']) && $address['zip'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ZIP_REFERENCE)
        );

        $this->assert(
            isset($address['country']) && $address['country'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_COUNTRY_REFERENCE)
        );

        $this->assert(
            isset($address['phone']) && $address['phone'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_PHONE_REFERENCE)
        );

        $this->assert(
            isset($address['email']) && $address['email'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_EMAIL_REFERENCE)
        );
    }

    protected function validateProductsData(): void
    {
        $this->assert(
            isset($this->object['order']['products']) && is_array($this->object['order']['products']) && count($this->object['order']['products']) > 0,
            new ObjectException(self::UNDEFINED_PRODUCTS_REFERENCE)
        );

        $products = $this->object['order']['products'];
        foreach ($products as $key => $product) {
            $productKey = 'product.' . $key;

            $this->assert(
                isset($product['description']) && $product['description'] !== null,
                new ObjectException($productKey . self::UNDEFINED_PRODUCT_DESCRIPTION_REFERENCE)
            );

            $this->assert(
                isset($product['hs_code']) && $product['hs_code'] !== null,
                new ObjectException($productKey . self::UNDEFINED_PRODUCT_HS_CODE_REFERENCE)
            );

            $this->assert(
                isset($product['quantity']) && $product['quantity'] !== null,
                new ObjectException($productKey . self::UNDEFINED_PRODUCT_QUANTITY_REFERENCE)
            );

            $this->assert(
                isset($product['value']) && $product['value'] !== null,
                new ObjectException($productKey . self::UNDEFINED_PRODUCT_VALUE_REFERENCE)
            );
        }
    }
}
