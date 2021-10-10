<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseGetAgreement
 *
 * @package Vipps\Model\RecurringPayment
 */
class RequestCreateCharge
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $amount;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $currency;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d'>")
     */
    protected $due;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $retryDays = 0;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * Sets amount variable.
     *
     * @param int $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Sets currency variable.
     *
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Sets description variable.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Sets due variable.
     *
     * @param \DateTimeInterface $due
     *
     * @return $this
     */
    public function setDue(\DateTimeInterface $due)
    {
        $this->due = $due;
        return $this;
    }

    /**
     * Sets retryDays variable.
     *
     * @param int $retryDays
     *
     * @return $this
     */
    public function setRetryDays($retryDays)
    {
        $this->retryDays = $retryDays;
        return $this;
    }

    /**
     * Sets orderId variable.
     *
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }
}
