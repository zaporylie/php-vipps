<?php

namespace Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

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
     * Gets remainingAmountTocapture value.
     *
     * @return int
     */
    public function getRemainingAmountToCapture()
    {
        return $this->remainingAmountToCapture;
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
     * Gets remainingAmountToRefund value.
     *
     * @return int
     */
    public function getRemainingAmountToRefund()
    {
        return $this->remainingAmountToRefund;
    }
}
