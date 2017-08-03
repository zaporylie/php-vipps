<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class TransactionSummary
 *
 * @package Vipps\Model\Payment
 */
class TransactionSummary
{

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $capturedAmount;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $remainingAmountToCapture;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $refundedAmount;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $remainingAmountToRefund;

    /**
     * Gets capturedAmount value.
     *
     * @return int
     */
    public function getCapturedAmount()
    {
        return $this->capturedAmount;
    }

    /**
     * Sets capturedAmount variable.
     *
     * @param int $capturedAmount
     *
     * @return $this
     */
    public function setCapturedAmount($capturedAmount)
    {
        $this->capturedAmount = $capturedAmount;
        return $this;
    }

    /**
     * Gets remainingAmountToCapture value.
     *
     * @return int
     */
    public function getRemainingAmountToCapture()
    {
        return $this->remainingAmountToCapture;
    }

    /**
     * Sets remainingAmountToCapture variable.
     *
     * @param int $remainingAmountToCapture
     *
     * @return $this
     */
    public function setRemainingAmountToCapture($remainingAmountToCapture)
    {
        $this->remainingAmountToCapture = $remainingAmountToCapture;
        return $this;
    }

    /**
     * Gets refundedAmount value.
     *
     * @return int
     */
    public function getRefundedAmount()
    {
        return $this->refundedAmount;
    }

    /**
     * Sets refundedAmount variable.
     *
     * @param int $refundedAmount
     *
     * @return $this
     */
    public function setRefundedAmount($refundedAmount)
    {
        $this->refundedAmount = $refundedAmount;
        return $this;
    }

    /**
     * Gets remainingAmountToRefund value.
     *
     * @return int
     */
    public function getRemainingAmountToRefund()
    {
        return $this->remainingAmountToRefund;
    }

    /**
     * Sets remainingAmountToRefund variable.
     *
     * @param int $remainingAmountToRefund
     *
     * @return $this
     */
    public function setRemainingAmountToRefund($remainingAmountToRefund)
    {
        $this->remainingAmountToRefund = $remainingAmountToRefund;
        return $this;
    }
}
