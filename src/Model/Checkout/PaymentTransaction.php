<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class PaymentTransaction.
 *
 * @package Vipps\Model\Checkout
 */
class PaymentTransaction
{

    /**
     * @var \zaporylie\Vipps\Model\Checkout\RequestAmount
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\RequestAmount")
     */
    protected $amount;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $reference;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $paymentDescription;

    /**
     * Gets payment transaction amount.
     *
     * @return \zaporylie\Vipps\Model\Checkout\RequestAmount
     */
    public function getAmount(): RequestAmount
    {
        return $this->amount;
    }

    /**
     * Sets payment transaction amount.
     *
     * @param \zaporylie\Vipps\Model\Checkout\RequestAmount $amount
     *
     * @return $this
     */
    public function setAmount(RequestAmount $amount): PaymentTransaction
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Gets payment transaction reference.
     *
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * Sets payment transaction reference.
     *
     * @param string $reference
     *   maxLength: 50
     *   minLength: 8
     *   pattern: ^[-a-zA-Z0-9]*$
     *
     * @return $this
     */
    public function setReference(string $reference): PaymentTransaction
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Gets payment transaction description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->paymentDescription;
    }

    /**
     * Sets payment transaction description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): PaymentTransaction
    {
        $this->paymentDescription = $description;
        return $this;
    }
}
