<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseGetPaymentDetails
 *
 * @package Vipps\Model\Payment
 */
class ResponseGetPaymentDetails
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var \zaporylie\Vipps\Model\Payment\TransactionSummary
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\TransactionSummary")
     */
    protected $transactionSummary;

    /**
     * @var \zaporylie\Vipps\Model\Payment\TransactionLog[]
     * @Serializer\Type("array<zaporylie\Vipps\Model\Payment\TransactionLog>")
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
     * @return \zaporylie\Vipps\Model\Payment\TransactionSummary
     */
    public function getTransactionSummary()
    {
        return $this->transactionSummary;
    }

    /**
     * Gets transactionLogHistory value.
     *
     * @return \zaporylie\Vipps\Model\Payment\TransactionLog[]
     */
    public function getTransactionLogHistory()
    {
        return $this->transactionLogHistory;
    }
}
