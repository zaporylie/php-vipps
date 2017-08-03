<?php

namespace zaporylie\Vipps\Model\Error;

use JMS\Serializer\Annotation as Serializer;

class PaymentError implements ErrorInterface
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("errorGroup")
     */
    protected $errorGroup;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("errorCode")
     */
    protected $errorCode;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("errorMessage")
     */
    protected $errorMessage;

    /**
     * Gets errorCode value.
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Gets errorGroup value.
     *
     * @return string
     */
    public function getErrorGroup()
    {
        return $this->errorGroup;
    }

    /**
     * Gets errorMessage value.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->getErrorCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->getErrorMessage();
    }
}
