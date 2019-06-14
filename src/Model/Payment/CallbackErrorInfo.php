<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class CustomerInfo
 *
 * @package Vipps\Model\Payment
 */
class CallbackErrorInfo
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $errorCode;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $errorGroup;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $errorMessage;

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorGroup()
    {
        return $this->errorGroup;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
