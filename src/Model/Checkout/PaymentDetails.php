<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class PaymentDetails.
 *
 * @package Vipps\Model\Checkout
 */
class PaymentDetails
{

    /**
     * @var \zaporylie\Vipps\Model\Checkout\ResponseAmount
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\ResponseAmount")
     */
    protected $amount;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $state;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\TransactionAggregate
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\TransactionAggregate")
     */
    protected $aggregate;

    /**
     * Gets payment amount.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseAmount
     */
    public function getAmount(): ResponseAmount
    {
        return $this->amount;
    }

    /**
     * Gets payment state.
     *
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Gets payment transaction aggregate.
     *
     * @return \zaporylie\Vipps\Model\Checkout\TransactionAggregate
     */
    public function getTransactionAggregate(): TransactionAggregate
    {
        return $this->aggregate;
    }
}
