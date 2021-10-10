<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class Interval
 *
 * @todo: Currently this package is not used anywhere in the project. Use it for
 * reference and comparison only.
 *
 * @package Vipps\Model\RecurringPayment
 */
class Interval extends AbstractEnumeration
{
    const MONTH = 'MONTH';
    const WEEK = 'WEEK';
    const DAY = 'DAY';
}
