<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class CampaignType
 *
 * @todo: Currently this package is not used anywhere in the project. Use it for
 * reference and comparison only.
 *
 * @package Vipps\Model\RecurringPayment
 */
class CampaignType extends AbstractEnumeration
{
    const FULL_FLEX_CAMPAIGN = 'FULL_FLEX_CAMPAIGN';
    const EVENT_CAMPAIGN = 'EVENT_CAMPAIGN';
    const PERIOD_CAMPAIGN = 'PERIOD_CAMPAIGN';
    const PRICE_CAMPAIGN = 'PRICE_CAMPAIGN';
}
