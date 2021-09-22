<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Charge.
 *
 * @package Vipps\Model\RecurringPayment
 */
class Charge
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $amount;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $amountRefunded;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $due;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $id;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $status;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $transactionId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $type;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $failureReason;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $failureDescription;

    /**
     * Gets amount value.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Gets amountRefunded value.
     *
     * @return int
     */
    public function getAmountRefunded()
    {
        return $this->amountRefunded;
    }

    /**
     * Gets description value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets due value.
     *
     * @return \DateTimeInterface
     */
    public function getDue()
    {
        return $this->due;
    }

    /**
     * Gets failureDescription value.
     *
     * @return string
     */
    public function getFailureDescription()
    {
        return $this->failureDescription;
    }

    /**
     * Gets failureReason value.
     *
     * @return string
     */
    public function getFailureReason()
    {
        return $this->failureReason;
    }

    /**
     * Gets id value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets status value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Gets transactionId value.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Gets type value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
