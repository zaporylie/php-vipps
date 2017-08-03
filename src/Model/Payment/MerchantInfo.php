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
    protected $callBack;

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
        return $this->callBack;
    }

    /**
     * Sets callBack variable.
     *
     * @param string $callBack
     *
     * @return $this
     */
    public function setCallBack($callBack)
    {
        $this->callBack = $callBack;
        return $this;
    }
}
