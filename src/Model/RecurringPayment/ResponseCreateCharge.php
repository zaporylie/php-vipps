<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseCreateCharge
 *
 * @package Vipps\Model\RecurringPayment
 */
class ResponseCreateCharge
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $chargeId;

    /**
     * Gets chargeId value.
     *
     * @return string
     */
    public function getChargeId()
    {
        return $this->chargeId;
    }
}
