<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseGetOrderStatus
 *
 * @package Vipps\Model\Payment
 */
class ResponseGetOrderStatus
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

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
     * Gets transactionInfo value.
     *
     * @return \zaporylie\Vipps\Model\Payment\TransactionInfo
     */
    public function getTransactionInfo()
    {
        return $this->transactionInfo;
    }
}
