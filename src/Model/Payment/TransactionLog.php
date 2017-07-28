<?php

namespace Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

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
     * Gets operation value.
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
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
     * Gets transactionId value.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
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
     * Gets requestId value.
     *
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }
}
