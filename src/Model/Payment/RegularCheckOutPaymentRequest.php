<?php

namespace zaporylie\Vipps\Model\Payment;

use zaporylie\Vipps\Model\FromStringInterface;
use zaporylie\Vipps\Model\FromStringTrait;
use zaporylie\Vipps\Model\ToStringInterface;
use zaporylie\Vipps\Model\ToStringTrait;
use zaporylie\Vipps\Model\SupportsSerializationInterface;
use JMS\Serializer\Annotation as Serializer;

class RegularCheckOutPaymentRequest implements FromStringInterface, ToStringInterface, SupportsSerializationInterface
{
    use FromStringTrait;
    use ToStringTrait;
    use PaymentSerializationTrait;

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
