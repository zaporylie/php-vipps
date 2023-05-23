<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

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
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest")
     */
    protected $campaign;

    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\Period
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\Period")
     */
    protected $interval;

    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\Pricing
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\Pricing")
     */
    protected $pricing;

    /**
     * Gets interval value.
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\v3\Period
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Gets price value.
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\v3\Pricing
     */
    public function getPricing()
    {
        return $this->pricing;
    }

    /**
     * Gets campaign value.
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest
     */
    public function getCampaign()
    {
        return $this->campaign;
    }
}
