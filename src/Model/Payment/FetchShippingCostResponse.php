<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;
use zaporylie\Vipps\Model\ToStringInterface;
use zaporylie\Vipps\Model\ToStringTrait;
use zaporylie\Vipps\Model\SupportsSerializationInterface;

class FetchShippingCostResponse implements ToStringInterface, SupportsSerializationInterface
{
    use PaymentSerializationTrait;
    use ToStringTrait;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $addressId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var \zaporylie\Vipps\Model\Payment\ShippingDetails[]
     * @Serializer\Type("array<zaporylie\Vipps\Model\Payment\ShippingDetails>")
     */
    protected $shippingDetails;

    /**
     * @return int
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * @param int $addressId
     *
     * @return $this
     */
    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return ShippingDetails[]
     */
    public function getShippingDetails()
    {
        return $this->shippingDetails;
    }

    /**
     * @param ShippingDetails[] $shippingDetails
     *
     * @return $this
     */
    public function setShippingDetails(array $shippingDetails)
    {
        $this->shippingDetails = $shippingDetails;
        return $this;
    }
}
