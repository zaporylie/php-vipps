<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

class ShippingDetailsRequest
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\Address
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\Address")
     */
    protected $address;

    /**
     * @var double
     * @Serializer\Type("double")
     */
    protected $shippingCost;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $shippingMethod;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $shippingMethodId;

    /**
     * @return \zaporylie\Vipps\Model\Payment\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return float
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * @return string
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * @return string
     */
    public function getShippingMethodId()
    {
        return $this->shippingMethodId;
    }
}
