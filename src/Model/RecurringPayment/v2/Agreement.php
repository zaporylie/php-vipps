<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v2;

use JMS\Serializer\Annotation as Serializer;
use zaporylie\Vipps\Model\RecurringPayment\AgreementBase;

/**
 * Class Agreement
 *
 * @package Vipps\Model\RecurringPayment
 */
class Agreement extends AgreementBase
{
    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v2\CampaignRequest
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v2\CampaignRequest")
     */
    protected $campaign;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $currency;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $interval;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $intervalCount;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $price;


    /**
     * Gets campaign value.
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\v2\CampaignRequest
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Gets currency value.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Gets interval value.
     *
     * @return string
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Gets intervalCount value.
     *
     * @return int
     */
    public function getIntervalCount()
    {
        return $this->intervalCount;
    }

    /**
     * Gets price value.
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
}
