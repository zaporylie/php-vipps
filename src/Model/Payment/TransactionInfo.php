<?php

namespace Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

class TransactionInfo
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
    protected $status;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $transactionId;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.u\Z'>")
     */
    protected $timeStamp;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $message;

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
     * Gets timeStamp value.
     *
     * @return \DateTimeInterface
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * Gets message value.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
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
}
