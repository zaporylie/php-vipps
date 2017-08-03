<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseInitiatePayment
 *
 * @package Vipps\Model\Payment
 */
class ResponseInitiatePayment
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $merchantSerialNumber;

    /**
     * @var \zaporylie\Vipps\Model\Payment\TransactionInfo
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\TransactionInfo")
     */
    protected $transactionInfo;

    /**
     * Gets orderId value.
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Gets merchantSerialNumber value.
     *
     * @return string
     */
    public function getMerchantSerialNumber()
    {
        return $this->merchantSerialNumber;
    }

    /**
     * Gets transactionInfo value.
     *
     * @return \zaporylie\Vipps\Model\Payment\TransactionInfo
     */
    public function getTransactionInfo()
    {
        return $this->transactionInfo;
    }
}
