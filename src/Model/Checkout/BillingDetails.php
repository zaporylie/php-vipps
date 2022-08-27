<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class BillingDetails.
 *
 * @package Vipps\Model\Checkout
 */
class BillingDetails extends CustomerDetailsBase
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $region;

    /**
     * Gets region.
     *
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

}
