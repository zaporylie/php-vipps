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
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s.u\Z'>")
     */
    protected $end;
}
