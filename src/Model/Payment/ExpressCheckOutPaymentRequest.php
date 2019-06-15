<?php

namespace zaporylie\Vipps\Model\Payment;

use zaporylie\Vipps\Model\FromStringInterface;
use zaporylie\Vipps\Model\FromStringTrait;
use zaporylie\Vipps\Model\ToStringInterface;
use zaporylie\Vipps\Model\ToStringTrait;
use zaporylie\Vipps\Model\SupportsSerializationInterface;
use JMS\Serializer\Annotation as Serializer;

class ExpressCheckOutPaymentRequest implements FromStringInterface, ToStringInterface, SupportsSerializationInterface
{
    use FromStringTrait;
    use PaymentSerializationTrait;
    use ToStringTrait;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $merchantSerialNumber;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var \zaporylie\Vipps\Model\Payment\CallbackTransactionInfoStatus
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\CallbackTransactionInfoStatus")
     */
    protected $transactionInfo;

    /**
     * @var \zaporylie\Vipps\Model\Payment\ShippingDetailsRequest
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\ShippingDetailsRequest")
     */
    protected $shippingDetails;

    /**
     * @var \zaporylie\Vipps\Model\Payment\UserDetails
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\UserDetails")
     */
    protected $userDetails;

    /**
     * @var \zaporylie\Vipps\Model\Payment\CallbackErrorInfo
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\CallbackErrorInfo")
     */
    protected $errorInfo;

    /**
     * @return string
     */
    public function getMerchantSerialNumber()
    {
        return $this->merchantSerialNumber;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return \zaporylie\Vipps\Model\Payment\ShippingDetailsRequest
     */
    public function getShippingDetails()
    {
        return $this->shippingDetails;
    }

    /**
     * @return \zaporylie\Vipps\Model\Payment\CallbackTransactionInfoStatus
     */
    public function getTransactionInfo()
    {
        return $this->transactionInfo;
    }

    /**
     * @return \zaporylie\Vipps\Model\Payment\UserDetails
     */
    public function getUserDetails()
    {
        return $this->userDetails;
    }

    /**
     * @return \zaporylie\Vipps\Model\Payment\CallbackErrorInfo
     */
    public function getErrorInfo()
    {
        return $this->errorInfo;
    }
}
