<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Adapters;

use HenriqueRamos\DeliveryBoy\Enums\{
    Currency,
    CustomsDuties,
    DimUnits,
    LabelFormats,
    ShippingDeclarationType,
    ShippingServices,
    WeightUnits,
};
use HenriqueRamos\DeliveryBoy\Objects\{
    Address,
    Product,
    ProductsBag,
    SenderAddress,
    Shipping,
};
use HenriqueRamos\DeliveryBoy\Support\Abstracts\Hydrate;

final class SpringShippingEnvelope extends Hydrate
{
    protected $order = [];
    protected $packageOptions = [];
    protected $envelope = null;

    public function toArray(): array
    {
        return $this->getEnvelope()
            ->toArray();
    }

    public function getEnvelope(): Shipping
    {
        return new Shipping(
            array_merge(
                $this->order,
                $this->packageOptions
            )
        );
    }

    public function setOrder(array $order): self
    {
        $data = $order;

        if (isset($order['consigneeAddress']) && is_array($order['consigneeAddress'])) {
            $data['consigneeAddress'] = new Address($order['consigneeAddress']);
        }

        if (isset($order['consignorAddress']) && is_array($order['consignorAddress'])) {
            $data['consignorAddress'] = new SenderAddress($order['consignorAddress']);
        }

        if (isset($order['products']) && is_array($order['products'])) {
            $products = [];

            foreach ($order['products'] as $product) {
                $products[] = new Product($product);
            }

            $data['products'] = new ProductsBag([
                'products' => $products
            ]);
        }

        $this->order = $data;

        return $this;
    }

    public function setPackageOptions(array $options): self
    {
        $data = $options;

        $data['service'] = ShippingServices::tryFrom($options['service']);

        if (isset($options['currency'])) {
            $data['currency'] = Currency::tryFrom($options['currency']);
        }

        if (isset($options['customsDuty'])) {
            $data['customsDuty'] = CustomsDuties::tryFrom($options['customsDuty']);
        }

        if (isset($options['declarationType'])) {
            $data['declarationType'] = ShippingDeclarationType::tryFrom($options['declarationType']);
        }

        if (isset($options['dimUnit'])) {
            $data['dimUnit'] = DimUnits::tryFrom($options['dimUnit']);
        }

        if (isset($options['labelFormat'])) {
            $data['labelFormat'] = LabelFormats::tryFrom($options['labelFormat']);
        }

        if (isset($options['weightUnit'])) {
            $data['weightUnit'] = WeightUnits::tryFrom($options['weightUnit']);
        }

        $this->packageOptions = $data;

        return $this;
    }
}
