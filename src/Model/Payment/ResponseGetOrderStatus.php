<?php

namespace Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

class ResponseGetOrderStatus
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var \Vipps\Model\Payment\TransactionInfo
     * @Serializer\Type("Vipps\Model\Payment\TransactionInfo")
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
     * @return \Vipps\Model\Payment\TransactionInfo
     */
    public function getTransactionInfo()
    {
        return $this->transactionInfo;
    }
}
