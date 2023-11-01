<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class PricingType
 *
 * @todo: Currently this package is not used anywhere in the project. Use it for
 * reference and comparison only.
 *
 * @package Vipps\Model\RecurringPayment
 */
class PricingType extends AbstractEnumeration
{
    const LEGACY = 'LEGACY';
    const VARIABLE = 'VARIABLE';
}
