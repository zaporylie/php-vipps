<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ShippingDetails.
 *
 * @package Vipps\Model\Checkout
 */
class ShippingDetails extends BillingDetails
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $shippingMethodId;

    /**
     * @return string
     */
    public function getShippingMethodId(): string
    {
        return $this->shippingMethodId;
    }

}
