<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class TransactionLog
 *
 * @package Vipps\Model\Payment
 */
class TransactionLog
{

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.u\Z'>")
     */
    protected $timeStamp;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $operation;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $amount;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $transactionId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $transactionText;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $requestId;

    /**
     * Gets timeStamp value.
     *
     * @return \DateTimeInterface
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * Sets timeStamp variable.
     *
     * @param \DateTimeInterface $timeStamp
     *
     * @return $this
     */
    public function setTimeStamp(\DateTimeInterface $timeStamp)
    {
        $this->timeStamp = $timeStamp;
        return $this;
    }

    /**
     * Gets operation value.
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Sets operation variable.
     *
     * @param string $operation
     *
     * @return $this
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
        return $this;
    }

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
     * Gets transactionId value.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Sets transactionId variable.
     *
     * @param string $transactionId
     *
     * @return $this
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * Gets transactionText value.
     *
     * @return string
     */
    public function getTransactionText()
    {
        return $this->transactionText;
    }

    /**
     * Sets transactionText variable.
     *
     * @param string $transactionText
     *
     * @return $this
     */
    public function setTransactionText($transactionText)
    {
        $this->transactionText = $transactionText;
        return $this;
    }

    /**
     * Gets requestId value.
     *
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Sets requestId variable.
     *
     * @param string $requestId
     *
     * @return $this
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
        return $this;
    }
}
