<?php

namespace Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

class ResponseGetPaymentDetails
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var \Vipps\Model\Payment\TransactionSummary
     * @Serializer\Type("Vipps\Model\Payment\TransactionSummary")
     */
    protected $transactionSummary;

    /**
     * @var \Vipps\Model\Payment\TransactionLog[]
     * @Serializer\Type("array<Vipps\Model\Payment\TransactionLog>")
     */
    protected $transactionLogHistory;

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
     * Gets transactionSummary value.
     *
     * @return \Vipps\Model\Payment\TransactionSummary
     */
    public function getTransactionSummary()
    {
        return $this->transactionSummary;
    }

    /**
     * Gets transactionLogHistory value.
     *
     * @return \Vipps\Model\Payment\TransactionLog[]
     */
    public function getTransactionLogHistory()
    {
        return $this->transactionLogHistory;
    }
}
