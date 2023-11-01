<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3\Campaign;

use JMS\Serializer\Annotation as Serializer;
use zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest;
use zaporylie\Vipps\Model\RecurringPayment\v3\CampaignType;

/**
 * Class FullFlexCampaign
 *
 * @package Vipps\Model\RecurringPayment
 */
class FullFlexCampaign extends CampaignRequest
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $type = CampaignType::FULL_FLEX_CAMPAIGN;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $price;

    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\Period
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\Period");
     */
    protected $interval;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $end;


    /**
     * Get the value of end
     *
     * @return  \DateTimeInterface
     */
    public function getEnd()
    {
        return $this->end;
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
     * Get the value of interval
     *
     * @return  \zaporylie\Vipps\Model\RecurringPayment\v3\Period
     */ 
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set the value of interval
     *
     * @param  \zaporylie\Vipps\Model\RecurringPayment\v3\Period  $interval
     *
     * @return  self
     */ 
    public function setInterval(\zaporylie\Vipps\Model\RecurringPayment\v3\Period $interval)
    {
        $this->interval = $interval;

        return $this;
    }

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
     * Set the value of end
     *
     * @param  \DateTimeInterface  $end
     *
     * @return  self
     */
    public function setEnd(\DateTimeInterface $end)
    {
        $this->end = $end;

        return $this;
    }
}
