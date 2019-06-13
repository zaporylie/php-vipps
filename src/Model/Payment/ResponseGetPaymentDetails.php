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
     * @var \zaporylie\Vipps\Model\Payment\PaymentShippingDetails
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\PaymentShippingDetails")
     */
    protected $shippingDetails;

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
     * @var \zaporylie\Vipps\Model\Payment\UserDetails
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\UserDetails")
     */
    protected $userDetails;

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
     * @return \zaporylie\Vipps\Model\Payment\PaymentShippingDetails
     */
    public function getShippingDetails()
    {
        return $this->shippingDetails;
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

    /**
     * @return \zaporylie\Vipps\Model\Payment\UserDetails
     */
    public function getUserDetails()
    {
         return $this->userDetails;
    }
}
