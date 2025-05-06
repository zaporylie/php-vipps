<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

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
    protected $transactionType;


    /**
     * Default: "RECURRING".
     *
     * Enum: "RECURRING", "UNSCHEDULED".
     *
     * @var string
     * @Serializer\Type("string")
     */
    protected $type;

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
     * @var string
     * @Serializer\Type("string")
     */
    protected $externalId;

    /**
     * Sets amount variable.
     *
     * @param int $amount
     *
     * @return $this
     */
    public function setAmount(int $amount)
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
    public function setTransactionType(string $transactionType)
    {
        $this->transactionType = $transactionType;
        return $this;
    }

    /**
     * Sets description variable.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description)
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
    public function setRetryDays(int $retryDays)
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
    public function setOrderId(string $orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * Sets type variable.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Sets externalId variable.
     *
     * @param string $externalId
     *
     * @return $this
     */
    public function setExternalId(string $externalId)
    {
        $this->externalId = $externalId;
        return $this;
    }
}
