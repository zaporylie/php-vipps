<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class CampaignRequest
 *
 * @package Vipps\Model\RecurringPayment
 */
class CampaignRequest
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $type;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $price;

    /**
     * @var Period
     * @Serializer\Type("Period")
     */
    protected $interval;

    /**
     * @var Period
     * @Serializer\Type("Period")
     */
    protected $period;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $end;

    /**
     * Only required for type eventCampaignV3
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $eventDate;

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
     * @return  Period
     */ 
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set the value of interval
     *
     * @param  Period  $interval
     *
     * @return  self
     */ 
    public function setInterval(Period $interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * @return  Period
     */ 
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param  Period  $period  Only required for type periodChampaignV3
     *
     * @return  self
     */ 
    public function setPeriod(Period $period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * @return  \DateTimeInterface
     */ 
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * @param  \DateTimeInterface  $eventDate
     *
     * @return  self
     */ 
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;

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
     * Set the value of type
     *
     * @param  string  $type
     *
     * @return  self
     */ 
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }
}
