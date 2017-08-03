<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class CustomerInfo
 *
 * @package Vipps\Model\Payment
 */
class CustomerInfo
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $mobileNumber;

    /**
     * Gets mobileNumber value.
     *
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * Sets mobileNumber variable.
     *
     * @param string $mobileNumber
     *
     * @return $this
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }
}
