<?php

namespace zaporylie\Vipps\Model\Error;

use JMS\Serializer\Annotation as Serializer;

class AuthorizationError implements ErrorInterface
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $error;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $errorDescription;

    /**
     * @var array
     * @Serializer\Type("array")
     */
    protected $errorCodes;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d H:i:s\Z'>")
     */
    protected $timestamp;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $traceId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $correlationId;

    /**
     * Gets error value.
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Gets errorDescription value.
     *
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    /**
     * Gets errorCodes value.
     *
     * @return array
     */
    public function getErrorCodes()
    {
        return $this->errorCodes;
    }

    /**
     * Gets timestamp value.
     *
     * @return \DateTimeInterface
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Gets traceId value.
     *
     * @return string
     */
    public function getTraceId()
    {
        return $this->traceId;
    }

    /**
     * Gets correlationId value.
     *
     * @return string
     */
    public function getCorrelationId()
    {
        return $this->correlationId;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return implode(',', $this->getErrorCodes());
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->getErrorDescription();
    }
}
