<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class InitialCharge.
 *
 * @package Vipps\Model\RecurringPayment
 */
class CampaignRequest
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $campaignPrice;

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
    public function getCampaignPrice()
    {
        return $this->campaignPrice;
    }

    /**
     * Set the value of campaignPrice
     *
     * @param  int  $campaignPrice
     *
     * @return  self
     */
    public function setCampaignPrice(int $campaignPrice)
    {
        $this->campaignPrice = $campaignPrice;

        return $this;
    }
}
