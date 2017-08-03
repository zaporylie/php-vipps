<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Transaction
 *
 * @package Vipps\Model\Payment
 */
class Transaction
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $refOrderId;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $amount;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $transactionText;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.u\Z'>")
     */
    protected $timeStamp;

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
     * Gets orderId value.
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
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

    /**
     * Gets refOrderId value.
     *
     * @return string
     */
    public function getRefOrderId()
    {
        return $this->refOrderId;
    }

    /**
     * Sets refOrderId variable.
     *
     * @param string $refOrderId
     *
     * @return $this
     */
    public function setRefOrderId($refOrderId)
    {
        $this->refOrderId = $refOrderId;
        return $this;
    }

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
}
