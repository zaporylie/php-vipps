<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3\Campaign;

use JMS\Serializer\Annotation as Serializer;
use zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest;
use zaporylie\Vipps\Model\RecurringPayment\v3\CampaignType;

/**
 * Class EventCampaign
 *
 * @package Vipps\Model\RecurringPayment
 */
class EventCampaign extends CampaignRequest
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $type = CampaignType::EVENT_CAMPAIGN;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $price;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $eventDate;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $eventText;


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
     * Get the value of eventText
     *
     * @return  string
     */ 
    public function getEventText()
    {
        return $this->eventText;
    }

    /**
     * Set the value of eventText
     *
     * @param  string  $eventText
     *
     * @return  self
     */ 
    public function setEventText(string $eventText)
    {
        $this->eventText = $eventText;

        return $this;
    }
}
