<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class TransactionAggregate.
 *
 * @package Vipps\Model\Checkout
 */
class TransactionAggregate
{

    /**
     * @var \zaporylie\Vipps\Model\Checkout\ResponseAmount
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\ResponseAmount")
     */
    protected $cancelledAmount;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\ResponseAmount
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\ResponseAmount")
     */
    protected $capturedAmount;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\ResponseAmount
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\ResponseAmount")
     */
    protected $refundedAmount;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\ResponseAmount
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\ResponseAmount")
     */
    protected $authorizedAmount;

    /**
     * Gets payment transaction aggregate cancelled amount.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseAmount
     */
    public function getCancelledAmount(): ResponseAmount
    {
        return $this->cancelledAmount;
    }

    /**
     * Gets payment transaction aggregate captured amount.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseAmount
     */
    public function getCapturedAmount(): ResponseAmount
    {
        return $this->capturedAmount;
    }

    /**
     * Gets payment transaction aggregate refunded amount.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseAmount
     */
    public function getRefundedAmount(): ResponseAmount
    {
        return $this->refundedAmount;
    }

    /**
     * Gets payment transaction aggregate authorized amount.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseAmount
     */
    public function getAuthorizedAmount(): ResponseAmount
    {
        return $this->authorizedAmount;
    }
}
