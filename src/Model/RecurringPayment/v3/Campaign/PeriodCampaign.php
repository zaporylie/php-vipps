<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3\Campaign;

use JMS\Serializer\Annotation as Serializer;
use zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest;
use zaporylie\Vipps\Model\RecurringPayment\v3\CampaignType;

/**
 * Class PeriodCampaign
 *
 * @package Vipps\Model\RecurringPayment
 */
class PeriodCampaign extends CampaignRequest
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $type = CampaignType::PERIOD_CAMPAIGN;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $price;

    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\Period
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\Period")
     */
    protected $period;


    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of campaignPrice
     *
     * @return  int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of campaignPrice
     *
     * @param  int  $campaignPrice
     *
     * @return  self
     */
    public function setPrice(int $price)
    {
        $this->price = $price;

        return $this;
    }

     /**
     * @return  \zaporylie\Vipps\Model\RecurringPayment\v3\Period
     */ 
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param  \zaporylie\Vipps\Model\RecurringPayment\v3\Period  $period
     *
     * @return  self
     */ 
    public function setPeriod(\zaporylie\Vipps\Model\RecurringPayment\v3\Period $period)
    {
        $this->period = $period;

        return $this;
    }
}
