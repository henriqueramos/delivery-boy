<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Validators\Objects;

use HenriqueRamos\DeliveryBoy\Exceptions\ObjectException;
use HenriqueRamos\DeliveryBoy\Support\Abstracts\ObjectValidatorHandler;

class OrderValidator extends ObjectValidatorHandler
{
    protected $object;

    public const UNDEFINED_ORDER_REFERENCE = 'order.should.be.filled.as.an.array';
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

        $this->validateConsigneeData();
        $this->validateProductsData();

        return parent::handle($object);
    }

    protected function validateConsigneeData(): void
    {
        $this->assert(
            isset($this->object['order']['consigneeAddress']['name']) && $this->object['order']['consigneeAddress']['name'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ADDRESS_NAME_REFERENCE)
        );

        $this->assert(
            isset($this->object['order']['consigneeAddress']['addressLine1']) && $this->object['order']['consigneeAddress']['addressLine1'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ADDRESS_LINE_1_REFERENCE)
        );

        $this->assert(
            isset($this->object['order']['consigneeAddress']['city']) && $this->object['order']['consigneeAddress']['city'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_CITY_REFERENCE)
        );

        $this->assert(
            isset($this->object['order']['consigneeAddress']['state']) && $this->object['order']['consigneeAddress']['state'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_STATE_REFERENCE)
        );

        $this->assert(
            isset($this->object['order']['consigneeAddress']['zip']) && $this->object['order']['consigneeAddress']['zip'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_ZIP_REFERENCE)
        );

        $this->assert(
            isset($this->object['order']['consigneeAddress']['country']) && $this->object['order']['consigneeAddress']['country'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_COUNTRY_REFERENCE)
        );

        $this->assert(
            isset($this->object['order']['consigneeAddress']['phone']) && $this->object['order']['consigneeAddress']['phone'] !== null,
            new ObjectException(self::UNDEFINED_CONSIGNEE_PHONE_REFERENCE)
        );

        $this->assert(
            isset($this->object['order']['consigneeAddress']['email']) && $this->object['order']['consigneeAddress']['email'] !== null,
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
