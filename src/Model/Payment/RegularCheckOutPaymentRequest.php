<?php

namespace zaporylie\Vipps\Model\Payment;

use zaporylie\Vipps\Model\CreateFromStringInterface;
use zaporylie\Vipps\Model\CreateFromStringTrait;
use zaporylie\Vipps\Model\SerializeToStringTrait;
use zaporylie\Vipps\Model\SupportsSerializationInterface;
use JMS\Serializer\Annotation as Serializer;

class RegularCheckOutPaymentRequest implements CreateFromStringInterface, SupportsSerializationInterface
{
    use CreateFromStringTrait;
    use PaymentSerializationTrait;
    use SerializeToStringTrait;

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
     * @return \zaporylie\Vipps\Model\Payment\CallbackTransactionInfoStatus
     */
    public function getTransactionInfo()
    {
        return $this->transactionInfo;
    }

    /**
     * @return \zaporylie\Vipps\Model\Payment\CallbackErrorInfo
     */
    public function getErrorInfo()
    {
        return $this->errorInfo;
    }
}
