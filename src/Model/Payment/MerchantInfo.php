<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class MerchantInfo
 *
 * @package Vipps\Model\Payment
 */
class MerchantInfo
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $merchantSerialNumber;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $callbackPrefix;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $fallBack;

    /**
     * @var string
     * @Serializer\Type("bool")
     */
    protected $isApp = false;

    /**
     * Gets merchantSerialNumber value.
     *
     * @return string
     */
    public function getMerchantSerialNumber()
    {
        return $this->merchantSerialNumber;
    }

    /**
     * Sets merchantSerialNumber variable.
     *
     * @param string $merchantSerialNumber
     *
     * @return $this
     */
    public function setMerchantSerialNumber($merchantSerialNumber)
    {
        $this->merchantSerialNumber = $merchantSerialNumber;
        return $this;
    }

    /**
     * Gets callBack value.
     *
     * @return string
     */
    public function getCallBack()
    {
        return $this->callbackPrefix;
    }

    /**
     * Sets callbackPrefix variable.
     *
     * @param string $callBack
     *
     * @return $this
     */
    public function setCallBack($callBack)
    {
        $this->callbackPrefix = $callBack;
        return $this;
    }

    /**
     * Gets fallBack value.
     *
     * @return string
     */
    public function getFallBack()
    {
        return $this->fallBack;
    }

    /**
     * Sets fallBack variable.
     *
     * @param string $fallBack
     *
     * @return $this
     */
    public function setFallBack($fallBack)
    {
        $this->fallBack = $fallBack;
        return $this;
    }
}
